<?php

namespace App\Http\Controllers\Site;

use App\Libraries\Poster;
use App\Libraries\Telegram;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Delivery;
use App\Models\Payment;

class OrderController extends Controller
{

    public function index(){



        $cart_items = Cart::getContent();
        $delivery   = DB::table('delivery')->get();
        $payment    = DB::table('payment')->get();

        return view('site.pages.checkout', compact('cart_items', 'delivery', 'payment'));



    }

    public function send(Request $request){


        $spot = DB::table('spots')->find(1);
        $data = $request->all();





        if($spot){
            $data['deliveryMethod'] = Delivery::find($data['delivery_id'])->name;
            $data['paymentMethod'] =  Payment::find($data['payment_id'])->name;

            $comment = '';
            if(!empty($data['change'])){
                $comment .= "Комментарий: ".$data['comment'];
            }
            $comment .= " || Способ доставки: " . $data['deliveryMethod'];
            $comment .= " || Способ Оплаты: " .  $data['paymentMethod'];
            if(!empty($data['change'])){
                $comment .= " || Приготовить сдачу с: ".$data['change'];
            }
            if(!empty($data['sticks'])){
                $comment .= " || Кол-во палочек: ".$data['sticks'];
            }

            $order = Order::create([
                'email' => $data['email'] ?? 'Не указан',
                'first_name' => $data['name'] ?? 'Не указано',
                'phone' => $data['phone'],
                'address' => $data['address'] ?? 'Не указано',
                'comment' => $comment,
                'payment_id' => $data['payment_id'],
                'delivery_id' => $data['delivery_id'],
                'sum'         => Cart::getTotal()
            ]);


            $products = [];
            $productsForTelegram = [];

            foreach(Cart::getContent() as $value){

                OrderProduct::create([
                    'order_id'              => $order->id,
                    'product_id'            => $value->associatedModel->id,
                    'attribute_value_id'    => isset($value->attributes['active_modificator']) ? $value->attributes->attribute_value_id : null,
                    'quantity'              => $value->quantity,
                    'price'                 => $value->price,
                    'sum'                   => $value->price * $value->quantity
                ]);

                $product = [
                    'product_id' => $value->associatedModel->poster_id,
                    'count'      => $value->quantity
                ];
                $productForTelegram = [
                    'name'      => $value->name,
                    'count'     => $value->quantity
                ];
                $modificator = [];
                if(isset($value->attributes['active_modificator'])){
                    $modificator = [
                        'modificator_id' => $value->attributes->modificator_id
                    ];
                }

                $products[] = array_merge($product, $modificator);
                $productsForTelegram[] = $productForTelegram;
            }

            $orderForTelegram = [
                'first_name' => $data['name'],
                'phone'      => $data['phone'],
                'email'      => $data['email'],
                'comment'    => $comment,
                'address'    => $data['address'],
                'products'   => $productsForTelegram,
                'total'      => Cart::getTotal() . 'грн'
            ];

            $order = [
                'spot_id' => 1,
                'first_name' => $data['name'],
                'phone'      => $data['phone'],
                'email'      => $data['email'],
                'comment'    => $comment,
                'address'    => $data['address'],
                'products'   => $products
            ];

            //return json_encode($order);
            if(env('APP_PRODUCTION_MODE')){
                $poster = new Poster(env('POSTER_TOKEN'));
                //$response = json_decode($poster->sendOrder($order), true);

                if(!isset($response['error'])){
                    $bot = new Telegram(env('TELEGRAM_BOT_ID'), env('TELEGRAM_CHAT_ID'));
                    $bot->send('Новый заказ', $orderForTelegram);
                }
            }else{
                $response = ['response' => 'success'];
            }

            return json_encode($response);

        }else{
            // spot not found
        }
    }
}

<?php

namespace App\Http\Controllers\Site;

use App\Libraries\Poster;
use App\Libraries\Telegram;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index(){
        $cart_items = Cart::getContent();
        return view('site.pages.checkout', compact('cart_items'));
    }

    public function send(Request $request){


        $spot = DB::table('spots')->find(1);


        $data = $request->all();

        if($spot){
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


            $products = [];
            $productsForTelegram = [];

            foreach(Cart::getContent() as $value){

                $product = [
                    'product_id' => $value->associatedModel->poster_id,
                    'count'      => $value->quantity
                ];
                $productForTelegram = [
                    'name' => $value->name,
                    'count'      => $value->quantity
                ];
                $modificator = [];
                if(isset($value->attributes['active_modificator'])){
                    $modificator = [
                        'modificator_id' => $value->attributes->uid
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

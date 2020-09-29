<?php

namespace App\Http\Controllers\Site;

use App\Libraries\Poster;
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


            $products = [];

            foreach(Cart::getContent() as $value){
                $products[] = [
                    'product_id' => $value->associatedModel->poster_id,
                    'count'      => $value->quantity,
                    'modificator_id' => $value->associatedModel->poster_id
                ];
            }

            $order = [
                'spot_id' => 1,
                'first_name' => $data['name'],
                'phone'      => $data['phone'],
                'email'      => $data['email'],
                'comment'    => $comment,
                'address'    => $data['address'],
                'products'   => $products
            ];

            return json_encode($order);

            $poster = new Poster($spot->poster_token);
            //return json_encode($poster->sendOrder($order));

        }else{
            // spot not found
        }
    }
}

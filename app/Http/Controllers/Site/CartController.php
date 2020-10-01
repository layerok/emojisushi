<?php

namespace App\Http\Controllers\Site;

use Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class CartController extends Controller
{
    public function getCart()
    {
        $response = [
            'products'        => Cart::getContent(),
            'totalQuantity' => Cart::getTotalQuantity(),
            'total'         => Cart::getTotal(),
        ];
        return json_encode($response,true);
    }
    public function manipulate(Request $request)
    {
        $input = $request->input();

        $options = $request->except('_token', 'action', 'uid');

        $active_mod = isset($input['active_modificator'])? (int)$input['active_modificator'] : null;
        if(isset($active_mod)){

            $uid = $input['uid'][$active_mod];

        }else{
            $uid = $input['uid'];

        }


        $product = Product::find($request->input('product_id'));

        //Cart::clear();
        //return json_encode($input);

        $response = [
            'message' => 'Ошибка!',
            'status'  => 'error'
        ];


            switch($request->input('action')){
                case 'add': {
                    if($product->exists()){
                        $options = array_merge($options, ['uid' => $uid]);
                        if(isset($active_mod)){
                            $name = $product->name . ' ' . $input['modificator_value'][$active_mod] ;
                            $price = $input['modificator_price'][$active_mod];
                        }else{
                            $name = $product->name;
                            $price = $product->price;
                        }


                        Cart::add([
                            'id' =>$uid,
                            'name' => $name,
                            'price' => $price ,
                            'quantity' => 1,
                            'attributes' => $options,
                            'associatedModel' => $product,
                        ]);
                        $response['message'] = "Товар добавлен!";
                        $response['status']  = "success";
                    }
                    break;
                }
                case 'decrease': {
                    if(Cart::get($uid)->quantity == 1){
                        $response['message'] = "Товар удален!";
                        Cart::remove($uid);
                    }else{
                        $response['message'] = "Кол-во уменьшено!";
                        Cart::update($uid, [
                            'quantity' => -1
                        ]);
                    }


                    $response['status']  = "success";
                    break;
                }
                case 'increase': {
                    Cart::update($uid, [
                        'quantity' => 1
                    ]);
                    $response['message'] = "Кол-во увеличено!";
                    $response['status']  = "success";
                    break;
                }
                case 'remove': {
                    Cart::remove($uid);
                    $response['message'] = "Товар удален!";
                    $response['status']  = "success";
                    break;
                }
            }


            return json_encode($response);



    }

    public function removeItem($id)
    {
        Cart::remove($id);

        if (Cart::isEmpty()) {
            return redirect('/');
        }
        return redirect()->back()->with('message', 'Item removed from cart successfully.');
    }

    public function clearCart()
    {
        Cart::clear();

        return redirect('/');
    }
}

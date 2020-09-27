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
            'products' => Cart::getContent()
        ];
        return json_encode($response,true);
    }
    public function manipulate(Request $request)
    {
        $product = Product::find($request->input('id'));
        $options = $request->except('_token', 'qty');

        $response = [
            'message' => 'Ошибка!',
            'status'  => 'error'
        ];
        if($product->exists()){
            switch($request->input('action')){
                case 'add': {
                    Cart::add($product->id, $product->name, $product->price , 1, $options);
                    $response['message'] = "Товар добавлен!";
                    $response['status']  = "success";
                    break;
                }
                case 'decrease': {
                    if(Cart::get($product->id)->quantity == 1){
                        $response['message'] = "Товар удален!";
                        Cart::remove($product->id);
                    }else{
                        $response['message'] = "Кол-во уменьшено!";
                        Cart::update($product->id, [
                            'quantity' => -1
                        ]);
                    }


                    $response['status']  = "success";
                    break;
                }
                case 'increase': {
                    Cart::update($product->id, [
                        'quantity' => 1
                    ]);
                    $response['message'] = "Кол-во увеличено!";
                    $response['status']  = "success";
                    break;
                }
                case 'remove': {
                    Cart::remove($product->id);
                    $response['message'] = "Товар удален!";
                    $response['status']  = "success";
                    break;
                }
            }


            return json_encode($response);
        }else{

            return json_encode($response);
        }

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

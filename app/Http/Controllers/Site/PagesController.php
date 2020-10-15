<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;

class PagesController extends Controller
{
    public function delivery(){

        return view('site.pages.delivery-and-payment');
    }

    public function thankyou(){
        Cart::clear();
        return view('site.pages.thankyou', ['page']);
    }
}

<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function delivery(){

        return view('site.pages.delivery-and-payment');
    }

    public function thankyou(){

        return view('site.pages.thankyou', ['page']);
    }
}

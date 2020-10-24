<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Page;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index(Page $page){

        $files = Storage::disk('views')->files('site/pages');

        if(in_array('site/pages/' . $page->slug .'.blade.php', $files)){
            return view('site.pages.' .$page->slug, compact('page') );
        }else{
            return view('site.pages.default', compact($page));
        }

    }
}

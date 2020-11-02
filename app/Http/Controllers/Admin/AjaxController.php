<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function changeState(){

        $s_table = $_POST['table'];
        $n_id = $_POST['id'];
        $b_hidden = $_POST['hidden'] == "true" ? 1 : 0;


        DB::table("{$s_table}")->where("id", "=", "{$n_id}")->update([
            "hidden" => $b_hidden
        ]);

    }
}

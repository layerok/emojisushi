<?php
namespace App\Libraries;


use App\Models\Setting;
use Illuminate\Support\Facades\Log;

class Asset {

    public static function load($name){

        $theme = Setting::where('key', '=', 'theme')->first();

        return asset("themes/{$theme->value}/assets/{$name}");
    }

}

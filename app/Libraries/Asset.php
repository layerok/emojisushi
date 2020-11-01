<?php
namespace App\Libraries;


use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Storage;

class Asset {

    public static function load($name){

        $theme = Setting::where('key', '=', 'theme')->first();
        $path = "/themes/{$theme->value}/assets/{$name}";

        return asset($path . "?2" );
    }

}

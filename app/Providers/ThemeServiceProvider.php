<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $theme = Setting::where('key', '=', 'theme')->first();

        $views = [
            resource_path("views/themes/{$theme->value}"),
            resource_path("views/themes/default")
        ];

        $this->loadViewsFrom($views, 'theme');
    }
}

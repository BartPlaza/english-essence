<?php

namespace App\Providers;

use App\Scoping\Scoper;
use App\Services\DictionaryService;
use Illuminate\Support\ServiceProvider;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        if ($this->app->environment() == 'production') {
            URL::forceScheme('https');
        }

        $this->app->bind(DictionaryService::class, function(){
            return new DictionaryService();
        });
    }
}

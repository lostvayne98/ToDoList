<?php

namespace App\Providers;

use App\Http\Controllers\ToDo\Actions\StoreAction;
use App\Http\Controllers\ToDo\Actions\StoreInterface;
use Illuminate\Support\ServiceProvider;

class TagServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StoreInterface::class,StoreAction::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

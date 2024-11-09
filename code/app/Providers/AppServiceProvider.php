<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\NotifyInterface;
use App\Services\NotifyWays\System;
use App\Services\NotifyWays\ContinuePay;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(
            NotifyInterface::class,
            function () {

                $type = request()->input('type');


                switch ($type) {
                    case 'system':
                        return new System();
                    case 'continuePay':
                        return new ContinuePay();
                    default:
                        throw new \InvalidArgumentException("無效的通知類型：$type");
                }
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

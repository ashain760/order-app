<?php

namespace App\Providers;

use App\Facade\Login\Login;
use App\Facade\Orders\Order;
use App\Facade\Utility\Libs;
use App\Http\Services\OrderSvc;
use App\Interfaces\LoginRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\OrderServiceInterface;
use App\Repositories\mysql\LoginRepository;
use App\Repositories\mysql\OrderRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repository Bind
        $this->app->bind(LoginRepositoryInterface::class, LoginRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);

        // Service
        $this->app->bind(OrderServiceInterface::class, OrderSvc::class);

        // Facade Bind
        $this->app->bind('login', Login::class);
        $this->app->bind('order', Order::class);
        $this->app->bind('libs', Libs::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

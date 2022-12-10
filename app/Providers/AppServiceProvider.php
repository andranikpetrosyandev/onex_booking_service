<?php

namespace App\Providers;

use App\Repositories\Core\BookingRepository;
use App\Repositories\Core\RoomTypeRepository;
use App\Repositories\Impl\RoomTypeRepositoryImpl;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Repositories\Core\RoomRepository;
use App\Repositories\Impl\BookingRepositoryImpl;
use App\Repositories\Impl\RoomRepositoryImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RoomTypeRepository::class,function($app){
            return new RoomTypeRepositoryImpl();
        });
        $this->app->bind(RoomRepository::class,function($app){
            return new RoomRepositoryImpl();
        });
        $this->app->bind(BookingRepository::class,function($app){
            return new BookingRepositoryImpl();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}

<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\RoomType;
use App\Policies\RoomTypePolicy;
use App\Models\Room;
use App\Policies\BookingPolicy;
use App\Policies\RoomPolicy;
use App\Models\Booking;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        RoomType::class => RoomTypePolicy::class,
        Room::class => RoomPolicy::class,
        Booking::class => BookingPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}

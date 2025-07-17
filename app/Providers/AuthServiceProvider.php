<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\Booking; // ✅ Correct path to model
use App\Policies\BookingPolicy; // ✅ Correct path to policy

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Booking::class => BookingPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}

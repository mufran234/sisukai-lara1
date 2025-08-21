<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Pulse\Facades\Pulse;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    	
	public function boot(): void
    {
        Pulse::user(fn ($user) => [
			'name' => $user->name,
			'extra' => $user->email,
			'avatar' => $user->avatar_url,
		]);
		
		Gate::define('viewPulse', function (User $user) {
			return $user->isAdmin();
		});
		
		//...
    }
}

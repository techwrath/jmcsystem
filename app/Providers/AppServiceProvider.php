<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Notification; 
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

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
        $notifications = DB::table('notifications')->where('isRead', 1)->get();
        //dd($notifications);
        $totalNotifications = $notifications->count();
        View::share([
            'notifications' => $notifications,
            'totalNotifications' => $totalNotifications
        ]);
    }
}

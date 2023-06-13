<?php

namespace App\Providers\ViewComposers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        View::composer('*', function ($view) {
            $notifications = [];
            
            if(Auth::check()) {
                $notifications = Auth::user()->notifications->take(10);
                $notifications = [
                    'list' => Auth::user()->notifications->take(10),
                    'unread' => Auth::user()->unreadNotifications
                ];
            }
            $view->with('notifications', $notifications);
        });
    }
}

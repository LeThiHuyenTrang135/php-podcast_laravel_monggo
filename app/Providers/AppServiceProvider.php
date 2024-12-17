<?php

namespace App\Providers;

use App\Services\Notification\NotificationService;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $loader = AliasLoader::getInstance();
        // using custom PersonalAccessToken model instead of Sanctum's
        $loader->alias(\Laravel\Sanctum\PersonalAccessToken::class, \App\Models\PersonalAccessToken::class);

        View::composer('*', function ($view) {
            $notificationService = app(NotificationService::class);
            $notifications = Auth::check() 
                ? $notificationService->getNotificationsByReceiverId(Auth::id())
                : new Collection();  // Hoặc query theo nhu cầu
            $unreadNotificationsCount = $notifications->where('is_seen', 0)->count();
            $WS_CLIENT = env('WS_CLIENT', 'ws://localhost:8080/ws');

            $view->with('WS_CLIENT', $WS_CLIENT);
            $view->with('notifications', $notifications);
            $view->with('unreadNotificationsCount', $unreadNotificationsCount);
        });
    }
}

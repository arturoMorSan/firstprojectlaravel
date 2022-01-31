<?php

namespace App\Providers;

use App\Http\ViewComposers\DashboardMenuComposer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Session;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['layout.dashboard-master', 'layout.master'], function ($view) {
            $toast = [];
            if (Session::has('toast')) {
                $toast = array(['message' => Session::get('toast')['message']]);

            }

            $view->with('toast', $toast);
        });

        View::composer('*', function ($view) {
            $view->with('authUser', Auth::user());
        });

        View::composer(
            'layout.dashboard-menu', DashboardMenuComposer::class
        );
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}


<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Notification;

use Illuminate\Support\Facades\View;

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
            View::composer('*', function ($view) {

            $category = Category::with('FormTypeName')->get();
            $view->with('category', $category);

            $notification = Notification::where('notifiable_id', auth()->id())->where('read_at',null)->count();
            $view->with('notification', $notification);
         
           
        });
       
    }
}

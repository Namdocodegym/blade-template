<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\Alert;
use Illuminate\Pagination\Paginator;

//trình khởi tạo ứng dụng


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
        Blade::directive('datetime', function ($expression) {
            $expression = trim($expression, '\'');
            $expression = trim($expression, ' " ');

            $dataObject = date_create($expression);

            if (!empty($dataObject)) {
                $dateFormat = $dataObject->format('d/m/Y H:i:s');
                return $dateFormat;
            }
        });

        Blade::component('package-alert', Alert::class);

        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}

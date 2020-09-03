<?php

namespace App\Providers;

use App\Calculator\Calculator;
use App\Calculator\Operators\Subtraction;
use App\Calculator\Operators\Sum;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Calculator::class, function () {
            $logger = $this->app->make(LoggerInterface::class);
            $calculator = new Calculator($logger);
            $calculator
                ->register('+', new Sum())
                ->register('-', new Subtraction())
            ;

            return $calculator;
        });
    }

    public function boot()
    {
        View::composer('welcome', function (\Illuminate\View\View $view) {
            $view->with('currentDate', (new \DateTime())->format('Y-m-d H:i:s'));
            \logger()->info('The welcome view has been rendered');
        });
    }
}

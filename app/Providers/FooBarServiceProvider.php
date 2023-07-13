<?php

namespace App\Providers;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        HelloService::class => HelloServiceIndonesia::class
    ];
    
    public function register()
    {
        $this->app->singleton(Foo::class, fn () => new Foo());
        $this->app->singleton(Bar::class, fn () => new Bar($this->app->make(Foo::class)));
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function provides() : array {
        return [HelloService::class, Foo::class, Bar::class];
    }
}

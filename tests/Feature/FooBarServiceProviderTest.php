<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FooBarServiceProviderTest extends TestCase
{
    public function testServiceProvider() : void {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);
        
        self::assertEquals($foo1, $foo2);

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertEquals($bar1, $bar2);
        self::assertEquals($foo1, $bar1->foo);
        self::assertEquals($foo2, $bar2->foo);
    }

    public function testPropertiSingleton() : void {
        $helloService1 = $this->app->make(HelloService::class);
        $helloService2 = $this->app->make(HelloService::class);

        self::assertEquals($helloService1, $helloService2);
        self::assertEquals("Halo Fardan", $helloService2->hello("Fardan"));
    }

    public function testEmpty() : void {
        self::assertTrue(true);
    }
}

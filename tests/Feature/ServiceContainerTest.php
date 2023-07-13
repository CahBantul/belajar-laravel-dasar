<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependency(): void
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals("Foo", $foo1->foo());
        self::assertEquals("Foo", $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }

    public function testBind(): void
    {
        $this->app->bind(Person::class, function () {
            return new Person("Fardan", "Nozami");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Fardan", $person1->firstName);
        self::assertEquals("Fardan", $person2->firstName);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton(): void
    {
        $this->app->singleton(Person::class, function () {
            return new Person("Fardan", "Nozami");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Fardan", $person1->firstName);
        self::assertEquals("Fardan", $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testInstance(): void
    {
        $person = new Person("Fardan", "Nozami");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Fardan", $person1->firstName);
        self::assertEquals("Fardan", $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjection(): void
    {
        $this->app->singleton(Foo::class, fn () => new Foo());

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);
        self::assertNotSame($bar1, $bar2);
    }

    public function testDependencyInjectionInCLosure(): void
    {
        $this->app->singleton(Foo::class, fn () => new Foo());
        $this->app->singleton(Bar::class, fn ($app) => new Bar($app->make(Foo::class)));

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass() : void {
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);
        $this->app->singleton(HelloService::class, fn ($app) => new HelloServiceIndonesia());

        $helloservice = $this->app->make(HelloService::class);
        self::assertEquals("Halo Fardan", $helloservice->hello("Fardan"));
    }
}

<?php

namespace App\Services;

Class HelloServiceIndonesia implements HelloService
{
    public function hello(string $name) : string {
        return "Halo $name";
    }
}
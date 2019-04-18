<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Test1 extends Facade
{
    protected static function getFacadeAccessor() { return 'test'; }
}
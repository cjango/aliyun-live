<?php

namespace Jason;

class Live extends \Illuminate\Support\Facades\Facade
{

    protected static function getFacadeAccessor(): string
    {
        return Live\Application::class;
    }

}

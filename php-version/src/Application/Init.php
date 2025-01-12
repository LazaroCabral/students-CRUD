<?php

namespace Lazaro\StudentCrud\Application;

class Init{

    private static function errorConfig(): void{
        error_reporting(0);
    }

    public static function init(): void{
        self::errorConfig();
    }
}
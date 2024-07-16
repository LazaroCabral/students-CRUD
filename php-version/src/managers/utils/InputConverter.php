<?php

namespace Lazaro\StudentCrud\Managers\Utils;

class InputConverter{

    static function statusConveter($status): int{
        if($status == "on" || $status == "true"){
            return 1;
        }
        return 0;
    }
}
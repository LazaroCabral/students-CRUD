<?php

namespace Lazaro\StudentCrud\Managers\Utils;

class InputConverter{

    static function statusConveter(&$status): int{
        if($status == "on" || $status == "true"){
            $status=1;
            return 1;
        }
        $status=0;
        return 0;
    }
}
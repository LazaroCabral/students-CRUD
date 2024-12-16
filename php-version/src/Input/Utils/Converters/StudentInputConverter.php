<?php

namespace Lazaro\StudentCrud\Input\Utils\Converters;

use Lazaro\StudentCrud\Input\Utils\Enums\STUDENT_INPUT_NAMES;

class StudentInputConverter{

    static function convertAllFields(&$inputData){
        self::statusConveter($inputData[STUDENT_INPUT_NAMES::STATUS->value]);
    }

    static function statusConveter(&$status) {
        if($status == "on" || $status == "true"){
            $status="1";
            return;
        }
        $status="0";
    }
}
<?php

namespace Lazaro\StudentCrud\Request\Utils;

use Lazaro\StudentCrud\Request\Utils\Enums\HTTP_METHODS;

class RequestUtils{

    public const SOURCE_PROJECT="/student-crud/php-version";

    static function methodValidate(HTTP_METHODS $httpMehtod) {
        if(strcmp($_SERVER["REQUEST_METHOD"],$httpMehtod->value) != 0){
            return false;
        }
        return true;
    }

    static function getJson(){
        return json_decode(file_get_contents("php://input"),true);
    }

    static function getContent(){
        return $_REQUEST;
    }
    
    static function redirectTo(string $to){
        header("Location:".$to,false,301);
        die;
    }

}
<?php

namespace Lazaro\StudentCrud\Response\Data\Rest;

use Lazaro\StudentCrud\Response\Data\AbstractResponseData;

class RestData extends AbstractResponseData{

    protected static RestData | null $restData=null;

    private function __construct(){
        parent::__construct('restData');
    }

    public static function getInstance(): RestData{
        if(self::$restData == null){
            self::$restData=new RestData();
        }
        return self::$restData;
    }

    public function setJson(mixed $json): void{
        $GLOBALS[$this->prefix]['json']=$json;
    }

    public function getJson(): string | null{
        $json=json_encode(@$GLOBALS[$this->prefix]['json']);
        if($json === false){
            return null;
        }
        return $json;
    }

}
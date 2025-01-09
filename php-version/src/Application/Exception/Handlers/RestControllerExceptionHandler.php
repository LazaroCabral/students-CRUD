<?php

namespace Lazaro\StudentCrud\Application\Exception\Handlers;

use Lazaro\StudentCrud\Input\Utils\Validators\Exceptions\InvalidInputException;
use Lazaro\StudentCrud\Response\Data\Rest\RestData;

class RestControllerExceptionHandler extends AbstractExceptionHandler{

    private RestData $restData;

    public function __construct(RestData $restData) {
        $this->restData = $restData;
    }

    public function execute(\Exception $ex):void{
        switch($ex){
            case $ex instanceof \mysqli_sql_exception:{
                http_response_code(505);
                break;
            }
            case $ex instanceof InvalidInputException:{
                http_response_code(400);
                break;
            }
        }
        parent::execute($ex);
    }

}
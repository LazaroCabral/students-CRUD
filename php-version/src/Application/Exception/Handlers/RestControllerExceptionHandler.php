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
            case $ex instanceof InvalidInputException:{
                $this->restData->setErrorMessage($ex->getMessage());
                http_response_code(400);
                break;
            }
            default:{
                $this->restData->setErrorMessage('500');
                $this->restData->setErrorDescription('internal server error!');
                http_response_code(500);
            }
        }
        parent::execute($ex);
    }

}
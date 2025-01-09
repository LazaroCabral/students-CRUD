<?php

namespace Lazaro\StudentCrud\Application\Exception\Handlers;

use Lazaro\StudentCrud\Input\Utils\Validators\Exceptions\InvalidInputException;
use Lazaro\StudentCrud\Response\Data\ResponseDataInterface;

class GenericControllerExceptionHandler extends AbstractExceptionHandler{

    private ResponseDataInterface $responseData;

    public function __construct(ResponseDataInterface $responseData) {
        $this->responseData = $responseData;
    }

    public function execute(\Exception $ex):void{
        switch($ex){
            case $ex instanceof \mysqli_sql_exception:{
                $this->responseData->setErrorMessage("database error");
                break;
            };
            case $ex instanceof InvalidInputException:{
                $this->responseData->setErrorMessage($ex->getMessage());
                break;
            };
        }
        parent::execute($ex);
    }

}
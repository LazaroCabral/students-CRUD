<?php

namespace Lazaro\StudentCrud\Application\Exception\Handlers;

use Lazaro\StudentCrud\Request\Exceptions\HttpException;
use Lazaro\StudentCrud\Response\Data\ResponseDataInterface;

class HttpExceptionHandler extends AbstractExceptionHandler{

    private ResponseDataInterface $responseData;

    public function __construct(ResponseDataInterface $responseData) {
        $this->responseData=$responseData;
    }

    public function execute(\Exception $ex):void {
        if($ex instanceof HttpException){
            $descriptionPrefix='description';
            $this->responseData->setErrorMessage($ex->getMessage());
            switch($ex){
                case $ex->getMessage() == '405':{
                    $this->responseData->setData($descriptionPrefix,'method not allowed!');
                }
            }
            http_response_code($ex->getMessage());
        }
        parent::execute($ex);
    }

}
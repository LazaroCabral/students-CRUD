<?php

namespace Lazaro\StudentCrud\Mvc\Controller\Template;

use Exception;
use Lazaro\StudentCrud\Input\Utils\Validators\Exceptions\InvalidInputException;
use Lazaro\StudentCrud\Mvc\Controller\Methods\Delete;
use Lazaro\StudentCrud\Mvc\Controller\Methods\Get;
use Lazaro\StudentCrud\Mvc\Controller\Methods\Post;
use Lazaro\StudentCrud\Mvc\Controller\Methods\Put;
use Lazaro\StudentCrud\Request\Utils\Enums\HTTP_METHODS;
use Lazaro\StudentCrud\Request\Utils\RequestUtils;
use Lazaro\StudentCrud\Response\Data\ResponseDataInterface;
use mysqli_sql_exception;

abstract class AbstractController{

    private ResponseDataInterface $responseData;

    public function __construct(ResponseDataInterface $responseData) {
        $this->responseData = $responseData;
    }

    public function execute(): void{
        try{
            $this->methodSelection();
        } catch(Exception $ex){
            $this->exceptionTreatment($ex);
        }
    }

    protected function exceptionTreatment(Exception $ex): void{
        switch($ex){
            case $ex instanceof mysqli_sql_exception:{
                $this->responseData->setErrorMessage("database error");
                break;
            };
            case $ex instanceof InvalidInputException:{
                $this->responseData->setErrorMessage($ex->getMessage());
                break;
            };
            default: {
                throw new Exception();
            };
        }
        
    }
        
    public final function methodSelection(): void{

        switch($this){
            case RequestUtils::methodValidate(HTTP_METHODS::GET)
                    && $this instanceof Get: {
                        $this->get();
                        break;
                    }
            case RequestUtils::methodValidate(HTTP_METHODS::POST)
                    && $this instanceof Post: {
                        $this->post();
                        break;
                    }
            case RequestUtils::methodValidate(HTTP_METHODS::PUT)
                    && $this instanceof Put: {
                        $this->put();
                        break;
                    }
            case RequestUtils::methodValidate(HTTP_METHODS::DELETE)
                    && $this instanceof Delete: {
                        $this->get();
                        break;
                    }
        }
    }
}
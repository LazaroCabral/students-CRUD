<?php

namespace Lazaro\StudentCrud\Mvc\Controller\Support\Template;

use Exception;
use Lazaro\StudentCrud\Application\Exception\Handlers\ExceptionHandlerInterface;
use Lazaro\StudentCrud\Application\Init;
use Lazaro\StudentCrud\Mvc\Controller\Support\Methods\Delete;
use Lazaro\StudentCrud\Mvc\Controller\Support\Methods\Get;
use Lazaro\StudentCrud\Mvc\Controller\Support\Methods\Post;
use Lazaro\StudentCrud\Mvc\Controller\Support\Methods\Put;
use Lazaro\StudentCrud\Request\Exceptions\HttpException;
use Lazaro\StudentCrud\Request\Utils\Enums\HTTP_METHODS;
use Lazaro\StudentCrud\Request\Utils\RequestUtils;
use Lazaro\StudentCrud\Response\Data\ResponseDataInterface;

abstract class AbstractController{

    private ResponseDataInterface $responseData;

    private ExceptionHandlerInterface $exceptionHandler;

    public function __construct(ResponseDataInterface $responseData, ExceptionHandlerInterface $exceptionHandler) {
        $init=new Init();
        $init->init();
        $this->responseData = $responseData;
        $this->exceptionHandler= $exceptionHandler;
    }

    public function execute(): void{
        try{
            $this->methodSelection();
        } catch(Exception $ex){
            $this->exceptionHandler($ex);
        }
    }

    protected function exceptionHandler(Exception $ex): void{
        $this->exceptionHandler->execute($ex);
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
                        $this->delete();
                        break;
                    }
            default : throw new HttpException(405);
        }
    }
}
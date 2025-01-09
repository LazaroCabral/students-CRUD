<?php

namespace Lazaro\StudentCrud\Application\Exception\Handlers\Directors;

use Lazaro\StudentCrud\Application\Exception\Handlers\Builders\ExceptionHandlerBuilder;
use Lazaro\StudentCrud\Application\Exception\Handlers\GenericControllerExceptionHandler;
use Lazaro\StudentCrud\Application\Exception\Handlers\HttpExceptionHandler;
use Lazaro\StudentCrud\Application\Exception\Handlers\MvcControllerExceptionHandler;
use Lazaro\StudentCrud\Application\Exception\Handlers\RestControllerExceptionHandler;
use Lazaro\StudentCrud\Response\Data\ResponseDataInterface;
use Lazaro\StudentCrud\Response\Data\Rest\RestData;
use Lazaro\StudentCrud\Response\Data\View\ViewData;

class ExceptionHandlerDirector{

    private ExceptionHandlerBuilder $builder;

    public function __construct(ExceptionHandlerBuilder | null $builder = null) {
        if($builder != null){
            $this->builder = $builder;
        } else{
            $this->builder= new ExceptionHandlerBuilder();
        }
    }

    public function createControllerExceptionHandlerChain(ResponseDataInterface $responseData): ExceptionHandlerBuilder{
        $this->builder->addHandler(new GenericControllerExceptionHandler($responseData))
            ->addHandler(new HttpExceptionHandler($responseData));
        return $this->builder;
    }

    public function createMvcControllerExceptionHandlerChain(ViewData $viewData): ExceptionHandlerBuilder{
        $this->builder->addHandler(new MvcControllerExceptionHandler($viewData));
        return $this->builder;
    }

    public function createRestControllerExceptionHandlerChain(RestData $restData): ExceptionHandlerBuilder{
        $this->builder->addHandler(new RestControllerExceptionHandler($restData));
        return $this->builder;
    }


}
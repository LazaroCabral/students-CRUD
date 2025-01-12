<?php

namespace Lazaro\StudentCrud\Application\Exception\Handlers\Factories;

use Lazaro\StudentCrud\Application\Exception\Handlers\Builders\ExceptionHandlerBuilder;
use Lazaro\StudentCrud\Application\Exception\Handlers\ExceptionHandlerInterface;
use Lazaro\StudentCrud\Application\Exception\Handlers\HttpExceptionHandler;
use Lazaro\StudentCrud\Application\Exception\Handlers\MvcControllerExceptionHandler;
use Lazaro\StudentCrud\Application\Exception\Handlers\RestControllerExceptionHandler;
use Lazaro\StudentCrud\Response\Data\ResponseDataInterface;
use Lazaro\StudentCrud\Response\Data\Rest\RestData;
use Lazaro\StudentCrud\Response\Data\View\ViewData;

class ExceptionHandlerFactory{

    private function defaultExceptionHandlerBuilder(ResponseDataInterface $responseData): ExceptionHandlerBuilder{
        return new ExceptionHandlerBuilder(new HttpExceptionHandler($responseData));
    }

    public function createMvcExceptionHandler(ViewData $viewData): ExceptionHandlerInterface{
        $builder= $this->defaultExceptionHandlerBuilder($viewData);
        return $builder
            ->addHandler(new MvcControllerExceptionHandler($viewData))
            ->create();
    }

    public function createRestExceptionHandler(RestData $restData): ExceptionHandlerInterface{
        $builder= $this->defaultExceptionHandlerBuilder($restData);
        return $builder
            ->addHandler(new RestControllerExceptionHandler($restData))
            ->create();
    }

}
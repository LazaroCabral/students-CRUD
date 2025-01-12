<?php

namespace Lazaro\StudentCrud\Application\Exception\Handlers\Factories;

use Lazaro\StudentCrud\Application\Exception\Handlers\Builders\ExceptionHandlerBuilder;
use Lazaro\StudentCrud\Application\Exception\Handlers\Directors\ExceptionHandlerDirector;
use Lazaro\StudentCrud\Application\Exception\Handlers\ExceptionHandlerInterface;
use Lazaro\StudentCrud\Response\Data\Rest\RestData;
use Lazaro\StudentCrud\Response\Data\View\ViewData;

class ExceptionHandlerFactory{

    private ExceptionHandlerDirector $director;

    public function __construct() {
        $this->director = new ExceptionHandlerDirector();
    }

    public function createMvcExceptionHandler(ViewData $viewData): ExceptionHandlerInterface{
        $builder= new ExceptionHandlerBuilder();
        return $builder
            ->addHandler($this->director->createControllerExceptionHandlerChain($viewData)->create())
            ->addHandler($this->director->createMvcControllerExceptionHandlerChain($viewData)->create())
            ->create();
    }

    public function createRestExceptionHandler(RestData $restData): ExceptionHandlerInterface{
        $builder= new ExceptionHandlerBuilder();
        return $builder
            ->addHandler($this->director->createControllerExceptionHandlerChain($restData)->create())
            ->addHandler($this->director->createRestControllerExceptionHandlerChain($restData)->create())
            ->create();
    }

}
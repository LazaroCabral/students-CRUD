<?php

namespace Lazaro\StudentCrud\Mvc\Controller\Support\Template;

use Lazaro\StudentCrud\Application\Exception\Handlers\Factories\ExceptionHandlerFactory;
use Lazaro\StudentCrud\Response\Data\View\ViewData;

abstract class AbstractMvcController extends AbstractController{

    protected ViewData $viewData;

    public function __construct() {
        $this->viewData=ViewData::getInstance();
        $exceptionHandlerFactory= new ExceptionHandlerFactory();
        parent::__construct(
            ViewData::getInstance(),
            $exceptionHandlerFactory->createMvcExceptionHandler(ViewData::getInstance())
        );
    }

    abstract protected function defaultView(): string | null;

    #[\Override]
    public function execute(): void{
        parent::execute();
        if($this->viewData->getView() != null){
            require $this->viewData->getView();
        } elseif($this->defaultView() != null){
            require $this->defaultView();
        }
    }

}
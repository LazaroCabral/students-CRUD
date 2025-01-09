<?php

namespace Lazaro\StudentCrud\Mvc\Controller\Support\Template;

use Lazaro\StudentCrud\Application\Exception\Handlers\Directors\ExceptionHandlerDirector;
use Lazaro\StudentCrud\Application\Exception\Handlers\ExceptionHandlerInterface;
use Lazaro\StudentCrud\Response\Data\View\ViewData;

abstract class AbstractMvcController extends AbstractController{

    protected ViewData $viewData;

    private ExceptionHandlerInterface $exceptionHandler;

    public function __construct() {
        $this->viewData=ViewData::getInstance();
        $this->exceptionHandlerConfig();
        parent::__construct($this->viewData);
    }

    private function exceptionHandlerConfig(): void{
        $director= new ExceptionHandlerDirector();
        $this->exceptionHandler=$director->createMvcControllerExceptionHandlerChain(ViewData::getInstance())
            ->create();
    }

    #[\Override]
    public function execute(): void{
        parent::execute();
        if($this->viewData->getView() != null){
            require $this->viewData->getView();
        }
    }

    #[\Override()]
    public function exceptionHandler(\Exception $ex): void{
        $this->exceptionHandler->execute($ex);
        parent::exceptionHandler($ex);
    }

}
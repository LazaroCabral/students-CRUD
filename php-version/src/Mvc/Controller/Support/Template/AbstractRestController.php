<?php

namespace Lazaro\StudentCrud\Mvc\Controller\Support\Template;

use Exception;
use Lazaro\StudentCrud\Application\Exception\Handlers\Directors\ExceptionHandlerDirector;
use Lazaro\StudentCrud\Application\Exception\Handlers\ExceptionHandlerInterface;
use Override;
use Lazaro\StudentCrud\Response\Data\Rest\RestData;

abstract class AbstractRestController extends AbstractController{

    protected RestData $restData;

    private ExceptionHandlerInterface $exceptionHandler;

    public function __construct() {
        $this->restData=RestData::getInstance();
        $this->exeptionHandlerConfig();
        parent::__construct($this->restData);
    }

    private function exeptionHandlerConfig(): void{
        $director=new ExceptionHandlerDirector();
        $this->exceptionHandler = $director->createRestControllerExceptionHandlerChain(RestData::getInstance())
            ->create();
    }

    #[Override()]
    public function execute(): void{
        parent::execute();
        $json=$this->restData->getJson();
        if($json != null){
            echo $json;
        }
    }

    #[\Override]
    public function exceptionHandler(Exception $ex): void{
        $this->exceptionHandler->execute($ex);
        parent::exceptionHandler($ex);
    }

}
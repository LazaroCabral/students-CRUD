<?php

namespace Lazaro\StudentCrud\Mvc\Controller\Support\Template;

use Lazaro\StudentCrud\Application\Exception\Handlers\Factories\ExceptionHandlerFactory;
use Override;
use Lazaro\StudentCrud\Response\Data\Rest\RestData;

abstract class AbstractRestController extends AbstractController{

    protected RestData $restData;

    public function __construct() {
        $this->restData=RestData::getInstance();
        $exceptionHandlerFactory=new ExceptionHandlerFactory();
        parent::__construct(
            RestData::getInstance(),
            $exceptionHandlerFactory->createRestExceptionHandler(RestData::getInstance())
        );
    }

    #[Override()]
    public function execute(): void{
        parent::execute();
        $json=$this->restData->getJson();
        if($json != null){
            echo $json;
        }
    }

}
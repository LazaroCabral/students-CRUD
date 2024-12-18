<?php

namespace Lazaro\StudentCrud\Mvc\Controller\Template;

use Exception;
use Lazaro\StudentCrud\Input\Utils\Validators\Exceptions\InvalidInputException;
use mysqli_sql_exception;
use Override;
use Lazaro\StudentCrud\Response\Data\Rest\RestData;

abstract class AbstractRestController extends AbstractController{

    protected RestData $restData;

    public function __construct() {
        $this->restData=RestData::getInstance();
        parent::__construct($this->restData);
    }

    #[Override()]
    public function execute(): void{
        parent::execute();
        $json=$this->restData->getJson();
        if($json != null){
            echo $json;
        }
    }

    public function exceptionTreatment(Exception $ex): void{
        switch($ex){
            case $ex instanceof mysqli_sql_exception:{
                http_response_code(505);
                break;
            }
            case $ex instanceof InvalidInputException:{
                http_response_code(400);
                break;
            }
        }
        parent::exceptionTreatment($ex);
    }

}
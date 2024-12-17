<?php

namespace Lazaro\StudentCrud\Mvc\Controller\Template;

use Exception;
use Lazaro\StudentCrud\Input\Utils\Validators\Exceptions\InvalidInputException;
use Lazaro\StudentCrud\View\Data\SetViewData;
use mysqli_sql_exception;


abstract class AbstractController{

    public function execute(): void{
        try{
            $this->methodSelection();
        } catch(Exception $ex){
            $this->exceptionTreatment($ex);
        } finally{
            if(SetViewData::getView() != null){
                require SetViewData::getView();
            }
        }
    }

    protected function exceptionTreatment(Exception $ex): void{
        switch($ex){
            case $ex instanceof mysqli_sql_exception:{
                SetViewData::setErrorMessage("database error");
                break;
            };
            case $ex instanceof InvalidInputException:{
                SetViewData::setErrorMessage($ex->getMessage());
                break;
            };
            default: {
                throw new Exception();
            };
        }
        
    }

    public abstract function methodSelection(): void;

}
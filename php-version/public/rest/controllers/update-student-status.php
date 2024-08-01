<?php

use Lazaro\StudentCrud\Input\Managers\StudentManager;
use Lazaro\StudentCrud\Input\Utils\Validators\Exceptions\InvalidInputException;
use Lazaro\StudentCrud\Request\Utils\Enums\HTTP_METHODS;
use Lazaro\StudentCrud\Request\Utils\RequestUtils;

require_once "../../../vendor/autoload.php";

execute();

function execute(){
    try{
        methodSelector();
    } catch(mysqli_sql_exception){
        http_response_code(505);
        die;
    } catch(InvalidInputException $ex){
        http_response_code(402);
        die;
    }
}

function methodSelector(){
    if(RequestUtils::methodValidate(HTTP_METHODS::POST)){
        POST();
    }
}

function POST(){
    $json=RequestUtils::getJson();
    $studentManager=new StudentManager();
    $studentManager->updateStatus($json);
}
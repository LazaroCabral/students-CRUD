<?php

use Lazaro\StudentCrud\Input\Managers\StudentManager;
use Lazaro\StudentCrud\Input\Utils\Validators\Exceptions\InvalidInputException;
use Lazaro\StudentCrud\Request\Utils\Enums\HTTP_METHODS;
use Lazaro\StudentCrud\Request\Utils\RequestUtils;
use Lazaro\StudentCrud\View\Data\SetViewData;

require_once "../.././../vendor/autoload.php";

execute();

function execute(){
    try{
        methodSelection();
    } catch(mysqli_sql_exception){
        SetViewData::setErrorMessage("database error");
    } catch(InvalidInputException $ex){
        SetViewData::setErrorMessage($ex->getMessage());
    } finally{
        require_once "../../../views/admin/add-student.php";
    }
}

function methodSelection(){
    if(RequestUtils::methodValidate(HTTP_METHODS::GET)){
        get();
    }
    elseif(RequestUtils::methodValidate(HTTP_METHODS::POST)){
        post();
    }
}

function get(){
    require_once "../../../views/admin/add-student.php";
}

function post(){
    $data= RequestUtils::getContent();   
    $studentManager= new StudentManager();
    $studentManager->insert($data);
    RequestUtils::redirectTo(RequestUtils::SOURCE_PROJECT."/public/controllers/admin/show-students.php");
}
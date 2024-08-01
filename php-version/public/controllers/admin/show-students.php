<?php

use Lazaro\StudentCrud\Request\Utils\Enums\HTTP_METHODS;
use Lazaro\StudentCrud\Request\Utils\RequestUtils;
use Lazaro\StudentCrud\Input\Managers\StudentManager;
use Lazaro\StudentCrud\Render\student\StudentToTable;
use Lazaro\StudentCrud\View\Data\SetViewData;

require_once "../../../vendor/autoload.php";

execute();

function execute(){
    try{
        methodSelector();
    } catch(mysqli_sql_exception){
        SetViewData::setErrorMessage("database error");
    } finally{
        require_once "../../../views/admin/index.php";
    }
}

function methodSelector(){
    if(RequestUtils::methodValidate(HTTP_METHODS::GET)){
        get();
    }
}

function get(){
    //$viewData=&$GLOBALS["view"];
    $studentManager= new StudentManager();
    $students=$studentManager->findAll();
    $toTable=new StudentToTable(null,["style =\"color:blue\""]);
    SetViewData::setRenderFunction("printRowsTable", fn() => $toTable->printRowsTable($students));
}

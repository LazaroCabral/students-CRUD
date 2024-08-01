<?php

use Lazaro\StudentCrud\Controllers\Admin\UpdateStudent;
use Lazaro\StudentCrud\Db\Entities\Student;
use Lazaro\StudentCrud\Input\Managers\StudentManager;
use Lazaro\StudentCrud\Input\Utils\Validators\Exceptions\InvalidInputException;
use Lazaro\StudentCrud\Render\Student\StudentForm;
use Lazaro\StudentCrud\View\Data\SetViewData;
use Lazaro\StudentCrud\Request\Utils\Enums\HTTP_METHODS;
use Lazaro\StudentCrud\Request\Utils\RequestUtils;

require_once "../../../vendor/autoload.php";

execute();

function methodSelection(){
    if(RequestUtils::methodValidate(HTTP_METHODS::GET)){
        GET($_GET);                    
    }
    if(RequestUtils::methodValidate(HTTP_METHODS::POST)){
        POST($_POST);
    }
}

function GET($data){
    $setViewData=new SetViewData();
    $studentManager = new StudentManager();
    $student = $studentManager->findById($data);
    $setViewData->setRenderFunction("printForm",fn() => StudentForm::printForm($student));
}

function POST($data){
    $studentManager=new StudentManager();
    $studentManager->update($data);
    RequestUtils::redirectTo(RequestUtils::SOURCE_PROJECT."/views/admin/index.php");
}
function execute(){
    $setViewData=new SetViewData();
    try{
        methodSelection();
    } catch(mysqli_sql_exception){
        $setViewData->setRenderFunction("printForm",fn() => StudentForm::printForm(new Student(null,null,null,null,null,null,null,null)));
        $setViewData->setErrorMessage("database error");
    } catch(InvalidInputException $ex){
        $studentManager=new StudentManager();
        $setViewData->setRenderFunction("printForm",fn() => StudentForm::printForm($studentManager->findById($_POST)));
        $setViewData->setErrorMessage($ex->getMessage());
    } finally{
        require_once "../../../views/admin/update-student.php";
    }
}

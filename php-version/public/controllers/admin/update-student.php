<?php

use Lazaro\StudentCrud\Input\Managers\StudentManager;
use Lazaro\StudentCrud\Input\Utils\Enums\STUDENT_INPUT_NAMES;
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
    $studentManager = new StudentManager();
    $student = $studentManager->findById($data);
    if($student == null){
        SetViewData::setErrorMessage("usuario não encontrado!");
    }
    SetViewData::setRenderFunction("printForm",fn() => StudentForm::printForm($student));
}

function POST($data){
    $studentManager=new StudentManager();
    if($studentManager->update($data) == false){
        $id=$data[STUDENT_INPUT_NAMES::ID->value];
        RequestUtils::redirectTo(RequestUtils::SOURCE_PROJECT."/public/controllers/admin/update-student.php?id=".$id);
        return;
    }
    RequestUtils::redirectTo(RequestUtils::SOURCE_PROJECT."/public/controllers/admin/show-students.php");
}
function execute(){
    try{
        methodSelection();
    } catch(mysqli_sql_exception){
        SetViewData::setRenderFunction("printForm",fn() => StudentForm::printForm(null));
        SetViewData::setErrorMessage("database error");
    } catch(InvalidInputException $ex){
        if(RequestUtils::methodValidate(HTTP_METHODS::GET)){
            SetViewData::setRenderFunction("printForm",fn() => StudentForm::printForm(null));
            SetViewData::setErrorMessage($ex->getMessage());
        } elseif(RequestUtils::methodValidate(HTTP_METHODS::POST)){
            $student=StudentManager::objectToStudent($_POST);
            SetViewData::setRenderFunction("printForm",fn() => StudentForm::printForm($student));
        }
        SetViewData::setErrorMessage($ex->getMessage());
    } finally{
        require_once "../../../views/admin/update-student.php";
    }
}

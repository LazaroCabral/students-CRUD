<?php

namespace public\controllers\admin;

use Lazaro\StudentCrud\Input\Managers\StudentManager;
use Lazaro\StudentCrud\Input\Utils\Enums\STUDENT_INPUT_NAMES;
use Lazaro\StudentCrud\Input\Utils\Validators\Exceptions\InvalidInputException;
use Lazaro\StudentCrud\Mvc\Controller\Template\AbstractController;
use Lazaro\StudentCrud\Render\Student\StudentForm;
use Lazaro\StudentCrud\View\Data\SetViewData;
use Lazaro\StudentCrud\Request\Utils\Enums\HTTP_METHODS;
use Lazaro\StudentCrud\Request\Utils\RequestUtils;
use mysqli_sql_exception;
use Override;

require_once "../../../vendor/autoload.php";

class UpdateStudent extends AbstractController{

    #[Override()]
    public function methodSelection(): void{
        if(RequestUtils::methodValidate(HTTP_METHODS::GET)){
            $this->GET($_GET);                    
        }
        if(RequestUtils::methodValidate(HTTP_METHODS::POST)){
            $this->POST($_POST);
        }
    }

    private function GET($data){
        $studentManager = new StudentManager();
        $student = $studentManager->findById($data);
        if($student == null){
            SetViewData::setErrorMessage("usuario não encontrado!");
        }
        SetViewData::setRenderFunction("printForm",fn() => StudentForm::printForm($student));
        SetViewData::setView("../../../views/admin/update-student.php");
    }

    private function POST($data){
        $studentManager=new StudentManager();
        if($studentManager->update($data) == false){
            $id=$data[STUDENT_INPUT_NAMES::ID->value];
            RequestUtils::redirectTo(RequestUtils::SOURCE_PROJECT."/public/controllers/admin/update-student.php?id=".$id);
            return;
        }
        RequestUtils::redirectTo(RequestUtils::SOURCE_PROJECT."/public/controllers/admin/show-students.php");
    }
    
    #[Override()]
    public function execute(): void{
        try{
            $this->methodSelection();
        } catch(mysqli_sql_exception $ex){
            SetViewData::setRenderFunction("printForm",fn() => StudentForm::printForm(null));
            parent::exceptionTreatment($ex);
        } catch(InvalidInputException $ex){
            if(RequestUtils::methodValidate(HTTP_METHODS::GET)){
                SetViewData::setRenderFunction("printForm",fn() => StudentForm::printForm(null));
            } elseif(RequestUtils::methodValidate(HTTP_METHODS::POST)){
                $student=StudentManager::objectToStudent($_POST);
                SetViewData::setRenderFunction("printForm",fn() => StudentForm::printForm($student));
            }
            parent::exceptionTreatment($ex);
        } finally{
            if(SetViewData::getView()!=null){
                require SetViewData::getView();
            }
        }
    }
}

$updateStudent=new UpdateStudent();
$updateStudent->execute();

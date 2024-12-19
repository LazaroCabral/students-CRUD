<?php

namespace public\controllers\admin;

use Lazaro\StudentCrud\Input\Managers\StudentManager;
use Lazaro\StudentCrud\Input\Utils\Enums\STUDENT_INPUT_NAMES;
use Lazaro\StudentCrud\Input\Utils\Validators\Exceptions\InvalidInputException;
use Lazaro\StudentCrud\Mvc\Controller\Methods\Get;
use Lazaro\StudentCrud\Mvc\Controller\Methods\Post;
use Lazaro\StudentCrud\Mvc\Controller\Template\AbstractMvcController;
use Lazaro\StudentCrud\Render\Student\StudentForm;
use Lazaro\StudentCrud\Request\Utils\Enums\HTTP_METHODS;
use Lazaro\StudentCrud\Request\Utils\RequestUtils;
use mysqli_sql_exception;
use Override;

require_once "../../../vendor/autoload.php";

class UpdateStudent extends AbstractMvcController implements Get,Post{

    public function get(): void{
        $studentManager = new StudentManager();
        $student = $studentManager->findById(RequestUtils::getContent());
        if($student == null){
            $this->viewData->setErrorMessage("usuario não encontrado!");
        }
        $this->viewData->setRenderFunction("printForm",fn() => StudentForm::printForm($student));
        $this->viewData->setView("../../../views/admin/update-student.php");
    }

    public function post(): void{
        $studentManager=new StudentManager();
        $data=RequestUtils::getContent();
        if($studentManager->update($data) == false){
            $id=$data[STUDENT_INPUT_NAMES::ID->value];
            RequestUtils::redirectTo(RequestUtils::SOURCE_PROJECT."/public/controllers/admin/update-student.php?id=".$id);
            return;
        }
        RequestUtils::redirectTo(RequestUtils::SOURCE_PROJECT."/public/controllers/admin/show-students.php");
    }

    #[Override()]
    public function exceptionTreatment(\Exception $ex): void{
        switch($ex){
            case $ex instanceof mysqli_sql_exception:{
                $this->viewData->setRenderFunction("printForm",fn() => StudentForm::printForm(null));
            }
            case $ex instanceof InvalidInputException:{
                if(RequestUtils::methodValidate(HTTP_METHODS::GET)){
                    $this->viewData->setRenderFunction("printForm",fn() => StudentForm::printForm(null));
                } elseif(RequestUtils::methodValidate(HTTP_METHODS::POST)){
                    $student=StudentManager::objectToStudent($_POST);
                    $this->viewData->setRenderFunction("printForm",fn() => StudentForm::printForm($student));
                }
            }
        }
        parent::exceptionTreatment($ex);  
    }
}

$updateStudent=new UpdateStudent();
$updateStudent->execute();

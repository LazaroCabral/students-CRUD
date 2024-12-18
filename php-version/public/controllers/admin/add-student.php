<?php

namespace public\controllers\admin;

use Exception;
use Lazaro\StudentCrud\Input\Managers\StudentManager;
use Lazaro\StudentCrud\Input\Utils\Validators\Exceptions\InvalidInputException;
use Lazaro\StudentCrud\Mvc\Controller\Methods\Get;
use Lazaro\StudentCrud\Mvc\Controller\Methods\Post;
use Lazaro\StudentCrud\Mvc\Controller\Template\AbstractController;
use Lazaro\StudentCrud\Request\Utils\Enums\HTTP_METHODS;
use Lazaro\StudentCrud\Request\Utils\RequestUtils;
use Lazaro\StudentCrud\View\Data\SetViewData;
use Override;

require_once "../.././../vendor/autoload.php";

class AddStudent extends AbstractController implements Get,Post{

    public function get(): void{
        SetViewData::setView("../../../views/admin/add-student.php");
    }

    public function post(): void{
        $data= RequestUtils::getContent();   
        $studentManager= new StudentManager();
        $studentManager->insert($data);
        RequestUtils::redirectTo("/public/controllers/admin/show-students.php");
    }

    #[Override()]
    public function exceptionTreatment(Exception $ex): void{
        if($ex instanceof InvalidInputException 
            && RequestUtils::methodValidate(HTTP_METHODS::POST)){
                SetViewData::setView("../../../views/admin/add-student.php");
        }
        parent::exceptionTreatment($ex);
    }
}

$addStudent=new AddStudent();
$addStudent->execute();

<?php

namespace public\controllers\admin;

use Exception;
use Lazaro\StudentCrud\Input\Managers\StudentManager;
use Lazaro\StudentCrud\Input\Utils\Validators\Exceptions\InvalidInputException;
use Lazaro\StudentCrud\Mvc\Controller\Support\Methods\Get;
use Lazaro\StudentCrud\Mvc\Controller\Support\Methods\Post;
use Lazaro\StudentCrud\Mvc\Controller\Support\Template\AbstractMvcController;
use Lazaro\StudentCrud\Request\Utils\Enums\HTTP_METHODS;
use Lazaro\StudentCrud\Request\Utils\RequestUtils;

use Override;

require_once "../.././../vendor/autoload.php";

class AddStudent extends AbstractMvcController implements Get,Post{

    protected function defaultView(): string | null{
        return '../../../views/admin/add-student.php';
    }

    public function get(): void{
        $this->viewData->setView($this->defaultView());
    }

    public function post(): void{
        $data= RequestUtils::getContent();   
        $studentManager= new StudentManager();
        $studentManager->insert($data);
        RequestUtils::redirectTo("/public/controllers/admin/show-students.php");
    }

    #[Override()]
    public function exceptionHandler(Exception $ex): void{
        if($ex instanceof InvalidInputException 
            && RequestUtils::methodValidate(HTTP_METHODS::POST)){
                $this->viewData->setView($this->defaultView());
        }
        parent::exceptionHandler($ex);
    }
}

$addStudent=new AddStudent();
$addStudent->execute();

<?php

use Lazaro\StudentCrud\Input\Managers\StudentManager;
use Lazaro\StudentCrud\Input\Utils\Validators\Exceptions\InvalidInputException;
use Lazaro\StudentCrud\Mvc\Controller\Methods\Post;
use Lazaro\StudentCrud\Mvc\Controller\Template\AbstractRestController;
use Lazaro\StudentCrud\Request\Utils\Enums\HTTP_METHODS;
use Lazaro\StudentCrud\Request\Utils\RequestUtils;

require_once "../../../vendor/autoload.php";

class UpdateStudentStatus extends AbstractRestController implements Post{

    public function post(): void{
        $json=RequestUtils::getJson();
        $studentManager=new StudentManager();
        $studentManager->updateStatus($json);
    }
}

$updateStudentStatus=new UpdateStudentStatus();
$updateStudentStatus->execute();
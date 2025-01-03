<?php

use Lazaro\StudentCrud\Input\Managers\StudentManager;
use Lazaro\StudentCrud\Mvc\Controller\Support\Methods\Post;
use Lazaro\StudentCrud\Mvc\Controller\Support\Template\AbstractRestController;
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
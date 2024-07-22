<?php

namespace Lazaro\StudentCrud\Rest\Controllers\Admin;

use Lazaro\StudentCrud\Input\Managers\StudentManager;
use Lazaro\StudentCrud\Request\Utils\RequestUtils;

class UpdateStudentStatus{

    function POST(){
        $json=RequestUtils::getJson();
        $studentManager=new StudentManager();
        $studentManager->updateStatus($json);
    }

}
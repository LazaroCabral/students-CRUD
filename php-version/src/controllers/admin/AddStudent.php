<?php

namespace Lazaro\StudentCrud\Controllers\Admin;

use Lazaro\StudentCrud\Input\Managers\StudentManager;
use Lazaro\StudentCrud\Request\Utils\RequestUtils;

class AddStudent{

    function POST($data){
        $studentManager= new StudentManager();
        $studentManager->insert($data);
        RequestUtils::redirectTo(RequestUtils::SOURCE_PROJECT."/templates/php/index.php");
    }

}
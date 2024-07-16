<?php

namespace Lazaro\StudentCrud\Controllers\Admin;

use Lazaro\StudentCrud\Managers\StudentManager;
use Lazaro\StudentCrud\Render\Student\StudentForm;
use Lazaro\StudentCrud\Request\Utils\RequestUtils;

class UpdateStudent{

    function GET($data){
        $studentManager = new StudentManager();
        $student = $studentManager->findById($data);
        StudentForm::printForm($student);
    }

    function POST($data){
        $studentManager=new StudentManager();
        $studentManager->update($data);
        RequestUtils::redirectTo(RequestUtils::SOURCE_PROJECT."/templates/php/update-student.php?id=".$data['id']);
    }
}
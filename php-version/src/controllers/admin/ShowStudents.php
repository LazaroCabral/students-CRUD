<?php

namespace Lazaro\StudentCrud\Controllers\Admin;

use Lazaro\StudentCrud\Input\Managers\StudentManager;
use Lazaro\StudentCrud\Render\student\StudentToTable;

class ShowStudents{

    function GETTest(){
        echo "get test";
    }

    function GET(){
        $studentManager= new StudentManager();
        $toTable=new StudentToTable(null,["style =\"color:blue\""]);
        $toTable->printRowsTable($studentManager->findAll());
    }

}
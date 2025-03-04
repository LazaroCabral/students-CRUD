<?php

namespace public\controllers\admin;

use Lazaro\StudentCrud\Mvc\Controller\Support\Methods\Get;
use Lazaro\StudentCrud\Mvc\Controller\Support\Template\AbstractMvcController;
use Lazaro\StudentCrud\Input\Managers\StudentManager;
use Lazaro\StudentCrud\Render\Student\StudentToTable;

require_once "../../../vendor/autoload.php";

class ShowStudents extends AbstractMvcController implements Get{

    protected function defaultView(): string | null{
        return '../../../views/admin/index.php';
    }

    public function get(): void{
        $studentManager= new StudentManager();
        $students=$studentManager->findAll();
        $toTable=new StudentToTable(null,["style =\"color:blue\""]);
        $this->viewData->setRenderFunction("printRowsTable", fn() => $toTable->printRowsTable($students));
    }
}

$showStudents=new ShowStudents();
$showStudents->execute();
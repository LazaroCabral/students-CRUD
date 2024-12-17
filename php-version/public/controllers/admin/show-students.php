<?php

namespace public\controllers\admin;

use Lazaro\StudentCrud\Mvc\Controller\Template\AbstractController;
use Lazaro\StudentCrud\Request\Utils\Enums\HTTP_METHODS;
use Lazaro\StudentCrud\Request\Utils\RequestUtils;
use Lazaro\StudentCrud\Input\Managers\StudentManager;
use Lazaro\StudentCrud\Render\Student\StudentToTable;
use Lazaro\StudentCrud\View\Data\SetViewData;
use Override;

require_once "../../../vendor/autoload.php";

class ShowStudents extends AbstractController{
    
    #[Override()]
    public function methodSelection(): void{
        if(RequestUtils::methodValidate(HTTP_METHODS::GET)){
            $this->get();
        }
    }

    private function get(): void{
        $studentManager= new StudentManager();
        $students=$studentManager->findAll();
        $toTable=new StudentToTable(null,["style =\"color:blue\""]);
        SetViewData::setRenderFunction("printRowsTable", fn() => $toTable->printRowsTable($students));
        SetViewData::setView("../../../views/admin/index.php");
    }
}

$showStudents=new ShowStudents();
$showStudents->execute();
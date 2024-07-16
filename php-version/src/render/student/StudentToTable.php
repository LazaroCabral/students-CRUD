<?php

namespace Lazaro\StudentCrud\Render\student;

use Lazaro\StudentCrud\Render\Abstract\AbstractToTable;
use Lazaro\StudentCrud\Render\Student\Utils\StudentRenderUtils;
use Lazaro\StudentCrud\Request\Utils\RequestUtils;

class StudentToTable extends AbstractToTable{

    public function __construct(array $rowProperties=null,array $cellProperties=null) {
        parent::__construct($rowProperties,$cellProperties);
    }

    protected function rowTable($row): string{
        return "<tr".$this->rowProperties.">".
        $this->cellTable(
            "<a href=./update-student.php?id=".$row->getId().">".
            $row->getName().
            "</a>"
        ).
        $this->cellTable(
            "email: ".$row->getEmail().",<br>".
            "telefone: ".$row->getPhone().",<br>".
            "mensalidade: R$".$row->getValuePerMonth().",<br>"
        ).
        $this->cellTable(
            StudentRenderUtils::studentStatusIsActive($row->getStatus(),["name=status","type=checkbox","id=".$row->GetId().""])
        ).
        "</tr>\n";
    }

}
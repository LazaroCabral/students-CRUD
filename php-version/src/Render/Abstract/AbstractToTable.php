<?php

namespace Lazaro\StudentCrud\Render\Abstract;

use Lazaro\StudentCrud\Render\Student\Utils\StudentRenderUtils;

abstract class AbstractToTable{

    protected $rowProperties;
    protected $cellProperties;

    public function __construct(array | null $rowProperties=null,array | null $cellProperties=null) {
        $this->rowProperties=StudentRenderUtils::hasProperties($rowProperties);
        $this->cellProperties=StudentRenderUtils::hasProperties($cellProperties);
    }

    protected abstract function rowTable($row): string;

    public function printRowsTable(array $rows){
        foreach($rows as $row){
            echo $this->rowTable($row);
        }
    }

    protected function cellTable($cell): string{
        return "<td".$this->cellProperties.">".$cell."</td>\n";
    }
}
<?php

namespace Lazaro\StudentCrud\Application\Exception\Handlers;

abstract class AbstractExceptionHandler implements ExceptionHandlerInterface{

    private ExceptionHandlerInterface | null $nextFilter=null;

    public function execute(\Exception $ex): void{
        if($this->nextFilter!=null){
            $this->nextFilter->execute($ex);
        }
    }

    public function setNext(ExceptionHandlerInterface &$filter): void{
        $this->nextFilter=$filter;
    }

}
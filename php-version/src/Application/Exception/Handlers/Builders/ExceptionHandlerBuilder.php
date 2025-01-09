<?php

namespace Lazaro\StudentCrud\Application\Exception\Handlers\Builders;

use Lazaro\StudentCrud\Application\Exception\Handlers\ExceptionHandlerInterface;

class ExceptionHandlerBuilder{

    private ExceptionHandlerInterface | null $firstHandler=null;

    private ExceptionHandlerInterface | null $lastHandler=null;

    public function addHandler(ExceptionHandlerInterface $handler): ExceptionHandlerBuilder{
        if($this->firstHandler==null){
            $this->firstHandler=&$handler;
            $this->lastHandler=&$handler;
        } else{
            $this->lastHandler->setNext($handler);
            $this->lastHandler=&$handler;
        }
        return $this;
    }

    public function create(): ExceptionHandlerInterface{
        return $this->firstHandler;
    }


}
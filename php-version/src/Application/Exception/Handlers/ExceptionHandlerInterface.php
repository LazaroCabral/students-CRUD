<?php

namespace Lazaro\StudentCrud\Application\Exception\Handlers;

interface ExceptionHandlerInterface{

    public function execute(\Exception $ex):void;

    public function setNext(ExceptionHandlerInterface &$handler):void;

}
<?php

namespace Lazaro\StudentCrud\Response\Data;

abstract class AbstractResponseData implements ResponseDataInterface{

    protected string $prefix;

    protected function __construct(string $prefix) {
        $this->prefix=$prefix;
    }

    public function setErrorMessage(string $message): void{
        $GLOBALS[$this->prefix]['errorMessage']=$message;
    }

    public function getErrorMessage(): string | null{
        return $GLOBALS[$this->prefix]['errorMessage'];
    }

    public function setErrorDescription(string $description): void{
        $GLOBALS[$this->prefix]['errorDescription']=$description;
    }

    public function getErrorDescription(): string | null{
        return $GLOBALS[$this->prefix]['errorDescription'];
    }

    public function setData(string $name,$data): void{
        $GLOBALS[$this->prefix][$name]=$data;
    }

    public function getData(string $name): mixed{
        return $GLOBALS[$this->prefix][$name];
    }

}
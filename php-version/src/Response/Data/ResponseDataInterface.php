<?php

namespace Lazaro\StudentCrud\Response\Data;

interface ResponseDataInterface{
    public function setErrorMessage(string $message): void;

    public function getErrorMessage(): string | null;

    public function setData(string $name,$data): void;

    public function getData(string $name): mixed;

}
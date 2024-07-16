<?php

namespace Lazaro\StudentCrud\Db\Entities;

use Lazaro\StudentCrud\DTO\Student\Utils\Enums\INPUT_NAMES;

class Student{

    public const TABLE_NAME="students2";

    private $id;
    private $name;
    private $email;
    private $phone;
    private $valuePerMonth;
    private $password;
    private $status;
    private $observation;

    public function __construct($id,$name,$email,$phone,$valuePerMonth,$password,$status,$observation) {
        $this->id=$id;
        $this->name=$name;
        $this->email=$email;
        $this->phone=$phone;
        $this->valuePerMonth=$valuePerMonth;
        $this->password=$password;
        $this->status=$status;
        $this->observation=$observation;
    }

    function getId(){
        return $this->id;
    }
    function getName(){
        return $this->name;
    }
    function getEmail(){
        return $this->email;
    }
    function getPhone(){
        return $this->phone;
    }
    function getValuePerMonth(){
        return $this->valuePerMonth;
    }
    function getPassword(){
        return $this->password;
    }
    function getStatus(){
        return $this->status;
    }
    function getObservation(){
        return $this->observation;
    }

}
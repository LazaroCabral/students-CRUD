<?php

namespace Lazaro\StudentCrud\Input\Utils\Validators;

use Lazaro\StudentCrud\Input\Utils\Enums\STUDENT_INPUT_NAMES;
use Lazaro\StudentCrud\Input\Utils\Validators\Exceptions\InvalidInputException;

class StudentValidator{

    static function allFieldsIsvalid($json){
        StudentValidator::nameIsValid($json);
        StudentValidator::emailIsValid($json);
        StudentValidator::phoneIsValid($json);
        StudentValidator::valuePerMonthIsValid($json);
        StudentValidator::passwordIsValid($json);
        StudentValidator::statusIsValid($json);
    }

    static function idIsValid($data){
        $id=$data[STUDENT_INPUT_NAMES::ID->value];
        if($id == null || $id == "" || $id > "2147483647" || preg_match("/^\d+$/",$id) != 1)
            throw new InvalidInputException("id invalido!");
    }
    static function nameIsValid($data){
        $name=$data[STUDENT_INPUT_NAMES::NAME->value];
        if(empty($name) || strlen($name) > 40 || preg_match("/^[a-zA-Z]+$/",$name) !=1)
            throw new InvalidInputException("nome invalido!");
    }
    static function emailIsValid($data){
        $email=$data[STUDENT_INPUT_NAMES::EMAIL->value];
        if(empty($email) || strlen($email) > 40 || 
        preg_match("/^\w+[@]\w+\.\w+$/",$email) != 1)
            throw new InvalidInputException("email invalido!");
    }
    static function phoneIsValid($data){
        $phone=$data[STUDENT_INPUT_NAMES::PHONE->value];
        if(empty($phone) || strlen($phone) != 11 ||
        preg_match("/^\d+$/",$phone) != 1)
            throw new InvalidInputException("telefone invalido!");
    }
    static function valuePerMonthIsValid($data){
        $valuePerMonth=$data[STUDENT_INPUT_NAMES::VALUE_PER_MONTH->value];
        if($valuePerMonth == "" || $valuePerMonth == null || preg_match("/^\d{1,4}[\.]\d{2}$/",$valuePerMonth) != 1)
                throw new InvalidInputException("mensalidade invalida!");
    }
    static function passwordIsValid($data){
        $password=$data[STUDENT_INPUT_NAMES::PASSWORD->value];
        if($password == "" || $password == null || strlen($password) > 40)
            throw new InvalidInputException("senha invalida!");
    }
    static function statusIsValid($data){
        $status=$data[STUDENT_INPUT_NAMES::STATUS->value];
        if($status == null || $status == "" || preg_match("/^[01]$/",$status) != 1)
            throw new InvalidInputException("status invalido!");
    }
    static function observationIsValid($data){
        $observation=$data[STUDENT_INPUT_NAMES::ID->value];
        if($observation == "" || $observation == null || strlen($observation) > 255)
            throw new InvalidInputException("observação invalida!");
    }
}
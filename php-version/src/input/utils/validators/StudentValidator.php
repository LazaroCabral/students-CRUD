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
        if(empty($id))
            throw new InvalidInputException("id invalido!");
    }
    static function nameIsValid($data){
        $name=$data[STUDENT_INPUT_NAMES::NAME->value];
        if(empty($name))
            throw new InvalidInputException("nome invalido!");
    }
    static function emailIsValid($data){
        $email=$data[STUDENT_INPUT_NAMES::EMAIL->value];
        if(empty($email) || preg_match("/^\w+[@]\w+\.\w+$/",$email) != 1)
            throw new InvalidInputException("email invalido!");
    }
    static function phoneIsValid($data){
        $phone=$data[STUDENT_INPUT_NAMES::PHONE->value];
        if(empty($phone) || preg_match("/^\d{11}$/",$phone) != 1)
            throw new InvalidInputException("telefone invalido!");
    }
    static function valuePerMonthIsValid($data){
        $valuePerMonth=$data[STUDENT_INPUT_NAMES::VALUE_PER_MONTH->value];
        if(empty($valuePerMonth) || preg_match("/^\d{1,4}[\.]\d{2}$/",$valuePerMonth) != 1)
                throw new InvalidInputException("mensalidade invalida!");
    }
    static function passwordIsValid($data){
        $password=$data[STUDENT_INPUT_NAMES::PASSWORD->value];
        if(empty($password))
            throw new InvalidInputException("senha invalida!");
    }
    static function statusIsValid($data){
        $status=$data[STUDENT_INPUT_NAMES::STATUS->value];
        if(empty($status))
            throw new InvalidInputException("status invalido!");
    }
    static function observationIsValid($data){
        $observation=$data[STUDENT_INPUT_NAMES::ID->value];
        if(empty($observation))
            throw new InvalidInputException("observação invalida!");
    }
}
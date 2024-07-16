<?php

namespace Lazaro\StudentCrud\Validators;

use Lazaro\StudentCrud\Validators\Utils\Enums\STUDENT_INPUT_NAMES;
use Lazaro\StudentCrud\Validators\Utils\Exceptions\InvalidInputException;

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
        $id !=null && $id != "" ? : throw new InvalidInputException("id invalido!");
    }
    static function nameIsValid($data){
        $name=$data[STUDENT_INPUT_NAMES::NAME->value];
        $name != null && $name != "" ? : throw new InvalidInputException("nome invalido!");
    }
    static function emailIsValid($data){
        $email=$data[STUDENT_INPUT_NAMES::EMAIL->value];
        $email !=null && $email != "" ? : throw new InvalidInputException("email invalido!");
    }
    static function phoneIsValid($data){
        $phone=$data[STUDENT_INPUT_NAMES::PHONE->value];
        $phone !=null && $phone != "" ? : throw new InvalidInputException("telefone invalido!");
    }
    static function valuePerMonthIsValid($data){
        $valuePerMonth=$data[STUDENT_INPUT_NAMES::VALUE_PER_MONTH->value];
        $valuePerMonth !=null && $valuePerMonth != "" ? :throw new InvalidInputException("mensalidade invalida!"); 
    }
    static function passwordIsValid($data){
        $password=$data[STUDENT_INPUT_NAMES::PASSWORD->value];
        $password !=null && $password != "" ? : throw new InvalidInputException("senha invalida!");
    }
    static function statusIsValid($data){
        $status=$data[STUDENT_INPUT_NAMES::STATUS->value];
        $status !=null && $status != "" ? : throw new InvalidInputException("status invalido!");
    }
    static function observationIsValid($data){
        $observation=$data[STUDENT_INPUT_NAMES::ID->value];
        $observation !=null && $observation != "" ? : throw new InvalidInputException("observação invalida!");
    }
}
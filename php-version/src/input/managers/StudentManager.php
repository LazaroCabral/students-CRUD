<?php

namespace Lazaro\StudentCrud\Input\Managers;

use Lazaro\StudentCrud\Db\DAO\StudentDAO;
use Lazaro\StudentCrud\Db\Entities\Student;
use Lazaro\StudentCrud\Input\Utils\Converters\StudentInputConverter;
use Lazaro\StudentCrud\Input\Utils\Enums\STUDENT_INPUT_NAMES;
use Lazaro\StudentCrud\Input\Utils\Validators\StudentValidator;

class StudentManager{

    private StudentDAO $studentDAO;

    public function __construct() {
        $this->studentDAO=new StudentDAO();
    }

    private function updateInputIsValid($data){
        StudentValidator::idIsValid($data);
        StudentValidator::nameIsValid($data);
        StudentValidator::emailIsValid($data);
        StudentValidator::phoneIsValid($data);
        StudentValidator::passwordIsValid($data);
        StudentValidator::valuePerMonthIsValid($data);
        StudentValidator::observationIsValid($data);
    }

    private function insertInputIsvalid($data){
        StudentValidator::nameIsValid($data);
        StudentValidator::emailIsValid($data);
        StudentValidator::phoneIsValid($data);
        StudentValidator::valuePerMonthIsValid($data);
        StudentValidator::passwordIsValid($data);
    }

    function updateStatusInputIsValid($data){
        StudentValidator::statusIsValid($data);
        StudentValidator::idIsValid($data);
    }

    public function findAll(){
        return $this->studentDAO->findAll();
    }

    public function findById($data): Student{
        StudentValidator::idIsValid($data);
        $id=$data[STUDENT_INPUT_NAMES::ID->value];
        return $this->studentDAO->findById($id);
    }

    public function insert($data){
        $this->insertInputIsvalid($data);
        StudentInputConverter::convertAllFields($data);
        $student = self::objectToStudent($data);
        $this->studentDAO->insert($student);
    }

    public function update($data){
        $this->updateInputIsValid($data);
        StudentInputConverter::convertAllFields($data);
        $student= self::objectToStudent($data);
        $this->studentDAO->update($student);
    }

    public function updateStatus($data){
        $this->updateStatusInputIsValid($data);
        StudentInputConverter::convertAllFields($data);
        $id=$data[STUDENT_INPUT_NAMES::ID->value];
        $status=$data[STUDENT_INPUT_NAMES::STATUS->value];
        $this->studentDAO->updateStatus($status,$id);
    }

    public function delete($data){
        StudentValidator::idIsValid($data);
        $id=$data[STUDENT_INPUT_NAMES::ID->value];
        $this->delete($id);
    }

    public static function objectToStudent($obj): Student{
        return new Student(
            $obj[STUDENT_INPUT_NAMES::ID->value],
            $obj[STUDENT_INPUT_NAMES::NAME->value],
            $obj[STUDENT_INPUT_NAMES::EMAIL->value],
            $obj[STUDENT_INPUT_NAMES::PHONE->value],
            $obj[STUDENT_INPUT_NAMES::VALUE_PER_MONTH->value],
            $obj[STUDENT_INPUT_NAMES::PASSWORD->value],
            $obj[STUDENT_INPUT_NAMES::STATUS->value],
            $obj[STUDENT_INPUT_NAMES::OBSERVATION->value]);
    }

    public static function studentToObject(Student $student){
        return array(
            "id" => $student->getId(),
            "name" => $student->getName(),
            "email" => $student->getEmail(),
            "phone" => $student->getPhone(),
            "value_per_month" => $student->getValuePerMonth(),
            "password" => $student->getPassword(),
            "status" => $student->getStatus(),
            "observation" => $student->getObservation());
    }

}
<?php

namespace Lazaro\StudentCrud\Managers;

use Lazaro\StudentCrud\Db\DAO\StudentDAO;
use Lazaro\StudentCrud\Db\Entities\Student;
use Lazaro\StudentCrud\Managers\Utils\InputConverter;
use Lazaro\StudentCrud\Validators\StudentValidator;
use Lazaro\StudentCrud\Validators\Utils\Enums\STUDENT_INPUT_NAMES;

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
        @$id=$data["id"];
        StudentValidator::idIsValid($id);
        return $this->studentDAO->findById($id);
    }

    public function insert($data){
        $this->insertInputIsvalid($data);
        $inputStatus=$data["status"];
        $data["status"]=InputConverter::statusConveter($inputStatus);
        $student = self::objectToStudent($data);
        $this->studentDAO->insert($student);
    }

    public function update($data){
        $this->updateInputIsValid($data);
        $data["status"]=InputConverter::statusConveter($data["status"]);
        $student= self::objectToStudent($data);
        $this->studentDAO->update($student);
    }

    public function updateStatus($data){
        $this->updateStatusInputIsValid($data);
        $id=$data["id"];
        $status=InputConverter::statusConveter($data["status"]);
        echo $status;
        $this->studentDAO->updateStatus($status,$id);
    }

    public function delete($json){
        StudentValidator::idIsValid($json);
        $this->delete($json->id);
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
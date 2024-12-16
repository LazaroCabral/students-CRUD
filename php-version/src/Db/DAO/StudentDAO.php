<?php

namespace Lazaro\StudentCrud\Db\DAO;

use Lazaro\StudentCrud\Db\Databases\DatabasesConnections;
use Lazaro\StudentCrud\Db\Entities\Student;
use mysqli;

class StudentDAO{
    
    private mysqli $connection;

    public function __construct() {
        $this->connection = DatabasesConnections::getDefaultDatabase();
    }

    private function convertRowsToStudents($sqlRows): array{
        $students=[];
        while($row=mysqli_fetch_object($sqlRows)){
            $student=new Student($row->id,$row->name,$row->email,$row->phone,$row->value_per_month,$row->password,$row->status,$row->observation);
            array_push($students,$student);
        }
        return $students;
    }

    public function findAll(): array{
        $result=$this->connection->query("SELECT * FROM ".Student::TABLE_NAME.";");
        return $this->convertRowsToStudents($result);
    }

    public function findById($id): Student|null{
        $result=$this->connection->query("SELECT * FROM ".Student::TABLE_NAME." WHERE id=".$id.";");
        return @$this->convertRowsToStudents($result)[0];
    }

    public function insert(Student $student): bool{
        $this->connection->query("INSERT INTO ".Student::TABLE_NAME."(name,email,phone,value_per_month,password,status,observation) ".
            "VALUES ('".$student->getName()."','".$student->getEmail()."','".$student->getPhone()."',".$student->getValuePerMonth().","
            ."'".$student->getPassword()."','".$student->getStatus()."','".$student->getObservation()."');");
        return $this->connection->affected_rows == 1 ? true : false;
    }

    public function update(Student $student): bool{
        $this->connection->query("UPDATE ".Student::TABLE_NAME." SET name='".$student->getName()."'".
            ",email='".$student->getEmail()."',phone='".$student->getPhone()."',value_per_month='".$student->getValuePerMonth()."'".
            ",password='".$student->getPassword()."',status=".$student->getStatus().",observation='".$student->getObservation()."' WHERE id=".$student->getId().";");
        return $this->connection->affected_rows == 1? true:false;
    }

    public function updateStatus($status,$id): bool{
        $this->connection->query("UPDATE ".Student::TABLE_NAME." SET status=".$status." WHERE id=".$id.";");
        return $this->connection->affected_rows == 1 ? true : false; 
    }

    public function delete(Student $student): bool{
        $this->connection->query("DELETE FROM ".Student::TABLE_NAME." WHERE id=".$student->getId().";");
        return $this->connection->affected_rows == 1 ? true : false;
    }

}
<?php

namespace Lazaro\StudentCrud\Db\Databases;

class DatabasesConnections{

    private static $connection=null;

    public static function getDefaultDatabase(){
        if(DatabasesConnections::$connection == null){
            DatabasesConnections::$connection=mysqli_connect("localhost","lazaro","1234","students_crud",3306);
            return DatabasesConnections::$connection;
        } else{
            return DatabasesConnections::$connection;
        }
    }
}
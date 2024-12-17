<?php

namespace Lazaro\StudentCrud\Db\Databases;

class DatabasesConnections{

    private static $connection=null;

    public static function getDefaultDatabase(){
        if(DatabasesConnections::$connection == null){
            DatabasesConnections::$connection=mysqli_connect($_ENV['SC_DB_HOSTNAME'],$_ENV['SC_DB_USERNAME'],$_ENV["SC_DB_PASSWORD"],$_ENV['SC_DB_DATABASE'],$_ENV['SC_DB_PORT']);
            return DatabasesConnections::$connection;
        } else{
            return DatabasesConnections::$connection;
        }
    }
}
<?php
    checkFirstStart();
    function getDB() {
        $host = "db";
        $user = "user";
        $password = "pw";
        $database = "main";

        try {
            $db = mysqli_connect($host, $user, $password, $database);
        } catch(Exception $e) {
            $db = null;
        }

        return $db;
    }

    function checkFirstStart() {
        $host = "db";
        $user = "user";
        $password = "pw";
        $database = "main";

        try {
            $db = mysqli_connect($host, $user, $password, $database);
        } catch(Exception $e) {
            $db = null;
            echo $e->getMessage();
        }

        if($db) {
            $query = "CREATE DATABASE IF NOT EXISTS $database";
            mysqli_query($db, $query);

            $query = "CREATE TABLE IF NOT EXISTS users (
                            ID int(11) AUTO_INCREMENT,
                            USERNAME varchar(255) NOT NULL,
                            PASSWORD varchar(255) NOT NULL,
                            PRIMARY KEY  (ID)
                            )";

            mysqli_query($db, $query);
            $db->close();
        }
    }
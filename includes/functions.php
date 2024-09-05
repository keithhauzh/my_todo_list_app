<?php

    // connection to database
    function connectToDB() {
        $host = "localhost";
        $database_name = "my_todo_list_app";
        $database_user = "root";
        $database_password = "mysql";

        $database = new PDO (
        "mysql:host=$host;dbname=$database_name",
        $database_user, //username
        $database_password //password
        );

        return $database;
    }

    //set error message
    function setError( $message, $redirect ) {
        $_SESSION['error'] = $message;
        //redirect back to selected page
        header("Location: " . $redirect);
        exit;
    }
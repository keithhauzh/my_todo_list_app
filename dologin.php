<?php
// put your backend code

// start session (we will be using session in this page)
session_start();

// 1. collect database info
// $host = "localhost"; // for windows user
// $host = "127.0.0.1";  // for mac user
$host = 'localhost';
$database_name = "my_todo_list_app"; // connecting to which database 
$database_user = "root";
$database_password = "mysql";

// 2. connect to database (PDO - PHP database object)
$database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user, // username
    $database_password // password
);

//3. get all the data from the login page form
$email = $_POST['email'];
$password = $_POST['password'];

//4. check for error (make sure all the fields are filled and that the password is correct)
if ( empty($email) || empty($password) ) {
    echo "Please fill in all the fields!";
} else {
    //5. check if the email entered is registered in our database or not
    //5.1 sql command
    $sql = "SELECT * FROM users WHERE email = :email";    

    //5.2 prepare
    $query = $database -> prepare($sql);

    //5.3 execute
    $query -> execute([
        'email' => $email
    ]);

    //5.4 fetch
    $user = $query -> fetch(); //return the first row starting from the query row

    //check if email exists in database
    if ($user) {
        //6. check if the password is correct
        if( password_verify ($password, $user["password"]) ) {
            //7.login the user
            $_SESSION['loggeduser'] = $user;

            //8. redirect back to main page
            header("Location:index.php");
            exit;
        } else {
            echo "The password provided is incorrect, please try again.";
        }
    } else {
        echo "This email is not registered inside our database.";
    }
}


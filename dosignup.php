<?php
// put your backend code

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

//3. get all the data from the signup page form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

//4. check all fields (if they are empty or not and if both passwords are the same)
if ( empty($name) || empty($email) || empty($password) || empty($confirm_password) ) {
    echo "Please fill up all fields!";
} else if ($password !== $confirm_password){
    echo "Passwords do not match!";
} else if (strlen ($password) < 8) {
    echo "Your password needs to be at least 8 characters long";
} else {
    //create a user account 
    $sql = "INSERT INTO users (`name` , `email` , `password`) VALUES (:name, :email, :password)";

    //prepare 
    $query = $database -> prepare($sql);

    //execute 
    $query->execute([
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT) //password default is an algorithim that is used by php for hashing the password
    ]);

    header("Location:index.php");
    exit;
}


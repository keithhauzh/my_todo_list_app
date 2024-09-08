<?php
// put your backend code

// connect to the database
$database = connectToDB();   

//3. get all the data from the signup page form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

//4. check all fields (if they are empty or not and if both passwords are the same)
if ( empty($name) || empty($email) || empty($password) || empty($confirm_password) ) {
    setError("Please fill in all fields", '/signup');
} else if ($password !== $confirm_password){
    setError("Please make sure all passwords entered are the same", '/signup');
} else if (strlen ($password) < 8) {
    setError("Please make sure your password is at least 8 characters long", '/signup');
} else {    
    //check if the email is already in use or not
    //sql command
    $sql = "SELECT * FROM users WHERE email = :email";

    //prepare
    $query = $database -> prepare($sql);

    //execute
    $query -> execute ([
        'email' => $email
    ]);

    //fetch 
    $user = $query -> fetch(); //return the first row starting from the query form

    if( $user ) {
        setError("The email provided is already registered in our database", '/signup');
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

        header("Location: /login");
        exit;
    }
   
}


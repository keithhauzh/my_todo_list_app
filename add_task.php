<?php 
 
 $host = "localhost";
 $database_name = "my_todo_list_app";
 $database_user = "root";
 $database_password = "mysql";

 $database = new PDO (
   "mysql:host=$host;dbname=$database_name",
   $database_user, //username
   $database_password //password
 );

 $label = $_POST['label_name'];

 if (empty ($label)) {
    echo "Please insert a task label!";
 } else {
    $sql = 'INSERT INTO todos (`label`) VALUES (:label)';
    $query = $database->prepare( $sql );
    $query->execute([
        'label' => $label
    ]);

    header("Location: index.php");
    exit;
 }
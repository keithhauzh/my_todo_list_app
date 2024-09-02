<!-- connecting database -->
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

 $id = $_POST['id'];
 $completed = $_POST['completed'];

 if ((empty($id) && empty($completed))) {
    echo "error bro";
 } else if ($completed == "1"){
    $sql = "UPDATE todos SET completed = '0' WHERE id = :id";

    $query = $database->prepare( $sql );

    $query->execute([
        'id' => $id
    ]);

    header("Location: index.php");
    exit;

 } else if ($completed == "0"){
  $sql = "UPDATE todos SET completed = '1' WHERE id = :id";

  $query = $database->prepare( $sql );

  $query->execute([
    'id' => $id
  ]);

  header("Location: index.php");
    exit;
 }

 
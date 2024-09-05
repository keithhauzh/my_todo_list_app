<!-- connecting database -->
<?php 
 
// connect to the database
$database = connectToDB();   

 $id = $_POST['id'];
 $completed = $_POST['completed'];

 if ((empty($id) && empty($completed))) {
    setError("Error, either ID or field was not clicked on.", '/');
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

  header("Location: /");
    exit;
 }

 
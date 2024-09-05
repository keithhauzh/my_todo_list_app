<?php 


 // connect to the database
 $database = connectToDB();   

 $label = $_POST['label_name'];

 if (empty ($label)) {
    setError("Please insert a task label", '/');
 } else {
    $sql = 'INSERT INTO todos (`label`) VALUES (:label)';
    $query = $database->prepare( $sql );
    $query->execute([
        'label' => $label
    ]);

    header("Location: /");
    exit;
 }
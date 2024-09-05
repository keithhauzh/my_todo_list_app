<?php

// connect to the database
$database = connectToDB();   

// Setting the PDO error mode to exception for better error handling
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

// Getting the ID from the POST request
$id = $_POST['id'];

// Check if ID is provided
if (empty($id)) {
    setError("Could not find respective id", '/');
} else {
    // SQL statement to delete the record with the specified ID
    $sql = 'DELETE FROM todos WHERE id = :id';
    
    // Preparing the SQL statement
    $query = $database->prepare($sql);
    
    // Executing the SQL statement with the ID
    $query->execute([
        'id' => $id
    ]);

    // Redirecting to the index page after deletion
    header("Location: /");
    exit;
}


// Close the database connection (optional since PHP automatically closes it)
$database = null;

?>

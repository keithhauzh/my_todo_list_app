<?php

// Database connection
$host = "localhost";
$database_name = "my_todo_list_app";
$database_user = "root";
$database_password = "mysql";

try {
    // Establishing the database connection using PDO
    $database = new PDO(
        "mysql:host=$host;dbname=$database_name",
        $database_user, // username
        $database_password // password
    );

    // Setting the PDO error mode to exception for better error handling
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    // Getting the ID from the POST request
    $id = $_POST['id'];

    // Check if ID is provided
    if (empty($id)) {
        echo "No record ID provided!";
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
        header("Location: index.php");
        exit;
    }
} catch (PDOException $e) {
    // Handling any errors during the process
    echo "Error: " . $e->getMessage();
}

// Close the database connection (optional since PHP automatically closes it)
$database = null;

?>

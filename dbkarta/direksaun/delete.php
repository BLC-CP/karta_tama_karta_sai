<?php
// Check if id_direksaun is passed via GET request
if (isset($_GET['id_direksaun'])) {
    // Sanitize the id_direksaun to prevent injection attacks 
    $id_direksaun = htmlspecialchars($_GET['id_direksaun']);  

    // Database connection using PDO
    try {
        $conn = new PDO("mysql:host=localhost;dbname=kartamci", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL DELETE statement with a prepared statement
        $stmt = $conn->prepare("DELETE FROM tb_direksaun WHERE id_direksaun = ?");
        
        // Bind the id_direksaun to the statement
        $stmt->bindParam(1, $id_direksaun, PDO::PARAM_INT);

        // Execute the statement and check for success
        if ($stmt->execute()) {
            // Success
            echo "<script>alert('Dadus hamos ona'); document.location.href='?pagekarta=direksaun';</script>";
        } else {
            // Failure to delete
            echo "<script>alert('Failed to delete data.'); document.location.href='?pagekarta=direksaun';</script>";
        }
    } catch (PDOException $e) {
        // Handle the error and show a message
        echo "<script>alert('Dadus hamos ladiak'); document.location.href='?pagekarta=direksaun';</script>";
    }
} else {
    // Redirect if id_direksaun is not set in URL  
    echo "<script>alert('Invalid request. No ID provided.'); document.location.href='?pagekarta=direksaun';</script>";  
}

<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "kartamci");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if id_admin is set in the URL
if (isset($_GET['id_admin'])) {
    $id_admin = htmlspecialchars(trim($_GET['id_admin']));

    // First, fetch the current image name from the database
    $stmt = $conn->prepare("SELECT img FROM tb_admin WHERE id_admin = ?");
    $stmt->bind_param("s", $id_admin);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $admin_data = $result->fetch_assoc();
        $current_img = $admin_data['img'];

        // SQL delete query
        $delete_stmt = $conn->prepare("DELETE FROM tb_admin WHERE id_admin = ?");
        $delete_stmt->bind_param("s", $id_admin);

        if ($delete_stmt->execute()) {
            // Optionally, remove the image file from the server
            if (!empty($current_img)) {
                $image_path = "assets/imgadminkarta/" . $current_img;
                if (file_exists($image_path)) {
                    unlink($image_path); // Delete the image file
                }
            }
        
            // Redirect to the shortened URL using your rewrite rules
            echo "<script>alert('Dadus hamos ona'); window.location.href='/native/carta/adminkarta';</script>";
        } else {
            echo "<script>alert('Dadus hamos ladiak'); window.location.href='/adminkarta';</script>";
        }
        
        

        $delete_stmt->close();
    } else {
        echo "<script>alert('No admin found with the specified ID.'); window.location.href='?pagekarta=adminkarta';</script>";
    }
    
    $stmt->close();
} else {
    echo "<script>alert('Invalid request.'); window.location.href='?pagekarta=adminkarta';</script>";
}

$conn->close();
?>

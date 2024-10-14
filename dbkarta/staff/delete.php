<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "kartamci");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if id_staff is set in the URL
if (isset($_GET['id_staff'])) {
    $id_staff = htmlspecialchars(trim($_GET['id_staff']));

    // First, fetch the current image name from the database
    $stmt = $conn->prepare("SELECT img_staff FROM tb_staff WHERE id_staff = ?");
    $stmt->bind_param("s", $id_staff);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $staff_data = $result->fetch_assoc();
        $current_img = $staff_data['img_staff'];

        // SQL delete query
        $delete_stmt = $conn->prepare("DELETE FROM tb_staff WHERE id_staff = ?");
        $delete_stmt->bind_param("s", $id_staff);

        if ($delete_stmt->execute()) {
            // Optionally, remove the image file from the server
            if (!empty($current_img)) {
                $image_path = "assets/imgstaff/" . $current_img;
                if (file_exists($image_path)) {
                    unlink($image_path); // Delete the image file
                }
            }

            echo "<script>alert('Dadus hamos ona'); window.location.href='?pagekarta=staff';</script>";
        } else {
            echo "<script>alert('Error deleting staff: " . $delete_stmt->error . "'); window.location.href='?pagekarta=staffkarta';</script>";
        }

        $delete_stmt->close();
    } else {
        echo "<script>alert('No staff found with the specified ID.'); window.location.href='?pagekarta=staffkarta';</script>";
    }
    
    $stmt->close();
} else {
    echo "<script>alert('Invalid request.'); window.location.href='?pagekarta=staffkarta';</script>";
}

$conn->close();
?>

<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "kartamci");

if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error);  
}     

if ($_SERVER['REQUEST_METHOD'] === 'POST') {   
    // Fetch existing staff data  
    $id = $_POST['id_staff']; // Assuming the staff ID is passed as a POST parameter
    $sql = "SELECT * FROM tb_staff WHERE id_staff=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $staff_data = $result->fetch_assoc();
    $stmt->close();

    // Initialize image variable
    $current_img = $staff_data['img_staff']; // Store the current image name

    // Sanitize and fetch other fields
    $nrn_staff = htmlspecialchars(trim($_POST['nrn_staff']));  
    $sexo = htmlspecialchars(trim($_POST['sexo'])); 
    $data_moris = htmlspecialchars(trim($_POST['data_moris'])); 
    $tlp = htmlspecialchars(trim($_POST['tlp']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $admin = htmlspecialchars(trim($_POST['id_admin']));

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Email laidak.'); window.history.back();</script>";
        exit;
    }

    // Handle image upload
    $target_dir = "assets/imgstaff/";
    $img = $_FILES['img']['name'];

    // Validate image type and size if a new image is uploaded
    if (!empty($img)) {
        // If a new image is being uploaded, delete the old one first
        if (!empty($current_img)) {
            $old_image_path = $target_dir . $current_img;
            if (file_exists($old_image_path)) {
                unlink($old_image_path); // Delete the old image file
            }
        }

        // Proceed with uploading the new image
        $target_file = $target_dir . basename($img);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES['img']['tmp_name']);
        if ($check === false) {
            echo "<script>alert('File is not an image.'); window.history.back();</script>";
            exit;
        }

        if ($_FILES['img']['size'] > 500000) {
            echo "<script>alert('File size is too large. Max allowed size is 500KB.'); window.history.back();</script>";
            exit;
        }

        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG & GIF are allowed.'); window.history.back();</script>";
            exit;
        }

        // Move uploaded image to the target directory
        if (!move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
            echo "<script>alert('There was an error uploading your file.'); window.history.back();</script>";
            exit;
        }

        // Set img to the new image name
        $img = $img;
    } else {
        // If no new image is uploaded, keep the current image name
        $img = $current_img;  // Keep current image name
    }

    // SQL Update Query with Prepared Statement for security
    $stmt = $conn->prepare("UPDATE tb_staff SET nrn_staff=?, sexo_staff=?, data_moris_staff=?, tlp_staff=?, email_staff=?, id_admin=?, img_staff=? WHERE id_staff=?");

    if ($stmt === false) {
        echo "<script>alert('Error preparing the SQL statement: {$conn->error}'); window.history.back();</script>";
        exit;
    }

    $stmt->bind_param("ssssssss", $nrn_staff, $sexo, $data_moris, $tlp, $email, $admin, $img, $id);

    // Execute and check if successful
    if ($stmt->execute()) {
        echo "<script>alert('Dadus hadia ona'); window.location.href='?pagekarta=staff';</script>";
    } else {
        echo "<script>alert('Failed to update data! Please try again.'); window.location.href='?pagekarta=staff';</script>";
    }

    $stmt->close();
}

// Fetch existing staff data for displaying in the form
$id = $_GET['id_staff']; // Assuming the staff ID is passed as a GET parameter
$sql = "SELECT * FROM tb_staff WHERE id_staff=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$staff_data = $result->fetch_assoc();
$stmt->close();
?>


<div class="container-fluid">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <input type="hidden" name="id_staff" value="<?php echo $staff_data['id_staff']; ?>">
                <input type="hidden" name="id_admin" value="<?php echo $staff_data['id_admin']; ?>">
                <div class="mb-4">
                    <label for="nrn_staff">Naran Kompletu</label>
                    <input type="text" name="nrn_staff" id="nrn_staff" class="form form-control" value="<?php echo htmlspecialchars($staff_data['nrn_staff']); ?>" placeholder="Naran Kompletu">
                </div>
                <div class="mb-4">
                    <label for="sexo">Sexo</label>
                    <select name="sexo" id="sexo" class="form-control">
                        <option value="Mane" <?php echo $staff_data['sexo_staff'] === 'Mane' ? 'selected' : ''; ?>>Mane</option>
                        <option value="Feto" <?php echo $staff_data['sexo_staff'] === 'Feto' ? 'selected' : ''; ?>>Feto</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="data_moris">Data Moris</label>
                    <input type="date" name="data_moris" id="data_moris" class="form form-control" value="<?php echo $staff_data['data_moris_staff']; ?>">
                </div>
                <div class="mb-4">
                    <label for="tlp">Numeru Telefone</label>
                    <input type="number" name="tlp" id="tlp" class="form form-control" value="<?php echo $staff_data['tlp_staff']; ?>" placeholder="Numeru Telefone">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="mb-4">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form form-control" value="<?php echo htmlspecialchars($staff_data['email_staff']); ?>" placeholder="Email">
                </div>
                <div class="mb-4">
                    <label for="img">Imagen (leave blank to keep the same)</label>
                    <input type="file" name="img" id="img" class="form-control">
                    <?php if ($staff_data['img_staff']): ?>
                        <img src="assets/imgstaff/<?php echo htmlspecialchars($staff_data['img_staff']); ?>" width="100" alt="Current Image">
                    <?php endif; ?>
                </div>
                <div class="mb-4">
                   <button type="submit" name="add" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Rai Dadus</button>
                   <button type="reset" name="reset" class="btn btn-warning btn-sm"><i class="fa fa-loader"></i> Hamamuk Form</button>
                   <a href="staffkarta" class="btn btn-info btn-sm"><i class="fa fa-back"></i> Fila</a>
                </div>
            </div> 
        </div>   
    </form>   
</div>

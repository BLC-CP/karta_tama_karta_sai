<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "kartamci");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and validate inputs
    $id_staff = htmlspecialchars(trim($_POST['id_staff']));
    $nrn_staff = htmlspecialchars(trim($_POST['nrn_staff']));
    $sexo = htmlspecialchars(trim($_POST['sexo']));
    $data_moris = htmlspecialchars(trim($_POST['data_moris']));
    $tlp = htmlspecialchars(trim($_POST['tlp']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $admin = htmlspecialchars(trim($_POST['id_admin']));

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Email lalos.'); window.history.back();</script>";
        exit;
    }

    // Handle image upload
    $target_dir = "assets/imgstaff/";
    $img = $_FILES['img']['name'];
    $target_file = $target_dir . basename($img);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is an image
    $check = getimagesize($_FILES['img']['tmp_name']);
    if ($check === false) {
        echo "<script>alert('File is not an image.'); window.history.back();</script>";
        exit;
    }

    // Validate image file size (limit to 500KB)
    if ($_FILES['img']['size'] > 500000) {
        echo "<script>alert('File size is too large. Max allowed size is 500KB.'); window.history.back();</script>";
        exit;
    }

    // Allow only certain image file formats
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed_types)) {
        echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG, & GIF are allowed.'); window.history.back();</script>";
        exit;
    }

    // Move the uploaded file to the target directory
    if (!move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
        echo "<script>alert('There was an error uploading your file.'); window.history.back();</script>";
        exit;
    }

    // SQL Insert query with prepared statements to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO tb_staff (id_staff, nrn_staff, sexo_staff, data_moris_staff, tlp_staff, email_staff, id_admin, img_staff) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        echo "<script>alert('Error preparing the SQL statement: {$conn->error}'); window.history.back();</script>";
        exit;
    }

    // Bind parameters to the statement
    $stmt->bind_param("ssssssss", $id_staff, $nrn_staff, $sexo, $data_moris, $tlp, $email, $admin, $img);

    // Execute the query and check for success
    if ($stmt->execute()) {
        echo "<script>alert('Dadus aumenta ona.'); document.location.href='?pagekarta=staff';</script>";
    } else {
        echo "<script>alert('Failed to insert data! Please try again.'); document.location.href='?pagekarta=staff';</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<div class="container-fluid">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <input type="hidden" name="id_staff">
                <input type="hidden" name="id_admin" value="<?= $id_admin; ?>">
                <div class="mb-4">
                    <label for="nrn_staff">Naran Kompletu</label>
                    <input type="text" name="nrn_staff" id="nrn_staff" class="form form-control" placeholder="Naran Kompletu" required>
                </div>
                <div class="mb-4">
                    <label for="sexo">Sexo</label>
                    <select name="sexo" id="sexo" class="form-control" required>
                        <option value="Mane">Mane</option>
                        <option value="Feto">Feto</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="data_moris">Data Moris</label>
                    <input type="date" name="data_moris" id="data_moris" class="form form-control" required>
                </div>
                <div class="mb-4">
                    <label for="tlp">Numeru Telefone</label>
                    <input type="number" name="tlp" id="tlp" class="form form-control" placeholder="Numeru Telefone" required>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="mb-4">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form form-control" placeholder="Email" required>
                </div>
                <div class="mb-4">
                    <label for="img">Imagen</label>
                    <input type="file" name="img" id="img" class="form-control" required>
                </div>
                <div class="mb-4">
                    <button type="submit" name="add" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Rai Dadus</button>
                    <button type="reset" class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i> Hamamuk Form</button>
                    <a href="staff" class="btn btn-info btn-sm"><i class="fa fa-arrow-left"></i> Fila</a>
                </div>
            </div>
        </div>
    </form>
</div>

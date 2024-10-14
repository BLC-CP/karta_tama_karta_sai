<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "kartamci");

if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error);  
}    

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    // Fetch existing admin data 
    $id = $_POST['id_admin']; // Assuming the admin ID is passed as a POST parameter
    $sql = "SELECT * FROM tb_admin WHERE id_admin=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin_data = $result->fetch_assoc();
    $stmt->close();

    // Initialize image variable
    $current_img = $admin_data['img']; // Store the current image name

    // Sanitize and fetch other fields
    $nrn_admin = htmlspecialchars(trim($_POST['nrn_admin']));  
    $sexo = htmlspecialchars(trim($_POST['sexo'])); 
    $data_moris = htmlspecialchars(trim($_POST['data_moris'])); 
    $tlp = htmlspecialchars(trim($_POST['tlp']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;
    $direksaun = htmlspecialchars(trim($_POST['id_direksaun']));
    $levelkarta = htmlspecialchars(trim($_POST['levelkarta']));

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email address');
    }

    // Handle image upload
    $target_dir = "assets/imgadminkarta/";
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
            die("File is not an image.");
        }

        if ($_FILES['img']['size'] > 500000) {
            die("Sorry, your file is too large.");
        }

        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }

        // Move uploaded image to the target directory
        if (!move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
            die("Sorry, there was an error uploading your file.");
        }

        // Set img to the new image name
        $img = $img;
    } else {
        // If no new image is uploaded, keep the current image name
        $img = $current_img;  // Keep current image name
    }

    // SQL Update Query with Prepared Statement for security
    $stmt = $conn->prepare("UPDATE tb_admin SET nrn_admin=?, sexo=?, data_moris=?, tlp=?, email=?, id_direksaun=?, levelkarta=?, img=?" . 
        ($password ? ", password=?" : "") . " WHERE id_admin=?");

    if ($stmt === false) {
        die('Error preparing the statement: ' . $conn->error);
    }

    // If the password is empty, do not include it in the update
    if ($password) {
        $stmt->bind_param("ssssssssss", $nrn_admin, $sexo, $data_moris, $tlp, $email, $direksaun, $levelkarta, $img, $password, $id);
    } else {
        $stmt->bind_param("sssssssss", $nrn_admin, $sexo, $data_moris, $tlp, $email, $direksaun, $levelkarta, $img, $id);
    }

    // Execute and check if successful
    if ($stmt->execute()) {
        echo "<script>alert('Dadus hadia ona'); window.location.href='adminkarta';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

// Fetch existing admin data for displaying in the form
$id = $_GET['id_admin']; // Assuming the admin ID is passed as a GET parameter
$sql = "SELECT * FROM tb_admin WHERE id_admin=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$admin_data = $result->fetch_assoc();
$stmt->close();
?>


<div class="container-fluid">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <input type="hidden" name="id_admin" value="<?php echo $admin_data['id_admin']; ?>">
                <div class="mb-4">
                    <label for="nrn_admin">Naran Kompletu</label>
                    <input type="text" name="nrn_admin" id="nrn_admin" class="form form-control" value="<?php echo htmlspecialchars($admin_data['nrn_admin']); ?>" placeholder="Naran Kompletu">
                </div>
                <div class="mb-4">
                    <label for="sexo">Sexo</label>
                    <select name="sexo" id="sexo" class="form-control">
                        <option value="Mane" <?php echo $admin_data['sexo'] === 'Mane' ? 'selected' : ''; ?>>Mane</option>
                        <option value="Feto" <?php echo $admin_data['sexo'] === 'Feto' ? 'selected' : ''; ?>>Feto</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="data_moris">Data Moris</label>
                    <input type="date" name="data_moris" id="data_moris" class="form form-control" value="<?php echo $admin_data['data_moris']; ?>">
                </div>
                <div class="mb-4">
                    <label for="tlp">Numeru Telefone</label>
                    <input type="number" name="tlp" id="tlp" class="form form-control" value="<?php echo $admin_data['tlp']; ?>" placeholder="Numeru Telefone">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="mb-4">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form form-control" value="<?php echo htmlspecialchars($admin_data['email']); ?>" placeholder="Email">
                </div>
                <div class="mb-4">
                    <label for="password">Password (husik mamuk sei mantein password tuan)</label>
                    <input type="hidden" name="levelkarta" value="<?= htmlspecialchars($admin_data['levelkarta']); ?>">
                    <input type="password" name="password" id="password" class="form form-control" placeholder="Password">
                </div>
                <div class="mb-4">
                    <label for="id_direksaun">Direksaun</label>
                    <select name="id_direksaun" id="id_direksaun" class="form-control js-example-basic-single">
                        <option disabled selected>Hili Direksaun</option>
                        <?php 
                            $sql = 'SELECT * FROM tb_direksaun'; 
                            $stmt = $conn->prepare($sql);  
                            $stmt->execute();
                            $direksaun = $stmt->get_result();
                            while ($row = $direksaun->fetch_assoc()) {
                                echo "<option value='{$row['id_direksaun']}' " . ($admin_data['id_direksaun'] == $row['id_direksaun'] ? 'selected' : '') . ">{$row['nrn_direksaun']}</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="img">Imagen (husik mamuk sei mantein imagen tuan)</label>
                    <input type="file" name="img" id="img" class="form-control">
                    <?php if ($admin_data['img']): ?>
                        <img src="assets/imgadminkarta/<?php echo htmlspecialchars($admin_data['img']); ?>" width="100" alt="Current Image">
                    <?php endif; ?>
                </div>
                <div class="mb-4">
                   <button type="submit" name="add" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Rai Dadus</button>
                   <button type="reset" name="reset" class="btn btn-warning btn-sm"><i class="fa fa-loader"></i> Hamamuk Form</button>
                   <a href="adminkarta" class="btn btn-info btn-sm"><i class="fa fa-back"></i> Fila</a>
                </div>
            </div> 
        </div>  
    </form>   
</div>

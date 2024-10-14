<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "kartamci");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    // Sanitize inputs
    $id_admin = htmlspecialchars(trim($_POST['id_admin'])); 
    $nrn_admin = htmlspecialchars(trim($_POST['nrn_admin']));
    $sexo = htmlspecialchars(trim($_POST['sexo']));
    $data_moris = htmlspecialchars(trim($_POST['data_moris']));
    $tlp = htmlspecialchars(trim($_POST['tlp']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $direksaun = htmlspecialchars(trim($_POST['id_direksaun']));
    $levelkarta = htmlspecialchars(trim($_POST['levelkarta']));

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Email la validu'); window.history.back();</script>";
        exit;
    }

    // Handle image upload
    $target_dir = "assets/imgadminkarta/";
    $img = $_FILES['img']['name'];
    $target_file = $target_dir . basename($img);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate image type and size
    $check = getimagesize($_FILES['img']['tmp_name']);
    if ($check === false) {
        echo "<script>alert('File seidauk upload'); window.history.back();</script>";
        exit;
    }

    if ($_FILES['img']['size'] > 500000) {
        echo "<script>alert('File nia size boot liu. Maximu size 500KB.'); window.history.back();</script>";
        exit;
    }

    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed_types)) {
        echo "<script>alert('File validu JPG, JPEG, PNG, & GIF'); window.history.back();</script>";
        exit;
    }

    // Move uploaded image to the target directory
    if (!move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
        echo "<script>alert('File upload ladiak.'); window.history.back();</script>";
        exit;
    }

    // SQL Insert Query with Prepared Statement for security
    $stmt = $conn->prepare("INSERT INTO tb_admin (id_admin, nrn_admin, sexo, data_moris, tlp, email, password, id_direksaun, levelkarta, img) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        echo "<script>alert('Error preparing the SQL statement: {$conn->error}'); window.history.back();</script>";
        exit;
    }

    $stmt->bind_param("ssssssssss", $id_admin, $nrn_admin, $sexo, $data_moris, $tlp, $email, $password, $direksaun, $levelkarta, $img);

    // Execute and check if successful
    if ($stmt->execute()) {
        echo "<script>alert('Dadus aumenta ona.'); document.location.href='?pagekarta=adminkarta';</script>";
    } else {
        // When data cannot be inserted
        echo "<script>alert('Dadus aumenta ladiak.'); document.location.href='?pagekarta=adminkarta';</script>";
    }
    // Close connections
    $stmt->close();
    $conn->close();
}
?>


<div class="container-fluid">
    <form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
                    <input type="hidden" name="id_admin">
                <div class="mb-4">
                    <label for="nrn_admin">Naran Kompletu</label>
                    <input type="text" name="nrn_admin" id="nrn_admin" class="form form-control" placeholder="Naran Kompletu">
                </div>
                <div class="mb-4">
                    <label for="nrn_admin">Sexo</label>
                    <select name="sexo" id="sexo" class="form-control">
                        <option value="Mane">Mane</option>
                        <option value="Feto">Feto</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="data_moris">Data Moris</label>
                    <input type="date" name="data_moris" id="data_moris" require class="form form-control" placeholder="Data Moris">
                </div>
                <div class="mb-4">
                    <label for="tlp">Numeru Telefone</label>
                    <input type="number" name="tlp" id="tlp" class="form form-control" placeholder="Numeru Telefone">
                    <input type="hidden" name="levelkarta" value="userkarta">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="mb-4">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form form-control" placeholder="Email">
                </div>
                <div class="mb-4">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form form-control" placeholder="Password">
                </div>
                <div class="mb-4">
                    <label for="id_direksaun">Direksaun</label>
                    <select name="id_direksaun" id="id_direksaun" class="js-example-basic-single form-control">
                        <option disabled selected>Hili Direksaun</option>
                        <?php 
                            $sql = 'SELECT * FROM tb_direksaun'; 
                            $stmt = $conn->prepare($sql);  
                            $stmt->execute();
                            $direksaun = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            if ($direksaun) {
                                foreach ($direksaun as $row) {
                                    echo "<option value='{$row['id_direksaun']}'>{$row['nrn_direksaun']}</option>";
                                }
                            }
                        ?>
                    </select>

                </div>
                <div class="mb-4">
                    <label for="img">Imagen</label>
                    <input type="file" name="img" id="img" class="form-control">
                </div>
                <div class="mb-4">
                   <button type="submit" name="add" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Rai Dadus</button>
                   <button type="reset" name="reset" class="btn btn-warning btn-sm"><i class="fa fa-loader"></i>Hamamuk Form</button>
                   <a href="adminkarta" class="btn btn-info btn-sm"><i class="fa fa-back"></i> Fila</a>
                </div>
            </div>
            
        </div>
    </form>
</div>


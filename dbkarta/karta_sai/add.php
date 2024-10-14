<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "kartamci");

    if ($conn->connect_error) { 
        die("Connection failed: " . $conn->connect_error); 
    }

    // Sanitize the input data
    $id_admin = htmlspecialchars(trim($_POST['id_admin']));
    $id_direksaun = htmlspecialchars(trim($_POST['id_direksaun']));
    $data_registu = htmlspecialchars(trim($_POST['data_registu']));
    $no_ref = htmlspecialchars(trim($_POST['no_ref']));
    $asuntu = htmlspecialchars(trim($_POST['asuntu']));
    $hato = htmlspecialchars(trim($_POST['hato']));
    $kategoria = htmlspecialchars(trim($_POST['kategoria']));

    // Ensure all required fields are present
    if (!empty($id_admin) && !empty($id_direksaun) && !empty($data_registu) && !empty($no_ref) && !empty($asuntu) && !empty($hato) && !empty($kategoria)) {
        
        // Insert data into tb_karta_sai
        $stmt = $conn->prepare("INSERT INTO tb_karta_sai (id_admin, id_direksaun, data_karta_sai, no_ref, asuntu, hato, kategoria) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Error preparing the statement: " . $conn->error);
        }

        // Bind parameters (i -> integer, s -> string)
        $stmt->bind_param("iisssss", $id_admin, $id_direksaun, $data_registu, $no_ref, $asuntu, $hato, $kategoria);

        // Execute and check if the data is inserted
        if ($stmt->execute()) {
            echo "<script>alert('Dadus aumenta ona!'); document.location.href='?pagekarta=karta_sai';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        // Close the statement and connection
        $stmt->close();
    } else {
        echo "<script>alert('Favor Priense form hotu!');</script>";
    }

    $conn->close();
}
?>

<div class="container-fluid">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <!-- Hidden input to store selected id_admin -->
                <input type="hidden" name="id_admin" value="<?php echo $admin['id_admin']; ?>">
                <div class="mb-4">
                    <label for="data_registu">Data Registu</label>
                    <input type="date" name="data_registu" id="data_registu" value="<?= date('Y-m-d'); ?>" class="form form-control">
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
                    <label for="no_ref">No Ref</label>
                    <input type="number" name="no_ref" id="no_ref" class="form-control" placeholder="Numeru Ref">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="mb-4">
                    <label for="asuntu">Asuntu</label>
                    <input type="text" name="asuntu" id="asuntu" class="form form-control" placeholder="Asuntu">
                </div>

                <div class="mb-4">
                    <label for="hato">Hato'o</label>
                    <input type="text" name="hato" id="hato" class="form-control form-control-sm" placeholder="Hato'o">
                </div>
                <div class="mb-4">
                    <label for="kategoria">Kategoria</label>
                    <textarea name="kategoria" class="form-control" id="" cols="30"></textarea>
                </div>
                <div class="mb-4">
                    <button type="submit" name="add" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Rai Dadus</button>
                    <button type="reset" name="reset" class="btn btn-warning btn-sm"><i class="fa fa-load"></i> Hamamuk Form</button>
                    <a href="karta_sai" class="btn btn-info btn-sm"><i class="fa fa-back"></i> Fila</a>
                </div>
            </div>
        </div> 
    </form> 
</div>

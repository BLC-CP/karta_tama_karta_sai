<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "kartamci");

if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error);  
}     
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {   
    // Fetch existing karta_tama data  
    $id = htmlspecialchars(trim($_POST['id_karta_tama'])); // Sanitize the karta_tama ID
    $sql = "SELECT * FROM tb_karta_tama WHERE id_karta_tama=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $karta_tama_data = $result->fetch_assoc();
    $stmt->close();

    // Sanitize and fetch other fields
    $id_admin = htmlspecialchars(trim($_POST['id_admin']));  
    $id_direksaun = htmlspecialchars(trim($_POST['id_direksaun'] )); 
    $data_karta_tama = htmlspecialchars(trim($_POST['data_karta_tama'])); 
    $no_ref = htmlspecialchars(trim($_POST['no_ref'])); 
    $asuntu = htmlspecialchars(trim($_POST['asuntu']));
    $hato = htmlspecialchars(trim($_POST['hato']));
    $kategoria = htmlspecialchars(trim($_POST['kategoria']));

    // SQL Update Query with Prepared Statement for security
    $stmt = $conn->prepare("UPDATE tb_karta_tama SET id_admin=?, id_direksaun=?, data_karta_tama=?, no_ref=?, asuntu=?, hato=?, kategoria=? WHERE id_karta_tama=?");
    
    if ($stmt === false) {
        die('Error preparing the statement: ' . $conn->error);
    }

    // Bind the parameters, including the ID for the WHERE clause
    $stmt->bind_param("ssssssss", $id_admin, $id_direksaun, $data_karta_tama, $no_ref, $asuntu, $hato, $kategoria, $id);

    // Execute and check if successful
    if ($stmt->execute()) {
        echo "<script>alert('Dadus hadia ona'); window.location.href='?pagekarta=karta_tama';</script>";
    } else {
        echo "<script>alert('Error: " . htmlspecialchars($stmt->error) . "');</script>";
    }

    $stmt->close();
}

// Fetch existing karta_tama data for displaying in the form
$id = htmlspecialchars(trim($_GET['id_karta_tama'])); // Sanitize the karta_tama ID
$sql = "SELECT * FROM tb_karta_tama WHERE id_karta_tama=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$karta_tama_data = $result->fetch_assoc();
$stmt->close();
?>

<div class="container-fluid">
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-6">
                <input type="hidden" name="id_karta_tama" value="<?php echo htmlspecialchars($karta_tama_data['id_karta_tama']); ?>">
                <input type="hidden" name="id_admin" value="<?php echo htmlspecialchars($karta_tama_data['id_admin']); ?>">
                <div class="mb-4">
                    <label for="data_karta_tama">Data Registu</label>
                    <input type="date" name="data_karta_tama" id="data_karta_tama" value="<?= htmlspecialchars($karta_tama_data['data_karta_tama']); ?>" class="form form-control">
                </div>

                <div class="mb-4">
                    <label for="id_direksaun">Husi Direksaun</label>
                    <select name="id_direksaun" id="id_direksaun" class="form-control js-example-basic-single">
                        <option disabled selected>Hili Direksaun</option>
                        <?php 
                            $sql = 'SELECT * FROM tb_direksaun'; 
                            $stmt = $conn->prepare($sql);  
                            $stmt->execute();
                            $direksaun = $stmt->get_result();
                            while ($row = $direksaun->fetch_assoc()) {
                                echo "<option value='{$row['id_direksaun']}' " . ($karta_tama_data['id_direksaun'] == $row['id_direksaun'] ? 'selected' : '') . ">{$row['nrn_direksaun']}</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="no_ref">No Ref</label>
                    <input type="number" name="no_ref" id="no_ref" value="<?= htmlspecialchars($karta_tama_data['no_ref']); ?>" class="form-control" placeholder="Numeru Ref">
                </div>

                <div class="mb-4"> 
                    <label for="asuntu">Asuntu</label> 
                    <input type="text" name="asuntu" id="asuntu" value="<?= htmlspecialchars($karta_tama_data['asuntu']); ?>" class="form form-control" placeholder="Asuntu"> 
                </div>
            </div>

            <div class="col-lg-6">
                

                <div class="mb-4">
                    <label for="hato">Hato'o mai</label>
                    <input type="text" name="hato" id="hato" value="<?= htmlspecialchars($karta_tama_data['hato']); ?>" class="form-control form-control-sm" placeholder="Hato'o">
                </div>
                <div class="mb-4">
                    <label for="kategoria">Kategoria</label>
                    <textarea name="kategoria" class="form-control" cols="30"><?= htmlspecialchars($karta_tama_data['kategoria']); ?></textarea>
                </div>
                <div class="mb-4">
                   <button type="submit" name="update" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Rai Dadus</button>
                   <button type="reset" name="reset" class="btn btn-warning btn-sm"><i class="fa fa-loader"></i> Hamamuk Form</button>
                   <a href="karta_tama" class="btn btn-info btn-sm"><i class="fa fa-back"></i> Fila</a>
                </div>
            </div> 
        </div>  
    </form>    
</div>

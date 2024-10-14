<?php 
// Check if 'id' is set in the URL for editing
if (isset($_GET['id_fasilidade'])) {
    $id_fasilidade = $_GET['id_fasilidade'];

    // Database connection  
    $conn = new mysqli("localhost", "root", "", "kartamci");  
    if ($conn->connect_error) {    
        die("Connection failed: " . $conn->connect_error);    
    }

    // Fetch existing data to pre-fill the form
    $stmt = $conn->prepare("SELECT * FROM tb_fasilidade WHERE id_fasilidade = ?");
    $stmt->bind_param("s", $id_fasilidade);
    $stmt->execute();
    $result = $stmt->get_result();
    $fasilidade = $result->fetch_assoc();
    $stmt->close();
}

// Update data if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    // Sanitize the input data
    $id_fasilidade = htmlspecialchars(trim($_POST['id_fasilidade']));
    $data_registu = htmlspecialchars(trim($_POST['data_registu']));
    $deskrisaun = htmlspecialchars(trim($_POST['deskrisaun']));
    $marka = htmlspecialchars(trim($_POST['marka']));
    $modelu = htmlspecialchars(trim($_POST['modelu']));
    $serial_number = htmlspecialchars(trim($_POST['serial_number']));
    $kondisaun = htmlspecialchars(trim($_POST['kondisaun']));
    $id_staff = htmlspecialchars(trim($_POST['id_staff']));

    // Ensure all required fields are present
    if (!empty($id_fasilidade) && !empty($data_registu) && !empty($deskrisaun) && !empty($marka) && !empty($modelu) && !empty($serial_number) && !empty($kondisaun) && !empty($id_staff)) {

        // Update the existing record
        $stmt = $conn->prepare("UPDATE tb_fasilidade SET data_registu = ?, deskrisaun = ?, marka = ?, modelu = ?, serial_number = ?, kondisaun = ?, id_staff = ? WHERE id_fasilidade = ?");
        if ($stmt === false) { 
            die("Error preparing the statement: " . $conn->error); 
        }

        // Bind parameters
        $stmt->bind_param("ssssssss", $data_registu, $deskrisaun, $marka, $modelu, $serial_number, $kondisaun, $id_staff, $id_fasilidade);

        // Execute and check if the data is updated
        if ($stmt->execute()) { 
            echo "<script>alert('Dadus hadia ona!'); document.location.href='?pagekarta=fasilidade';</script>"; 
        } else { 
            echo "<script>alert('Error: " . $stmt->error . "');</script>"; 
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<script>alert('Favor priense form hotu!'); document.location.href='?pagekarta=editfasilidade&id_fasilidade=$id_fasilidade';</script>";
    }

    $conn->close();
} 
?>

<div class="container-fluid">
    <form action="" method="post"> 
        <div class="row"> 
            <div class="col-lg-6"> 
                <div class="mb-4">
                    <label for="id_fasilidade">Id Fasilidade</label> 
                    <input type="text" name="id_fasilidade" id="id_fasilidade" class="form-control" value="<?= $fasilidade['id_fasilidade']; ?>" readonly/>
                </div>
                <div class="mb-4">
                    <label for="data_registu">Data Registu</label> 
                    <input type="date" name="data_registu" id="data_registu" value="<?= $fasilidade['data_registu']; ?>" class="form form-control" required> 
                </div> 

                <div class="mb-4"> 
                    <label for="id_staff">Staff</label> 
                    <select name="id_staff" id="id_staff" class="js-example-basic-single form-control">  
    <option selected>Hili Staff</option>  
    <?php   
        // $id_admin_logged_in = $_SESSION['id_admin']; 
        $sql = 'SELECT * FROM tb_staff';
        $stmt = $conn->prepare($sql);
        // $stmt->bind_param("s", $id_admin_logged_in); 
        $stmt->execute();
        $staff = $stmt->get_result();

        while ($row = $staff->fetch_assoc()) {
            $selected = $row['id_staff'] == $fasilidade['id_staff'] ? 'selected' : '';
            echo "<option value='{$row['id_staff']}' $selected>{$row['nrn_staff']}</option>"; 
        }
    ?>  
</select>


                </div>

                <div class="mb-4"> 
                    <label for="deskrisaun">Deskrisaun</label> 
                    <input type="text" name="deskrisaun" id="deskrisaun" class="form-control" value="<?= $fasilidade['deskrisaun']; ?>" required> 
                </div> 
                <div class="mb-4"> 
                    <label for="marka">Marka</label> 
                    <input type="text" name="marka" id="marka" class="form-control" value="<?= $fasilidade['marka']; ?>" required> 
                </div> 
            </div> 

            <div class="col-lg-6"> 
                <div class="mb-4"> 
                    <label for="modelu">Modelu</label> 
                    <input type="text" name="modelu" id="modelu" class="form-control form-control-sm" value="<?= $fasilidade['modelu']; ?>" required> 
                </div> 
                <div class="mb-4"> 
                    <label for="serial_number">Numeru Serial</label> 
                    <input type="text" name="serial_number" id="serial_number" class="form-control form-control-sm" value="<?= $fasilidade['serial_number']; ?>" required> 
                </div> 
                <div class="mb-4"> 
                    <label for="kondisaun">Kondisaun</label> 
                    <select name="kondisaun" id="kondisaun" class="form-control">
                        <option value="Diak" <?= $fasilidade['kondisaun'] == 'Diak' ? 'selected' : ''; ?>>Diak</option> 
                        <option value="Ladiak" <?= $fasilidade['kondisaun'] == 'Ladia' ? 'selected' : ''; ?>>Ladiak</option> 
                    </select> 
                </div> 
                <div class="mb-4"> 
                    <button type="submit" name="update" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Rai Dadus</button>   
                    <a href="fasilidade" class="btn btn-info btn-sm"><i class="fa fa-arrow-left"></i> Fila</a>   
                </div>   
            </div>   
        </div>     
    </form>     
</div> 

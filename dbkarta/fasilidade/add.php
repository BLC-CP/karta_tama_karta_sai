<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "kartamci");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize input data
    $id = htmlspecialchars(trim($_POST['id']));
    $data_registu = htmlspecialchars(trim($_POST['data_registu']));
    $deskrisaun = htmlspecialchars(trim($_POST['deskrisaun']));
    $marka = htmlspecialchars(trim($_POST['marka']));
    $modelu = htmlspecialchars(trim($_POST['modelu']));
    $serial_number = htmlspecialchars(trim($_POST['serial_number']));
    $kondisaun = htmlspecialchars(trim($_POST['kondisaun']));
    $id_staff = htmlspecialchars(trim($_POST['id_staff']));

    // Ensure all required fields are present
    if (!empty($id) && !empty($data_registu) && !empty($deskrisaun) && !empty($marka) && !empty($modelu) && !empty($serial_number) && !empty($kondisaun) && !empty($id_staff)) {

        // Check if serial_number already exists
        $checkStmt = $conn->prepare("SELECT COUNT(*) FROM tb_fasilidade WHERE serial_number = ?");
        $checkStmt->bind_param("s", $serial_number);
        $checkStmt->execute();
        $checkStmt->bind_result($exists);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($exists > 0) {
            echo "<script>alert('Numeru Serial iha ona'); document.location.href='?pagekarta=addfasilidade';</script>";
        } else {
            // Insert data into tb_fasilidade
            $stmt = $conn->prepare("INSERT INTO tb_fasilidade (id_fasilidade, data_registu, deskrisaun, marka, modelu, serial_number, kondisaun, id_staff) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt === false) {
                die("Error preparing the statement: " . $conn->error);
            }

            // Bind parameters
            $stmt->bind_param("ssssssss", $id, $data_registu, $deskrisaun, $marka, $modelu, $serial_number, $kondisaun, $id_staff);

            // Execute and check if the data is inserted
            if ($stmt->execute()) {
                echo "<script>alert('Dadus aumenta ona!'); document.location.href='?pagekarta=fasilidade';</script>";
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }

            // Close the statement
            $stmt->close();
        }
    } else {
        echo "<script>alert('Favor priense form hotu!'); document.location.href='?pagekarta=addfasilidade';</script>";
    }

    $conn->close();
}

// Database connection for fetching the last ID
$conn = new mysqli("localhost", "root", "", "kartamci");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the last ID from the table
// Fetch the last ID from the database
$sql = "SELECT id_fasilidade FROM tb_fasilidade ORDER BY id_fasilidade DESC LIMIT 1";
$result = $conn->query($sql);

// Check if any record exists
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastId = $row['id_fasilidade'];

    // Extract the numeric part from the last ID and increment it
    $numericPart = (int)substr($lastId, -2); // Assuming last 2 digits are numbers
    $newNumericPart = str_pad($numericPart + 1, 2, '0', STR_PAD_LEFT); // Increment and pad with zeros

    // Form the new ID
    $newId = 'RDTL-' . $newNumericPart;
} else {
    // If no record exists, start with the first ID
    $newId = 'RDTL-01';
}


$conn->close();
?>

<div class="container-fluid">
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-6">
            <div class="mb-4">
    <label for="id">Id</label>
    <input type="text" name="id" id="id" class="form-control" value="<?= $newId; ?>" readonly required/>
</div>
                <div class="mb-4">
                    <label for="data_registu">Data Registu</label>
                    <input type="date" name="data_registu" id="data_registu" value="<?= date('Y-m-d'); ?>" class="form form-control" required>
                </div>

                <div class="mb-4">
                    <label for="id_staff">Staff</label>
                    <select name="id_staff" id="id_staff" class="js-example-basic-single form-control">
    <option selected>Hili Staff</option>
    <?php
    // Database connection for fetching staff data
    $conn = new mysqli("localhost", "root", "", "kartamci");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // $id_admin_logged_in = $_SESSION['id_admin'];  

    $sql = 'SELECT * FROM tb_staff'; 
    
    $stmt = $conn->prepare($sql);
    // $stmt->bind_param('s', $id_admin_logged_in);
    $stmt->execute();
    $staff = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    if ($staff) {
        foreach ($staff as $row) {
            echo "<option value='{$row['id_staff']}'> {$row['nrn_staff']}</option>";
        }
    }
    
    $stmt->close();
    $conn->close();
    ?>
</select>

                </div>

                <div class="mb-4">
                    <label for="deskrisaun">Deskrisaun</label>
                    <input type="text" name="deskrisaun" id="deskrisaun" class="form-control" placeholder="Deskrisaun.." required>
                </div>
                <div class="mb-4">
                    <label for="marka">Marka</label>
                    <input type="text" name="marka" id="marka" class="form-control" placeholder="Marka.." required>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="mb-4">
                    <label for="modelu">Modelu</label>
                    <input type="text" name="modelu" id="modelu" class="form-control form-control-sm" placeholder="Modelu.." required>
                </div>
                <div class="mb-4">
                    <label for="serial_number">Numeru Serial</label>
                    <input type="text" name="serial_number" id="serial_number" class="form-control form-control-sm" placeholder="Numeru Serial.." required>
                </div>
                <div class="mb-4">
                    <label for="kondisaun">Kondisaun</label>
                    <select name="kondisaun" id="kondisaun" class="form-control">
                        <option selected>Hili Kondisaun</option>
                        <option value="Diak">Diak</option>
                        <option value="Ladiak">Ladiak</option>
                    </select>
                </div>
                <div class="mb-4">
                    <button type="submit" name="add" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Rai Dadus</button>
                    <button type="reset" name="reset" class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i> Hamamuk Form</button>
                    <a href="fasilidade" class="btn btn-info btn-sm"><i class="fa fa-arrow-left"></i> Fila</a>
                </div>
            </div>
        </div>
    </form>
</div>

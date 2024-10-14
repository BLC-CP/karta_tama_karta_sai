<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "kartamci");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); 
}

// Check if the form is submitted for updating
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_direksaun = htmlspecialchars(trim($_POST['id_direksaun']));
    $nrn_direksaun = htmlspecialchars(trim($_POST['nrn_direksaun']));

    // SQL Update Query with Prepared Statement for security
    $stmt = $conn->prepare("UPDATE tb_direksaun SET nrn_direksaun = ? WHERE id_direksaun = ?");

    if ($stmt === false) {
        die('Error preparing the statement: ' . $conn->error);
    }

    $stmt->bind_param("si", $nrn_direksaun, $id_direksaun);

    // Execute and check if successful
    if ($stmt->execute()) {
        echo "<script>alert('Dadus hadia ona'); document.location.href='?pagekarta=direksaun'</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

// Fetch the existing data to display in the form
if (isset($_GET['id_direksaun'])) {
    $id_direksaun = $_GET['id_direksaun'];

    // SQL Select Query to fetch data
    $stmt = $conn->prepare("SELECT nrn_direksaun FROM tb_direksaun WHERE id_direksaun = ?");
    $stmt->bind_param("i", $id_direksaun);
    $stmt->execute();
    $stmt->bind_result($nrn_direksaun);
    $stmt->fetch();
    $stmt->close();
}

$conn->close();
?>

<div class="container-fluid">
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-4">
                    <label for="nrn_direksaun">Direksaun</label>
                    <input type="text" name="nrn_direksaun" id="nrn_direksaun" class="form form-control" placeholder="Naran Direkksaun" value="<?php echo isset($nrn_direksaun) ? $nrn_direksaun : ''; ?>" required>
                </div>
                <div class="mb-4">
                    <input type="hidden" name="id_direksaun" value="<?php echo isset($id_direksaun) ? $id_direksaun : ''; ?>">
                    <button type="submit" name="update" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Update Dadus</button>
                    <a href="direksaun" class="btn btn-info btn-sm"><i class="fa fa-back"></i> Fila</a>
                </div>
            </div>
        </div> 
    </form>  
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "kartamci");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $nrn_direksaun = htmlspecialchars(trim($_POST['nrn_direksaun']));

    // SQL Insert Query with Prepared Statement for security
    $stmt = $conn->prepare("INSERT INTO tb_direksaun (nrn_direksaun) VALUES (?)");

    if ($stmt === false) {
        die('Error preparing the statement: ' . $conn->error);
    }

    $stmt->bind_param("s", $nrn_direksaun);

    // Execute and check if successful
    if ($stmt->execute()) {
        echo "<script>alert('Dadus aumenta ona'); document.location.href='?pagekarta=direksaun'</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<div class="container-fluid">
    <form action="" method="post">
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-4">
                    <label for="nrn_direksaun">Direksaun</label>
                    <input type="text" name="nrn_direksaun" id="nrn_direksaun" class="form form-control" placeholder="Naran Direksaun" required>
                </div>
                <div class="mb-4">
                   <button type="submit" name="add" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Rai Dadus</button>
                   <button type="reset" name="reset" class="btn btn-warning btn-sm"><i class="fa fa-loader"></i> Hamamuk Form</button>
                   <a href="direksaun" class="btn btn-info btn-sm"><i class="fa fa-back"></i> Fila</a>
                </div>
            </div>
        </div> 
    </form> 
</div>

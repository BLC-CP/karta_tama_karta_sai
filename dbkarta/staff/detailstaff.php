<?php 
// Database connection using MySQLi
$conn = new mysqli("localhost", "root", "", "kartamci");

if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error);  
}

// Step 2: Sanitize and prepare the SQL statement  
$id = $_GET['id']; // Assuming the staff ID is passed as a GET parameter 
$sql = "SELECT tb_staff.*, tb_admin.nrn_admin, tb_direksaun.nrn_direksaun
        FROM tb_staff 
        JOIN tb_admin ON tb_staff.id_admin = tb_admin.id_admin 
        JOIN tb_direksaun ON tb_admin.id_direksaun = tb_direksaun.id_direksaun
        WHERE tb_staff.id_staff = ?"; // Fixed the query syntax
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id); // Assuming id_staff is a string, use "i" if it's an integer
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $staff_data = $result->fetch_assoc();
} else {
    // Handle the case where no staff data is found
    echo "<p>No staff data found.</p>";
}
$stmt->close();
?>

<div class="row">
   <div class="col-md-4">
       <div class="card">
           <div class="card-header bg-primary">
               <div class="card-title">
                   <h4>Image: <?= htmlspecialchars($staff_data['nrn_staff']) ?></h4>
               </div>
           </div>
           <div class="card-body">
               <img width="100%" src="assets/imgstaff/<?= htmlspecialchars($staff_data['img_staff']) ?>" alt="">
           </div>
       </div>
   </div>
   <div class="col-md-8">
       <div class="card">
           <div class="card-header bg-primary">
               <div class="card-title">
                   <h4>Biodata: <?= htmlspecialchars($staff_data['nrn_staff']) ?></h4>
               </div>
           </div>
           <div class="card-body">
               <ul>
                   <li>Naran : <?= htmlspecialchars($staff_data['nrn_staff']) ?></li><hr>
                   <li>Sexo : <?= htmlspecialchars($staff_data['sexo_staff']) ?></li><hr>
                   <li>Data Moris : <?= htmlspecialchars($staff_data['data_moris_staff']) ?></li><hr>
                   <li>Buneru Telefone : <?= htmlspecialchars($staff_data['tlp_staff']) ?></li><hr>
                   <li>Email : <?= htmlspecialchars($staff_data['email_staff']) ?></li><hr>
                   <li>Direksaun : <?= htmlspecialchars($staff_data['nrn_direksaun']) ?></li> <hr>
                   <li><a href="fasilidade" class="btn btn-primary btn-sm"><i class="fa fa-backward"></i> Fila</a></li>
               </ul>
           </div>
       </div>
   </div> 
</div>

<?php
// Ambil id_admin dari URL
$id_admin = $_GET['id']; 

// Admin bisa melihat semua data, tetapi difilter berdasarkan id_admin dari URL
$sql = "SELECT tb_staff.nrn_staff,   
               tb_fasilidade.deskrisaun,
               tb_fasilidade.marka, 
               tb_fasilidade.modelu, 
               tb_fasilidade.serial_number, 
               tb_fasilidade.kondisaun,
               tb_fasilidade.id_fasilidade,
               tb_fasilidade.id_staff  
        FROM tb_fasilidade  
        JOIN tb_staff ON tb_fasilidade.id_staff = tb_staff.id_staff 
        WHERE tb_staff.id_admin = :id_admin";

// Siapkan dan eksekusi query
$stmt = $conn->prepare($sql);

// Mengikat parameter id_admin ke query
$stmt->bindParam(':id_admin', $id_admin, PDO::PARAM_INT);

// Eksekusi query
$stmt->execute();
$karta_fasilidade = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table id="example" class="table table-striped" style="width:100%">
    <a href="dashboard" class="btn btn-primary btn-sm">
        <i class="fa fa-backward"></i> Fila
    </a>
    <thead>       
        <tr>        
            <th>No</th>       
            <th>Naran</th>  
            <th>Deskrisaun</th>
            <th>Marka</th>
            <th>Modelu</th>
            <th>Serial Number</th>
            <th>Kondisaun</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($karta_fasilidade as $row) {
        ?>
            <tr> 
                <td><?php echo htmlspecialchars($no++); ?></td> 
                <td><a class="text-primary" href="?pagekarta=detailstaff&id=<?= htmlspecialchars($row['id_staff']); ?>"><?php echo htmlspecialchars($row['nrn_staff']); ?></a></td>
                <td><?= htmlspecialchars($row['deskrisaun']); ?></td>
                <td><?= htmlspecialchars($row['marka']); ?></td>
                <td><?= htmlspecialchars($row['modelu']); ?></td>
                <td><?= htmlspecialchars($row['serial_number']); ?></td>
                <td><?= htmlspecialchars($row['kondisaun']); ?></td> 
            </tr>    
        <?php } ?>        
    </tbody>              
</table>

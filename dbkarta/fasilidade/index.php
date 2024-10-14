<?php
if ($admin['levelkarta'] == 'adminkarta') {
    // Admin can see all data and grouped by id_staff
    $sql = "SELECT tb_staff.nrn_staff, 
                   COUNT(tb_fasilidade.id_fasilidade) AS total_fasilidade, 
                   GROUP_CONCAT(tb_fasilidade.deskrisaun SEPARATOR ', ') AS deskrisaun, 
                   GROUP_CONCAT(tb_fasilidade.marka SEPARATOR ', ') AS marka, 
                   GROUP_CONCAT(tb_fasilidade.modelu SEPARATOR ', ') AS modelu, 
                   GROUP_CONCAT(tb_fasilidade.serial_number SEPARATOR ', ') AS serial_number, 
                   tb_fasilidade.kondisaun, tb_fasilidade.id_staff 
            FROM tb_fasilidade 
            JOIN tb_staff ON tb_fasilidade.id_staff = tb_staff.id_staff 
            GROUP BY tb_fasilidade.id_staff";
} else if ($admin['levelkarta'] == 'userkarta') {
    // User can see only their own data and grouped by id_staff
    $sql = "SELECT tb_staff.nrn_staff, 
                   COUNT(tb_fasilidade.id_fasilidade) AS total_fasilidade, 
                   GROUP_CONCAT(tb_fasilidade.deskrisaun SEPARATOR ', ') AS deskrisaun, 
                   GROUP_CONCAT(tb_fasilidade.marka SEPARATOR ', ') AS marka, 
                   GROUP_CONCAT(tb_fasilidade.modelu SEPARATOR ', ') AS modelu, 
                   GROUP_CONCAT(tb_fasilidade.serial_number SEPARATOR ', ') AS serial_number, 
                   tb_fasilidade.kondisaun, tb_fasilidade.id_staff
            FROM tb_fasilidade 
            JOIN tb_staff ON tb_fasilidade.id_staff = tb_staff.id_staff 
            WHERE tb_staff.id_admin = :id_admin
            GROUP BY tb_fasilidade.id_staff";
}

// Prepare and execute the query
$stmt = $conn->prepare($sql);

// Bind the id_admin if user is a normal user
if ($admin['levelkarta'] == 'userkarta') {
    $stmt->bindParam(':id_admin', $admin['id_admin']);
}

$stmt->execute();
$karta_fasilidade = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table id="example" class="table table-striped" style="width:100%">
    <a href="addfasilidade" class="btn btn-primary btn-sm">
        <i class="fa fa-edit"></i> Aumenta Dadus
    </a>
    <thead>       
        <tr>        
            <th>No</th>       
            <th>Naran Utilizador</th>  
            <th>Deskrisaun</th>
            <th>Marka</th>
            <th>Modelu</th>
            <th>Serial Number</th>
            <th>Kondisaun</th>
            <th>Total</th>
            <th>Aksaun</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($karta_fasilidade as $row) {
        ?>
            <tr> 
                <td><?php echo htmlspecialchars($no++); ?></td> 
                <td><a class="text-primary" href="?pagekarta=detailstaff&id=<?= $row['id_staff'] ?>"><?php echo htmlspecialchars($row['nrn_staff']); ?></a></td>
                <td><?= htmlspecialchars($row['deskrisaun']); ?></td>
                <td><?= htmlspecialchars($row['marka']); ?></td>
                <td><?= htmlspecialchars($row['modelu']); ?></td>
                <td><?= htmlspecialchars($row['serial_number']); ?></td>
                <td><?= htmlspecialchars($row['kondisaun']); ?></td> 
                <td><?= htmlspecialchars($row['total_fasilidade']); ?></td> <!-- Tampilkan total fasilitas -->
                <td>  
                    <a class="btn btn-warning btn-sm" href="?pagekarta=detailfas&id=<?= $row['id_staff'] ?>">  
                        <i class="fa fa-info"></i>   
                    </a>      
                </td>    
            </tr>  
        <?php } ?>      
    </tbody>           
</table>

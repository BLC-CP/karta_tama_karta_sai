<?php
$id_staff = $_GET['id'];  // Ambil nilai id_staff dari URL

if ($admin['levelkarta'] == 'adminkarta') {
    // Admin can see all data but filtered by id_staff from URL
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
            WHERE tb_fasilidade.id_staff = :id_staff";
} else if ($admin['levelkarta'] == 'userkarta') {
    // User can see only their own data and filtered by id_staff from URL
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
            WHERE tb_fasilidade.id_staff = :id_staff  
            AND tb_staff.id_admin = :id_admin";
}

// Prepare and execute the query
$stmt = $conn->prepare($sql);

// Bind the id_staff (and id_admin for userkarta)
$stmt->bindParam(':id_staff', $id_staff);
if ($admin['levelkarta'] == 'userkarta') {
    $stmt->bindParam(':id_admin', $admin['id_admin']);
}

$stmt->execute();
$karta_fasilidade = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table id="example" class="table table-striped" style="width:100%">
    <a href="fasilidade" class="btn btn-primary btn-sm">
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
                <td>  
                <a class="btn btn-danger btn-sm" href="?pagekarta=deletefasilidade&id_fasilidade=<?php echo htmlspecialchars($row['id_fasilidade']); ?>" onclick="return confirm('Tebes atu hamos <?php echo htmlspecialchars($row['nrn_staff']); ?> ?')"><i class="fa fa-trash"></i></a>       
                <a class="btn btn-primary btn-sm" href="?pagekarta=editfasilidade&id_fasilidade=<?php echo htmlspecialchars($row['id_fasilidade']); ?>" class="text-primary"><i class="fa fa-edit"></i></a>         
                </td>      
            </tr>    
        <?php } ?>        
    </tbody>             
</table>

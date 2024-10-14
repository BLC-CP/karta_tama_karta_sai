<table id="example" class="table table-striped" style="width:100%">
<?php 
    if ($level === 'adminkarta') {
?>
    <a href="addadmin" class="btn btn-primary btn-sm">
    <i class="fa fa-edit"></i> Aumenta Dadus
</a>

    <?php } ?>
    <thead> 
        <tr> 
            <th>No</th> 
            <th>Naran</th> 
            <th>Sexo</th> 
            <th>Data Moris</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Direksaun</th>
            <th>Imagen</th>
            <th>Aksaun</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if ($level === 'adminkarta') {
            $sql = 'SELECT * FROM tb_admin 
                    JOIN tb_direksaun ON tb_admin.id_direksaun = tb_direksaun.id_direksaun';
        } else if ($level === 'userkarta') {
            // If the user is 'userkarta', only show their own data
            $sql = 'SELECT * FROM tb_admin 
                    JOIN tb_direksaun ON tb_admin.id_direksaun = tb_direksaun.id_direksaun 
                    WHERE tb_admin.id_admin = :id_admin';
        }

        // Prepare the SQL query
        $stmt = $conn->prepare($sql);

        // If the level is 'userkarta', bind the admin ID parameter
        if ($level === 'userkarta') {
            $stmt->bindParam(':id_admin', $id_admin, PDO::PARAM_INT);
        }

        // Execute the query
        $stmt->execute();
        $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if there are any results
        if ($admins) {
            $no = 1;
            foreach ($admins as $row) {
        ?>
        <tr>
            <td><?php echo htmlspecialchars($no++); ?></td>
            <td><?php echo htmlspecialchars($row['nrn_admin']); ?></td>
            <td><?php echo htmlspecialchars($row['sexo']); ?></td>
            <td><?php echo htmlspecialchars($row['data_moris']); ?></td>
            <td><?php echo htmlspecialchars($row['tlp']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['nrn_direksaun']); ?></td>
            <td><img src="assets/imgadminkarta/<?php echo htmlspecialchars($row['img']); ?>" alt="Admin Image" style="width:40px;height:40px;"></td>
            <td> 
                
    <?php if ($level === 'adminkarta' && $row['id_admin'] !== $id_admin): ?>

        <a class="btn btn-danger btn-sm" href="?pagekarta=deleteadmin&id_admin=<?php echo htmlspecialchars($row['id_admin']); ?>" class="text-danger" onclick="return confirm('Tebes atu hamos <?php echo htmlspecialchars($row['nrn_admin']); ?> ? ')"> <i class="fa fa-trash"></i> </a>

    <?php endif; ?>
    <a class="btn btn-primary btn-sm" href="?pagekarta=editadmin&id_admin=<?php echo htmlspecialchars($row['id_admin']); ?>" class="text-primary"><i class="fa fa-edit"></i></a>
</td>
            </td> 
        </tr> 
        <?php 
            } 
        } else {
            // If no data is found
            echo "<tr><td colspan='9'>Dadus seidauk iha.</td></tr>"; 
        } 
        ?>  
    </tbody>   
</table>

<table id="example" class="table table-striped nowrap" style="width:100%">
    <a href="adddireksaun" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Aumenta Dadus</a>
    <thead>
        <tr> 
            <th>No</th>  
            <th>Direksaun</th>  
            <th>Aksaun</th> 
        </tr>
    </thead>
    <tbody>
        <?php 
        // Get the level of the current logged-in admin
        $level = $admin['levelkarta']; 
        
            $sql = 'SELECT * FROM tb_direksaun'; // Admin can see all data
       
        
        $stmt = $conn->prepare($sql); 
        $stmt->execute();
        $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($admins) {
            $no = 1;  // Counter for 'No' column
            foreach ($admins as $row) {            
        ?>
        <tr>
            <td><?php echo htmlspecialchars($no++); ?></td>
            <td><?php echo htmlspecialchars($row['nrn_direksaun']); ?></td>
            <td> 
                <?php if ($level === 'adminkarta'): ?>
                    <a class="btn btn-danger btn-sm" href="?pagekarta=deletedireksaun&id_direksaun=<?php echo htmlspecialchars($row['id_direksaun']); ?>" onclick="return confirm('Tebes atu hamos <?php echo htmlspecialchars($row['nrn_direksaun']); ?> ?')"><i class="fa fa-trash"></i></a> 
                <?php endif; ?>
                <a class="btn btn-primary btn-sm" href="?pagekarta=editdireksaun&id_direksaun=<?php echo htmlspecialchars($row['id_direksaun']); ?>" class="text-primary"><i class="fa fa-edit"></i></a> 
            </td> 
        </tr> 
        <?php 
            } 
        } else {
            // Handle case where no results are found
            echo "<tr class='text-center'><td colspan='3'>Ita boot seidauk input data.</td></tr>";
        }
        ?>  
    </tbody>    
</table>

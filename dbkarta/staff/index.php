<table id="example" class="table table-striped" style="width:100%"> 
    <a href="addstaff" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Aumenta Dadus</a> 
    <thead> 
        <tr>  
            <th>No</th>   
            <th>Naran</th>   
            <th>Sexo</th>  
            <th>Data Moris</th> 
            <th>Telefone</th> 
            <th>Email</th> 
            <th>Imagen</th>
            <th>Admin</th> 
            <th>Aksaun</th> 
        </tr> 
    </thead> 
    <tbody>
        <?php 
        // Step 1: Secure PDO connection (assuming $conn is your PDO connection object)
        
        // Prepare SQL query based on user level
        if ($admin['levelkarta'] === 'adminkarta') {
            // Admin can see all data
            $sql = 'SELECT tb_staff.*, tb_admin.nrn_admin FROM tb_staff  
                    JOIN tb_admin ON tb_staff.id_admin = tb_admin.id_admin';  
        } else if ($admin['levelkarta'] === 'userkarta') {
            // User can see only their own data
            $sql = 'SELECT tb_staff.*, tb_admin.nrn_admin FROM tb_staff  
                    JOIN tb_admin ON tb_staff.id_admin = tb_admin.id_admin 
                    WHERE tb_staff.id_admin = :id_admin'; 
        }

        // Step 2: Prepare the statement 
        $stmt = $conn->prepare($sql); 

        // Bind the user ID parameter for user level
        if ($admin['levelkarta'] === 'userkarta') {
            $id_admin = $admin['id_admin']; // Assuming you have the logged-in user's ID
            $stmt->bindParam(':id_admin', $id_admin, PDO::PARAM_INT);
        }

        // Step 3: Execute the query 
        $stmt->execute(); 

        // Step 4: Fetch all results securely 
        $no = 1; 
        $staffs = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            foreach ($staffs as $row) {             
        ?> 
        <tr> 
            <td><?php echo htmlspecialchars($no++); ?></td> 
            <td><?php echo htmlspecialchars($row['nrn_staff']); ?></td> 
            <td><?php echo htmlspecialchars($row['sexo_staff']); ?></td> 
            <td><?php echo htmlspecialchars($row['data_moris_staff']); ?></td> 
            <td><?php echo htmlspecialchars($row['tlp_staff']); ?></td> 
            <td><?php echo htmlspecialchars($row['email_staff']); ?></td> 
            <td> 
                <img src="assets/imgstaff/<?php echo htmlspecialchars($row['img_staff']); ?>"  
                title="Imagen <?php echo htmlspecialchars($row['nrn_staff']); ?>"  
                style="width:40px;height:40px;" > 
            </td> 
            <td><a class="text-primary" href="?pagekarta=detailadmin&id=<?php echo htmlspecialchars($row['id_admin']); ?>"><?php echo htmlspecialchars($row['nrn_admin']); ?></a></td> 
            
            <td> 
                    <a class="btn btn-danger btn-sm" href="?pagekarta=deletestaff&id_staff=<?php echo htmlspecialchars($row['id_staff']); ?>"  
                       onclick="return confirm('Tebes atu hamos <?php echo htmlspecialchars($row['nrn_staff']); ?> ? ')"> 
                       <i class="fa fa-trash"></i> 
                    </a> 
                <a class="btn btn-primary btn-sm" href="?pagekarta=editstaff&id_staff=<?php echo htmlspecialchars($row['id_staff']); ?>"> 
                    <i class="fa fa-edit"></i> 
                </a>  
            </td>  
        </tr>   
        <?php   
            }   
          
        ?>    
    </tbody>     
</table> 

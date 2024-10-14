<!-- Add the table with the data from the database -->
<table id="example" class="table table-striped" style="width:100%">
    <a href="addkaarta_tama" class="btn btn-primary btn-sm">
        <i class="fa fa-edit"></i> Aumenta Dadus
    </a>
    <thead>   
        <tr>    
            <th>No</th>   
            <th>Data Karta Tama</th>  
            <th>Husi Direksaun</th>  
            <th>Haruka mai Direksaun</th>  
            <th>No Ref</th>
            <th>Asuntu</th>
            <th>Hato'o</th>
            <th>Kategoria</th>
            <th>Aksaun</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        // Query to get data from tb_karta_tama with tb_admin for levelkarta
        $sql = 'SELECT tb_karta_tama.*, 
        tb_admin.*, 
        direksaun_admin.nrn_direksaun AS admin_direksaun, 
        direksaun_karta.nrn_direksaun AS karta_direksaun
 FROM tb_karta_tama
 JOIN tb_admin ON tb_karta_tama.id_admin = tb_admin.id_admin
 JOIN tb_direksaun AS direksaun_admin ON tb_admin.id_direksaun = direksaun_admin.id_direksaun
 JOIN tb_direksaun AS direksaun_karta ON tb_karta_tama.id_direksaun = direksaun_karta.id_direksaun';

 
        $stmt = $conn->prepare($sql);  
        $stmt->execute();
        $karta_tama = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Counter for numbering rows
        $no = 1;

        // Loop through each row in the fetched data
        foreach ($karta_tama as $row) {
            // Check if the admin can view the row based on their level
            if ($admin['levelkarta'] === 'adminkarta' || $admin['id_admin'] == $row['id_admin']) { 
        ?>
                <tr> 
                    <td><?php echo htmlspecialchars($no++); ?></td> 
                    <td><?php echo htmlspecialchars($row['data_karta_tama']); ?></td>
                    <td><?php echo htmlspecialchars($row['karta_direksaun']); ?></td> 
                    <td><a class="text-primary" href="?pagekarta=idrel&id=<?php echo htmlspecialchars($row['id_direksaun']); ?>"><?php echo htmlspecialchars($row['admin_direksaun']); ?></a></td> 
                    <td><?php echo htmlspecialchars($row['no_ref']); ?></td>
                    <td><?php echo htmlspecialchars($row['asuntu']); ?></td>
                    <td><?php echo htmlspecialchars($row['hato']); ?></td>
                    <td>
                    <?php 
    // Get the kategoria content
    $kategoria = htmlspecialchars($row['kategoria']);
    
    // Show the first 10 characters only
    $short_kategoria = substr($kategoria, 0, 10);
    ?>
    
    <span id="short_<?php echo $row['id_karta_tama']; ?>">
        <?php echo $short_kategoria; ?>...
    </span>

    <div id="full_<?php echo $row['id_karta_tama']; ?>" style="display: none;">
        <?php echo $kategoria; ?>
    </div>
    
    <a class="text-primary" href="javascript:void(0);" onclick="toggleKategoria(<?php echo $row['id_karta_tama']; ?>)">Read More</a>
</td>
                    <td> 
                        <a class="btn btn-danger btn-sm" href="?pagekarta=deletekarta_tama&id_karta_tama=<?php echo htmlspecialchars($row['id_karta_tama']); ?>" onclick="return confirm('Tebes atu hamos <?php echo htmlspecialchars($row['asuntu']); ?>?')"> 
                            <i class="fa fa-trash"></i> 
                        </a>   
                        <a class="btn btn-primary btn-sm" href="?pagekarta=editkarta_tama&id_karta_tama=<?php echo htmlspecialchars($row['id_karta_tama']); ?>"> 
                            <i class="fa fa-edit"></i> 
                        </a>    
                    </td>  
                </tr>
        <?php 
            } // End of the condition
        } // End of the foreach loop
        ?> 
    </tbody>      
</table>



<?php 
    // Pastikan id_admin diterima dengan benar
    $id_direksaun = $_GET['id'];

    // echo $idDir;
     
    // SQL query untuk mengambil data admin berdasarkan id_admin
    $sql = 'SELECT tb_admin.*, tb_direksaun.nrn_direksaun FROM tb_admin 
            JOIN tb_direksaun ON tb_admin.id_direksaun = tb_direksaun.id_direksaun 
            WHERE tb_direksaun.id_direksaun = :id_direksaun'; 
     
    // Prepare the SQL query 
    $stmt = $conn->prepare($sql);
    
    // Bind parameter
    $stmt->bindParam(':id_direksaun', $id_direksaun, PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();

    // Fetch satu hasil
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // Cek apakah admin ditemukan
    if (!$admin) {
        echo "Direkksaun Laiha.";
        exit;
    }
?>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-text">Profil <?= htmlspecialchars($admin['nrn_admin']) ?> <a class="btn btn-primary btn-sm" href="karta_sai"><i class="fa fa-backward"></i> Fila</a></h5>
            </div>
            <div class="card-block accordion-block">
                <div class="accordion-box" id="single-open">
                    <a class="accordion-msg waves-effect waves-dark text-info">Biodata <?= htmlspecialchars($admin['nrn_admin']) ?></a>
                    <div class="accordion-desc">
                        <ul>
                            <li>Naran: <b class="text-primary"><?= htmlspecialchars($admin['nrn_admin']) ?></b></li>
                            <li>Sexo: <b class="text-primary"><?= htmlspecialchars($admin['sexo']) ?></b></li>
                            <li>Data Moris: <b class="text-primary"><?= htmlspecialchars($admin['data_moris']) ?></b></li>
                            <li>Telefone: <b class="text-primary"><?= htmlspecialchars($admin['tlp']) ?></b></li>
                            <li>Email: <b class="text-primary"><?= htmlspecialchars($admin['email']) ?></b></li>
                            <li>Direksaun: <b class="text-primary"><?= htmlspecialchars($admin['nrn_direksaun']) ?></b></li>
                        </ul>
                    </div>
                    <a class="accordion-msg waves-effect waves-dark text-info">Imagen <?= htmlspecialchars($admin['nrn_admin']) ?></a>
                    <div class="accordion-desc">
                        <img src="assets/imgadminkarta/<?= htmlspecialchars($admin['img']) ?>" alt="" width="100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script> 
<script type="text/javascript" src="assets/pages/accordion/accordion.js"></script>

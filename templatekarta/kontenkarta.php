<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div class="col-xl-12 col-lg-12 col-md-12">
    <div class="row">
    <div class="col-md-4">
    <?php 
        $sql = 'SELECT * FROM tb_karta_tama';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $karta_tama = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $total_karta_tama = count($karta_tama);
    ?>
        <div class="card text-center order-visitor-card">
            <div class="card-block">
                <h5 class="m-b-0">Total Karta Tama</h5>
                <h2 class="m-t-15 m-b-15"><i class="fa fa-book m-r-15 text-c-warning"></i><?= $total_karta_tama; ?></h2> 
            </div> 
        </div> 
    </div> 

    <div class="col-md-4">
    <?php 
        $sql = 'SELECT * FROM tb_karta_sai';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $karta_tama = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $total_karta_tama = count($karta_tama);
    ?>
        <div class="card text-center order-visitor-card">
            <div class="card-block">
                <h5 class="m-b-0">Total Karta Sai</h5>
                <h2 class="m-t-15 m-b-15"><i class="fa fa-book m-r-15 text-c-warning"></i><?= $total_karta_tama; ?></h2> 
            </div> 
        </div> 
    </div> 
    <div class="col-md-4">
    <?php 
        $sql = 'SELECT * FROM tb_fasilidade';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $fasilidade = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $total_fasilidade = count($fasilidade);
    ?>
        <div class="card text-center order-visitor-card">
            <div class="card-block">
                <h5 class="m-b-0">Dadus Ekipamentus</h5>
                <h2 class="m-t-15 m-b-15"><i class="fa fa-book m-r-15 text-c-warning"></i><?= $total_fasilidade; ?></h2> 
            </div> 
        </div> 
    </div> 

    </div> 
</div>

<div class="col-sm-12">
                                                <!-- Bootstrap tab card start -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Grafiku</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <!-- Row start -->
                                                        <div class="row">
                                                            <div class="col-lg-12 col-xl-6">
                                                                <!-- Nav tabs -->
                                                                <ul class="nav nav-tabs  tabs" role="tablist">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" data-toggle="tab" href="#home1" role="tab">Grafiku Karta Tama</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" data-toggle="tab" href="#profile1" role="tab">Grafiku Karta Sai</a>
                                                                    </li>
                                                                </ul>
                                                                <!-- Tab panes -->
                                                                <div class="tab-content tabs card-block">
                                                                    <div class="tab-pane active" id="home1" role="tabpanel">
                                                                            <div id="container1" style="width: 70vw; height: 100vh;" ></div>
                                                                    </div>

                                                                    <!-- Grafiku Karta Sai -->
                                                                    <div class="tab-pane" id="profile1" role="tabpanel">
                                                                        <div id="container" style="width: 70vw; height: 100vh;"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Row end -->
                                                    </div>
                                                </div>
                                                <!-- Bootstrap tab card end -->
</div>


<div class="col-sm-12">

<table class="table table-bordered table-striped table-sm">
    <tr>
        <th>No</th> 
        <th>Total Fasilidade Kada Direksaun</th>  
    </tr>  

    <?php  
    if ($level === 'adminkarta') {
        // Admin can view all data
        $sql = "SELECT tb_admin.id_admin, tb_direksaun.nrn_direksaun, COUNT(tb_fasilidade.id_fasilidade) AS total_fasilidade
                FROM tb_direksaun
                JOIN tb_admin ON tb_admin.id_direksaun = tb_direksaun.id_direksaun
                JOIN tb_staff ON tb_admin.id_admin = tb_staff.id_admin
                JOIN tb_fasilidade ON tb_staff.id_staff = tb_fasilidade.id_staff
                GROUP BY tb_admin.id_admin, tb_direksaun.nrn_direksaun";
    } else {
        // User can only view their own data
        $sql = "SELECT tb_admin.id_admin, tb_direksaun.nrn_direksaun, COUNT(tb_fasilidade.id_fasilidade) AS total_fasilidade
                FROM tb_direksaun
                JOIN tb_admin ON tb_admin.id_direksaun = tb_direksaun.id_direksaun
                JOIN tb_staff ON tb_admin.id_admin = tb_staff.id_admin
                JOIN tb_fasilidade ON tb_staff.id_staff = tb_fasilidade.id_staff
                WHERE tb_admin.id_admin = ?
                GROUP BY tb_admin.id_admin, tb_direksaun.nrn_direksaun";
    }

    // Prepare and execute the query
    $stmt = $conn->prepare($sql);

    // If user is not an admin, bind the admin ID
    if ($level !== 'adminkarta') {
        $stmt->execute([$user_id]);  // For user, filter by their id
    } else {
        $stmt->execute();  // For admin, no filtering
    }

    $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $no = 1;  // Counter for 'No' column
    foreach ($admins as $row) { 
    ?> 
        <tr> 
            <td><?= $no++; ?></td>  <!-- Dynamic row number --> 
            <td><a href="?pagekarta=detailfasdir&id=<?= $row['id_admin']; ?>" class="text-primary">
                <?= $row['nrn_direksaun']; ?> (<?= $row['total_fasilidade']; ?>) Fasilidades</a></td> 
        </tr> 
    <?php } ?>  
</table>


</div>





<script src="https://code.highcharts.com/highcharts.js"></script>

<!-- Grafiku Karta Tama -->
<script>
    Highcharts.chart('container1', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafiku Karta Tama ba Kada Direksaun'
    },
    xAxis: {
        type: 'category',
        labels: {
            autoRotation: [-45, -90],
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Grafiku'
        }
    },
    legend: {
        enabled: false
    },
    series: [{
        name: 'Karta Tama',
        colors: [
            '#77E4C8', '#54C392', '#73EC8B', '#D2FF72', '#7010f9', '#691af3',
            '#6225ed', '#5b30e7', '#533be1', '#4c46db', '#4551d5', '#3e5ccf',
            '#3667c9', '#2f72c3', '#277dbd', '#1f88b7', '#1693b1', '#0a9eaa',
            '#03c69b',  '#00f194'
        ],
        colorByPoint: true,
        groupPadding: 0,
        data: [
            <?php  
            // Step 1: Secure PDO connection (assumed already set up) 

            // Modify SQL query to group by 'id_direksaun' and count the number of 'karta_tama' records
            $sql = "SELECT tb_direksaun.nrn_direksaun, COUNT(tb_karta_tama.id_karta_tama) AS jumlah_karta_tama
                    FROM tb_karta_tama
                    JOIN tb_admin ON tb_karta_tama.id_admin = tb_admin.id_admin
                    JOIN tb_direksaun ON tb_admin.id_direksaun = tb_direksaun.id_direksaun
                    GROUP BY tb_direksaun.id_direksaun";
                    
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $karta_tama = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Step 3: Iterate through the grouped results and output the rows for the chart
            foreach ($karta_tama as $row) {
            ?>
            ["<?= $row['nrn_direksaun'] ?>", <?= $row['jumlah_karta_tama'] ?>],
            <?php } ?>
        ],
        dataLabels: {
            enabled: true,
            rotation: -40,
            color: '#FFFFFF',
            inside: true,
            verticalAlign: 'top',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});

</script>


<!-- Grafiku Karta Sai -->
<script>
    Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafiku Karta Sai ba Kada Direksaun'
    },
    xAxis: {
        type: 'category',
        labels: {
            autoRotation: [-45, -90],
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Grafiku'
        }
    },
    legend: {
        enabled: false
    },
    series: [{
        name: 'Karta Sai',
        colors: [
            '#4535C1', '#478CCF', '#36C2CE', '#77E4C8', '#4551d5', '#3e5ccf',
            '#9b20d9', '#9215ac', '#861ec9', '#7a17e6', '#7010f9', '#691af3',
            '#3667c9', '#2f72c3', '#277dbd', '#1f88b7', '#1693b1', '#0a9eaa',
            '#03c69b',  '#00f194'
        ],
        colorByPoint: true,
        groupPadding: 0,
        data: [
            <?php  
            // Step 1: Secure PDO connection (assumed already set up) 

            // Modify SQL query to group by 'id_direksaun' and count the number of 'karta_tama' records
            $sql = "SELECT tb_direksaun.nrn_direksaun, COUNT(tb_karta_sai.id_karta_sai) AS jumlah_karta_sai
                    FROM tb_karta_sai
                    JOIN tb_admin ON tb_karta_sai.id_admin = tb_admin.id_admin
                    JOIN tb_direksaun ON tb_admin.id_direksaun = tb_direksaun.id_direksaun
                    GROUP BY tb_direksaun.id_direksaun";
                    
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $karta_sai = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Step 3: Iterate through the grouped results and output the rows for the chart
            foreach ($karta_sai as $row) {
            ?>
            ["<?= $row['nrn_direksaun'] ?>", <?= $row['jumlah_karta_sai'] ?>],
            <?php } ?>
        ],
        dataLabels: {
            enabled: true,
            rotation: -40,
            color: '#FFFFFF',
            inside: true,
            verticalAlign: 'top',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});

</script>










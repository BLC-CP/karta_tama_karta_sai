<div class="row">
<div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-header-text">Profil <?= $admin['nrn_admin'] ?></h5>
                                        </div>
                                        <div class="card-block accordion-block">
                                            <div class="accordion-box" id="single-open">
                                                <a class="accordion-msg waves-effect waves-dark text-info">Biodata <?= $admin['nrn_admin'] ?></a>
                                                <div class="accordion-desc">
                                                    <ul>
                                                    <li>Naran : <b class="text-primary"><?= $admin['nrn_admin'] ?></b></li>
                                                    <li>Sexo : <b class="text-primary"><?= $admin['sexo'] ?></b></li>
                                                    <li>Data Moris : <b class="text-primary"><?= $admin['data_moris'] ?></b></li>
                                                    <li>Telefone : <b class="text-primary"><?= $admin['tlp'] ?></b></li>
                                                    <li>Email : <b class="text-primary"><?= $admin['email'] ?></b></li>
                                                    <li>Direksaun : <b class="text-primary"><?= $admin['nrn_direksaun'] ?></b></li>
                                                   </ul>
                                                </div>
                                                <a class="accordion-msg waves-effect waves-dark text-info">Imagen <?= $admin['nrn_admin'] ?></a>
                                                <div class="accordion-desc">
                                                <img src="assets/imgadminkarta/<?= $admin['img'] ?>" alt="" width="100%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
</div>

<script type="text/javascript" src="assets/js/jquery/jquery.min.js "></script>
<script type="text/javascript" src="assets/pages/accordion/accordion.js"></script>

<div class="sidebar_toggle">
    <a href="#"><i class="icon-close icons"></i></a>
</div>
<div class="pcoded-inner-navbar main-menu">
    <div class="">
        <div class="main-menu-header"> 
            <img class="img-80 img-radius" src="assets/imgadminkarta/<?= !empty($admin['img']) ? htmlspecialchars($admin['img']) : 'default-profile.png'; ?>" alt="User-Profile-Image"> 
            <div class="user-details"> 
                <span id="more-details"><?= htmlspecialchars($admin['nrn_admin']) ?><i class="fa fa-caret-down"></i></span>
            </div>
        </div>
        <div class="main-menu-content">
            <ul>
                    <li class="more-details">
                        <a href="?pagekarta=detailadmin&id=<?= $_SESSION['id_admin']; ?>"><i class="ti-user"></i>View Profile</a>
                        <a href="#!"><i class="ti-settings"></i>Settings</a>
                        <a href="logskarta/logoutkarta.php"><i class="ti-layout-sidebar-left"></i>Logout</a>
                    </li>
            </ul>
        </div>
    </div>
    
    <div class="pcoded-navigation-label">Navigation</div>
    <ul class="pcoded-item pcoded-left-item">
        <!-- <li class="active"> -->
        <li class="<?= $current_page == 'dashboard' ? 'active' : '' ?>">
            <a href="/native/carta/dashboard" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                <span class="pcoded-mtext">Dashboard </span>
                <span class="pcoded-mcaret"></span>
            </a>
        </li>
    </ul>

        <div class="pcoded-navigation-label">Dadus Master</div>
        <ul class="pcoded-item pcoded-left-item">
            <!-- <li class="pcoded-hasmenu"> -->
            <li class="pcoded-hasmenu <?= in_array($current_page, ['adminkarta', 'direksaun', 'staff']) ? 'active pcoded-trigger' : '' ?>">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                    <span class="pcoded-mtext">Dadus Input</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                <li class="<?= in_array($current_page, ['adminkarta', 'addadmin', 'editadmin']) ? 'active' : '' ?>">
                        <a href="adminkarta" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Admin</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="<?= in_array($current_page, ['direksaun', 'adddireksaun', 'editdireksaun']) ? 'active' : '' ?>">
                        <a href="direksaun" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Direksaun MCI</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <!-- <li class=""> -->
                    <li class="<?= in_array($current_page, ['staff', 'addstaff', 'editstaff']) ? 'active' : '' ?>">
                        <a href="staff" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Staff</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        
        <div class="pcoded-navigation-label">Dadus Proses</div>
        <ul class="pcoded-item pcoded-left-item">
            <!-- <li class="pcoded-hasmenu"> -->
            <li class="pcoded-hasmenu <?= in_array($current_page, ['karta_tama', 'karta_sai', 'fasilidade']) ? 'active pcoded-trigger' : '' ?>">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BLC</b></span>
                    <span class="pcoded-mtext">Dadus Proses</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <!-- <li class=""> -->
                    <li class="<?= in_array($current_page, ['karta_tama', 'addkaarta_tama', 'editkarta_tama']) ? 'active' : '' ?>">
                        <a href="karta_tama" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Karta Tama</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <!-- <li class=""> -->
                    <li class="<?= in_array($current_page, ['karta_sai', 'addkarta_sai', 'editkarta_sai']) ? 'active' : '' ?>">
                        <a href="karta_sai" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Karta Sai</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <!-- <li class=""> -->
                    <li class="<?= in_array($current_page, ['fasilidade', 'addfasilidade', 'editfasilidade']) ? 'active' : '' ?>">
                        <a href="fasilidade" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext">Registu Fasilidade</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
</div>

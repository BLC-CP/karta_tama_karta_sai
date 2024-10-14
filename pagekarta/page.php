<?php 

$pagekarta = ''; 
$id_admin = null;  // Initialize the ID variable

if (isset($_GET['pagekarta'])) { 
    $pagekarta = $_GET['pagekarta']; 
} elseif (isset($_SERVER['REQUEST_URI'])) { 
    // Extract page and ID from clean URL
    $uri = trim($_SERVER['REQUEST_URI'], '/'); 
    $segments = explode('/', $uri); 
    if (isset($segments[2])) { 
        $pagekarta = $segments[2]; // Page (e.g., 'editadmin')
    }
    if (isset($segments[3])) {
        $id_admin = $segments[3]; // ID (e.g., '123')
    }
}

switch ($pagekarta) {
    // Link Admin 
    case 'adminkarta':
        $titlekarta = 'Dadus Admin';
        $pagekarta = "include 'dbkarta/adminkarta/index.php';";
        break;
    case 'addadmin':
        $titlekarta = 'Aumenta Dadus Admin';
        $pagekarta = "include 'dbkarta/adminkarta/add.php';";
        break;
    case 'editadmin':
        $titlekarta = 'Hadia Dadus Admin';
        $pagekarta = "include 'dbkarta/adminkarta/edit.php';";
        break;
    case 'deleteadmin':
        $titlekarta = '';
        $pagekarta = "include 'dbkarta/adminkarta/delete.php';";
        break;
    case 'detailadmin':
        $titlekarta = '';
        $pagekarta = "include 'dbkarta/adminkarta/detailadmin.php';";
        break;
    // Tambahkan semua case lain sesuai kebutuhan Anda...

	// Link Direksaun 
	case 'direksaun':
		$titlekarta = 'Dadus Direksaun';
		$pagekarta = "include 'dbkarta/direksaun/index.php';";
		break;
		case 'adddireksaun':
		$titlekarta = 'Aumenta Dadus Direksaun';
		$pagekarta = "include 'dbkarta/direksaun/add.php';";
		break;
		case 'editdireksaun':
		$titlekarta = 'Hadia Dadus Direksaun';
		$pagekarta = "include 'dbkarta/direksaun/edit.php';";
		break;
		case 'deletedireksaun':
		$titlekarta = '';
		$pagekarta = "include 'dbkarta/direksaun/delete.php';";
		break;
			// Akhir Link Direksaun

			case 'karta_tama':
				$titlekarta = 'Dadus Karta tama';
				$pagekarta = "include 'dbkarta/karta_tama/index.php';";
				break;
				case 'addkaarta_tama':
				$titlekarta = 'Aumenta Dadus Karta tama';
				$pagekarta = "include 'dbkarta/karta_tama/add.php';";
				break;
				case 'editkarta_tama':
				$titlekarta = 'Hadia Dadus Karta tama';
				$pagekarta = "include 'dbkarta/karta_tama/edit.php';";
				break;
				case 'deletekarta_tama':
				$titlekarta = '';
				$pagekarta = "include 'dbkarta/karta_tama/delete.php';";
				break;
					// Akhir Link Karta tama
			
					// Link Karta sai 
			case 'karta_sai':
				$titlekarta = 'Dadus Karta Sai';
				$pagekarta = "include 'dbkarta/karta_sai/index.php';";
				break;
				case 'addkarta_sai':
				$titlekarta = 'Aumenta Dadus Karta Sai';
				$pagekarta = "include 'dbkarta/karta_sai/add.php';";
				break;
				case 'editkarta_sai':
				$titlekarta = 'Hadia Dadus Karta Sai';
				$pagekarta = "include 'dbkarta/karta_sai/edit.php';";
				break;
				case 'deletekarta_sai':
				$titlekarta = '';
				$pagekarta = "include 'dbkarta/karta_sai/delete.php';";
				break;
					// Akhir Link Karta Sai
			
			
			case 'staff':
				$titlekarta = 'Dadus Staff';
				$pagekarta = "include 'dbkarta/staff/index.php';";
				break;
				case 'addstaff':
				$titlekarta = 'Aumenta Dadus Staff';
				$pagekarta = "include 'dbkarta/staff/add.php';";
				break;
				case 'editstaff':
				$titlekarta = 'Hadia Dadus Staff';
				$pagekarta = "include 'dbkarta/staff/edit.php';";
				break;
				case 'deletestaff':
				$titlekarta = '';
				$pagekarta = "include 'dbkarta/staff/delete.php';";
				break;
				case 'detailstaff':
				$titlekarta = 'Detallu Staff';
				$pagekarta = "include 'dbkarta/staff/detailstaff.php';";
				break;
					// Akhir Link Karta Sai
			
			
					case 'fasilidade':
				$titlekarta = 'Dadus Fasilidade';
				$pagekarta = "include 'dbkarta/fasilidade/index.php';";
				break;
				case 'addfasilidade':
				$titlekarta = 'Aumenta Dadus Fasilidade';
				$pagekarta = "include 'dbkarta/fasilidade/add.php';";
				break;
				case 'editfasilidade':
				$titlekarta = 'Hadia Dadus Fasilidade';
				$pagekarta = "include 'dbkarta/fasilidade/edit.php';";
				break;
				case 'deletefasilidade':
				$titlekarta = '';
				$pagekarta = "include 'dbkarta/fasilidade/delete.php';";
				break;
				case 'detailfas':
				$titlekarta = 'Dadus Admin';
				$pagekarta = "include 'dbkarta/fasilidade/detailfas.php';";
				break;
				case 'detailfasdir':
					$titlekarta = 'Fasilidade Detailu';
					$pagekarta = "include 'dbkarta/fasilidade/detailfasdir.php';";
					break;
					// Akhir Link Karta Sai

    default:
        $titlekarta = 'Dashboard';
        $pagekarta = "include 'templatekarta/kontenkarta.php';";
        break;
}

$KONTENKARTA['mainkarta'] = $pagekarta;

if ($pagekarta === 'editadmin' && $id_admin !== null) {
    // Pass the $id_admin to the edit page
}

?>

<?php 

$pagekarta = '';
if(isset($_GET['pagekarta'])){
	$pagekarta = $_GET['pagekarta'];
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
	$titlekarta = 'Biodata ';
	$pagekarta = "include 'dbkarta/adminkarta/detailadmin.php';";
	break;
	case 'idrel':
	$titlekarta = 'Admin ';
	$pagekarta = "include 'dbkarta/adminkarta/detaildir.php';";
	break;
	case 'idrels':
	$titlekarta = 'Admin';
	$pagekarta = "include 'dbkarta/adminkarta/detaildirs.php';";
	break;
		// Akhir Link Admin

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
			
			// Link Karta tama 
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

?>
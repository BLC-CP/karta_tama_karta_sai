<?php 
session_start(); // Start the session
include 'konfigkarta/konkarta.php'; // Assumed PDO connection is here
include 'pagekarta/page.php';

// Create a new Database instance and get the connection
$db = new Database();
$conn = $db->connect();

if (!isset($_SESSION['email'])) { 
    // If not logged in, redirect to the login page
    header("Location: logskarta/loginkarta.php");
    exit();
}

// Retrieve user data from session
$user_id = $_SESSION['id_admin'];

$sql = "SELECT * FROM tb_admin JOIN tb_direksaun ON tb_admin.id_direksaun=tb_direksaun.id_direksaun WHERE id_admin = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $user_id);
$stmt->execute();
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

// Use the fetched data in your application

$level = $admin['levelkarta']; 
$id_admin = $admin['id_admin']; 

?>

<!DOCTYPE html> 
<html lang="en"> 
<head>
    <title><?= $titlekarta; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="Codedthemes" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <!-- waves.css -->
    <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- Required Framework -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome-n.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css"/>
 </head>
</head> 

<body>

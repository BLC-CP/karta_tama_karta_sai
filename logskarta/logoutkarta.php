<?php
session_start(); // Mulai session

// Hapus semua variabel session
session_unset();

// Hancurkan session
session_destroy();

// Redirect ke halaman login
header("Location: loginkarta.php");
exit();
?>


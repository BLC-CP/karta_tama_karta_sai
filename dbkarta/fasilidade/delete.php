<?php 
// Koneksi ke database (gunakan PDO) 
$conn = new PDO("mysql:host=localhost;dbname=kartamci", "root", ""); 
 
// Pastikan `id_fasilidade` ada di URL 
if (isset($_GET['id_fasilidade'])) { 
    $id_fasilidade = $_GET['id_fasilidade'];  // ID berformat string, tidak perlu casting ke integer
 
    // Siapkan query DELETE 
    $sql = "DELETE FROM tb_fasilidade WHERE id_fasilidade = :id_fasilidade"; 
    $stmt = $conn->prepare($sql); 
 
    // Bind parameter sebagai string, bukan integer
    $stmt->bindParam(':id_fasilidade', $id_fasilidade, PDO::PARAM_STR); 
 
    // Eksekusi query dan cek hasilnya 
    if ($stmt->execute()) { 
        // Redirect ke halaman daftar kartu dengan pesan sukses 
        echo "<script> 
                alert('Dadus hamos ona!'); 
                document.location.href='?pagekarta=fasilidade'; 
              </script>"; 
    } else { 
        // Jika ada kesalahan, tampilkan pesan error 
        echo "<script>alert('Dadus hamos ladiak');</script>"; 
    } 
} 
?>

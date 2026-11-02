<?php
$kecamatan       = $_POST['kecamatan'];
$longitude       = $_POST['longitude'];
$latitude        = $_POST['latitude'];
$luas            = $_POST['luas'];
$jumlah_penduduk = $_POST['jumlah_penduduk'];

// Sesuaikan koneksi dengan database kecamtan
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "kecamtan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Menyesuaikan kolom nama_kecamatan, longtitude, latitude, luas, jumlah_penduduk
$sql = "INSERT INTO kecamatan_jogja (nama_kecamatan, longtitude, latitude, luas, jumlah_penduduk)
VALUES ('$kecamatan', '$longitude', '$latitude', $luas, $jumlah_penduduk)";

if ($conn->query($sql) === TRUE) {
    // Kembali ke halaman index utama setelah berhasil insert
    header("Location: ../index.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
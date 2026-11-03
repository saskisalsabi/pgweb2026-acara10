<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id          = $_POST['id'];
    $nama_objek  = $_POST['nama_objek'];
    $lokasi      = $_POST['lokasi'];
    $latitude    = $_POST['latitude'];
    $longitude   = $_POST['longitude'];
    $judul_buku  = $_POST['judul_buku'];
    $penerbit    = $_POST['penerbit'];
    $narasumber  = $_POST['narasumber'];

    $conn = new mysqli("localhost", "root", "", "bedahbukudiy");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE bedah_buku SET 
            nama_objek='$nama_objek', 
            lokasi='$lokasi', 
            latitude=$latitude, 
            longitude=$longitude, 
            judul_buku='$judul_buku', 
            penerbit='$penerbit', 
            narasumber='$narasumber' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $sql = "INSERT INTO bedah_buku (nama_objek, lokasi, latitude, longitude, judul_buku, penerbit, narasumber) 
            VALUES ('$nama_objek', '$lokasi', $latitude, $longitude, '$judul_buku', '$penerbit', '$narasumber')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "bedahbukudiy");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Mengamankan string dari karakter khusus/tanda petik
    $nama_objek  = $conn->real_escape_string($_POST['nama_objek']);
    $lokasi      = $conn->real_escape_string($_POST['lokasi']);
    $latitude    = is_numeric($_POST['latitude']) ? $_POST['latitude'] : 0;
    $longitude   = is_numeric($_POST['longitude']) ? $_POST['longitude'] : 0;
    $judul_buku  = $conn->real_escape_string($_POST['judul_buku']);
    $penerbit    = $conn->real_escape_string($_POST['penerbit']);
    $narasumber  = $conn->real_escape_string($_POST['narasumber']);

    // Memastikan variabel terbungkus tanda petik tunggal dengan benar
    $sql = "INSERT INTO bedah_buku (nama_objek, lokasi, latitude, longitude, judul_buku, penerbit, narasumber) 
            VALUES ('$nama_objek', '$lokasi', '$latitude', '$longitude', '$judul_buku', '$penerbit', '$narasumber')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
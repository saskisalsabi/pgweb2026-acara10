<!DOCTYPE html>
<html>
<head>
    <title>Form Edit Data Bedah Buku</title>
</head>
<body>
<h2>Form Edit Data Bedah Buku</h2>
<?php
if (!isset($_GET['id'])) {
    header("Location: ../index.php");
    exit();
}

$id = $_GET['id'];
$conn = new mysqli("localhost", "root", "", "bedahbukudiy");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM bedah_buku WHERE id = $id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
    <form action='edit.php' method='post'>
        <input type='hidden' name='id' value='<?php echo $row['id']; ?>'>

        <label>Nama Objek:</label><br>
        <input type='text' name='nama_objek' value='<?php echo $row['nama_objek']; ?>' required><br>

        <label>Lokasi:</label><br>
        <input type='text' name='lokasi' value='<?php echo $row['lokasi']; ?>'><br>

        <label>Latitude:</label><br>
        <input type='text' name='latitude' value='<?php echo $row['latitude']; ?>' required><br>

        <label>Longitude:</label><br>
        <input type='text' name='longitude' value='<?php echo $row['longitude']; ?>' required><br>

        <label>Judul Buku:</label><br>
        <input type='text' name='judul_buku' value='<?php echo $row['judul_buku']; ?>'><br>

        <label>Penerbit:</label><br>
        <input type='text' name='penerbit' value='<?php echo $row['penerbit']; ?>'><br>

        <label>Narasumber:</label><br>
        <input type='text' name='narasumber' value='<?php echo $row['narasumber']; ?>'><br><br>

        <input type='submit' value='Update Data'>
        <a href='../index.php'>Batal</a>
    </form>
<?php
} else {
    echo "Data tidak ditemukan.";
}
$conn->close();
?>
</body>
</html>
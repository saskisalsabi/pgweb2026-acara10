<?php
$servername = "localhost";
$username   = "root";
$password   = ""; 
$dbname     = "bedahbukudiy";

$conn = new mysqli($servername,$username, $password,$dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM bedah_buku";
$result = $conn->query($sql);

echo "<h2>Data Titik Bedah Buku DIY</h2>";
echo "<p><a href='input/index.html'>+ Tambah Data Baru</a></p>";

if ($result &&$result->num_rows > 0) {
    echo "<table border='1px' cellpadding='8' cellspacing='0'>
    <tr>
        <th>Nama Objek</th>
        <th>Lokasi</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Judul Buku</th>
        <th>Penerbit</th>
        <th>Narasumber</th>
        <th colspan='2'>Aksi</th>
    </tr>";

    while($row =$result->fetch_assoc()) {
        echo "<tr>
            <td>".$row["nama_objek"]."</td>
            <td>".$row["lokasi"]."</td>
            <td>".$row["latitude"]."</td>
            <td>".$row["longitude"]."</td>
            <td>".$row["judul_buku"]."</td>
            <td>".$row["penerbit"]."</td>
            <td>".$row["narasumber"]."</td>
            <td><a href='delete.php?id=".$row["id"]."' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a></td>
            <td><a href='edit/index.php?id=".$row["id"]."'>Edit</a></td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "Belum ada data titik bedah buku.";
}

$conn->close();
?>
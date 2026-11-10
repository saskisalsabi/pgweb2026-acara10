<?php
$servername = "localhost";
$username   = "root";
$password   = ""; 
$dbname     = "bedahbukudiy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM bedah_buku";
$result = $conn->query($sql);

// Link Input sederhana di bagian atas
echo "<a href='input/index.html'>Input</a><br><br>";

if ($result && $result->num_rows > 0) {
    // Tanda titik koma di dalam string HTML sudah dihapus
    echo "<table border='1' cellpadding='5' cellspacing='0'>
    <tr>
        <th>Nama Objek</th>
        <th>Lokasi</th>
        <th>Longitude</th>
        <th>Latitude</th>
        <th>Judul Buku</th>
        <th>Penerbit</th>
        <th>Narasumber</th>
        <th>Aksi</th>
    </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>".$row["nama_objek"]."</td>
            <td>".$row["lokasi"]."</td>
            <td>".$row["longitude"]."</td>
            <td>".$row["latitude"]."</td>
            <td>".$row["judul_buku"]."</td>
            <td>".$row["penerbit"]."</td>
            <td>".$row["narasumber"]."</td>
            <td>
                <a href='delete.php?id=".$row["id"]."' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">hapus</a><br>
                <a href='edit/index.php?id=".$row["id"]."'>edit</a>
            </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "Belum ada data.";
}

$conn->close();
?>
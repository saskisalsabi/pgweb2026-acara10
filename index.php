<?php
// Sesuaikan dengan setting MySQL XAMPP
$servername = "localhost";
$username   = "root";
$password   = ""; // Default XAMPP kosong
$dbname     = "kecamtan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari tabel kecamatan_jogja
$sql = "SELECT * FROM kecamatan_jogja";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo "<table border=1px' cellpadding='8' cellspacing='0'>
    <tr>
        <th>Kecamatan</th>
        <th>Longitude</th>
        <th>Latitude</th>
        <th>Luas</th>
        <th>Jumlah Penduduk</th>
    </tr>";

    // Output data per baris
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>".$row["nama_kecamatan"]."</td>
            <td>".$row["longtitude"]."</td>
            <td>".$row["latitude"]."</td>
            <td>".$row["luas"]."</td>
            <td align='right'>".number_format($row["jumlah_penduduk"])."</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
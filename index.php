<?php
// Koneksi ke Database bedahbukudiy
$servername = "localhost";
$username   = "root";
$password   = ""; 
$dbname     = "bedahbukudiy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil semua data titik dari database
$sql = "SELECT * FROM bedah_buku";
$result = $conn->query($sql);

$data_points = array();
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data_points[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web GIS Bedah Buku DIY - Acara 10</title>
    
    <!-- Leaflet CSS Library -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 15px;
        }
        /* Layout Peta */
        #map {
            width: 100%;
            height: 450px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }
        /* Layout Tabel & Tautan */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

<h2>WebGIS Titik Kegiatan Bedah Buku DIY</h2>
<a href="input/index.html">Input Data Baru</a><br><br>

<!-- Wadah Peta LeafletJS -->
<div id="map"></div>

<!-- Tabel Data Hasil Gabungan Acara 8 & 9 -->
<h3>Daftar Data Lokasi</h3>
<table>
    <tr>
        <th>Nama Objek</th>
        <th>Lokasi</th>
        <th>Longitude</th>
        <th>Latitude</th>
        <th>Judul Buku</th>
        <th>Penerbit</th>
        <th>Narasumber</th>
        <th>Aksi</th>
    </tr>
    <?php
    if (count($data_points) > 0) {
        foreach($data_points as $row) {
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
    } else {
        echo "<tr><td colspan='8'>Belum ada data.</td></tr>";
    }
    ?>
</table>

<!-- Leaflet JavaScript Library -->
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
<script>
    /* 1. Inisialisasi Peta (Center di DIY) */
    var map = L.map('map').setView([-7.7956, 110.3695], 10);

    /* 2. Tile Basemap Options */
    var basemap1 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri'
    });

    var basemap2 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    });

    // Default Basemap
    basemap2.addTo(map);

    /* 3. Membuat Layer Group untuk Marker dari Database */
    var markerGroup = L.layerGroup();

    // Data PHP dikonversi ke JSON JavaScript
    var phpData = <?php echo json_encode($data_points); ?>;

    // Looping memasukkan titik lokasi & Popup ke Peta
    phpData.forEach(function(item) {
        if (item.latitude && item.longitude) {
            var marker = L.marker([parseFloat(item.latitude), parseFloat(item.longitude)]);
            
            // Format Konten PopUp
            var popupContent = "<b>" + item.nama_objek + "</b><br>" +
                               "<b>Lokasi:</b> " + item.lokasi + "<br>" +
                               "<b>Judul Buku:</b> " + item.judul_buku + "<br>" +
                               "<b>Penerbit:</b> " + item.penerbit + "<br>" +
                               "<b>Narasumber:</b> " + item.narasumber;

            marker.bindPopup(popupContent);
            markerGroup.addLayer(marker);
        }
    });

    // Tampilkan semua marker ke peta
    markerGroup.addTo(map);

    /* 4. Layer Control (Pengaturan Basemap & Overlay) */
    var baseMaps = {
        "OpenStreetMap": basemap2,
        "Esri World Imagery": basemap1
    };

    var overlayMaps = {
        "Titik Bedah Buku": markerGroup
    };

    L.control.layers(baseMaps, overlayMaps, { collapsed: false }).addTo(map);

    /* 5. Scale Bar */
    L.control.scale({
        maxWidth: 150, 
        position: 'bottomright'
    }).addTo(map);
</script>

</body>
</html>
<?php $conn->close(); ?>
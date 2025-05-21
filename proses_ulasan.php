<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $komentar = $_POST['komentar'];
    $rating = $_POST['rating'];

    $query = "INSERT INTO ulasan_pengunjung (nama, komentar, rating) VALUES ('$nama', '$komentar', '$rating')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php"); // kembali ke halaman utama
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}
?>
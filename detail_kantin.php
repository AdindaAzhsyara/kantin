<?php
include 'koneksi.php';

if (!isset($_GET['kantin_id'])) {
  echo "Kantin tidak ditemukan.";
  exit;
}

$kantin_id = $_GET['kantin_id'];
$query = mysqli_query($koneksi, "SELECT * FROM kantin WHERE kantin_id = '$kantin_id'");
$data = mysqli_fetch_array($query);

// Kalau mau ada tabel menu (optional)
$menuQuery = mysqli_query($koneksi, "SELECT * FROM menu WHERE kantin_id = '$kantin_id'");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Detail Kantin</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container my-5">
    <a href="index.php" class="btn btn-secondary mb-4">← Kembali ke Daftar Toko</a>
    <div class="row">
      <div class="col-md-5">
        <img src="uploads/<?php echo $data['gambar']; ?>" class="img-fluid rounded">
      </div>
      <div class="col-md-7">
        <h2><?php echo $data['nama_kantin']; ?></h2>
        <p><strong>Jam Buka:</strong> <?php echo $data['jam_buka']; ?> - <?php echo $data['jam_tutup']; ?></p>
        <p><strong>Harga:</strong> Rp<?php echo $data['harga_min']; ?> - Rp<?php echo $data['harga_max']; ?></p>
      </div>
    </div>

    <hr>
    <h4>Menu</h4>
    <div class="row">
      <?php while ($menu = mysqli_fetch_array($menuQuery)) { ?>
        <div class="col-md-4">
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title"><?php echo $menu['nama_menu']; ?></h5>
              <p class="card-text">Harga: Rp<?php echo $menu['harga']; ?></p>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</body>
</html>

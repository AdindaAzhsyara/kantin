<?php
include 'koneksi.php';

// Ambil semua toko dari kategori "Camilan"
$query = "SELECT k.kantin_id, k.nama_kantin, k.jam_buka, k.jam_tutup, k.nama_kantin, k.harga_min, 
            k.harga_max, 
            k.gambar
          FROM kantin k
          JOIN kategori_kantin kk ON k.kantin_id = kk.kantin_id
          JOIN kategori kat ON kk.kategori_id = kat.kategori_id
          WHERE kat.nama_kategori = 'Camilan'";

$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kategori Camilan - Kantin Reborn</title>
  <style>
    body {
      margin: 0976;
      font-family: 'Segoe UI', sans-serif;
      background-color: #fff;
    }

    header {
      background-color: #4a4a4a;
      padding: 16px 24px;
      display: flex;
      align-items: center;
      color: white;
      font-weight: bold;
      font-size: 24px;
    }

    header .brand {
      color: white;
    }

    header .brand span {
      color: red;
    }

    .category-bar {
      display: flex;
      align-items: center;
      padding: 20px 24px;
    }

    .category-bar img {
      width: 40px;
      margin-right: 10px;
    }

    .category-bar .back {
      margin-right: 20px;
      text-decoration: none;
      font-size: 20px;
      color: #000;
    }

    .container {
      max-width: 900px;
      margin: auto;
      padding: 20px;
    }

    .kantin-item {
      display: flex;
      gap: 20px;
      align-items: center;
      background-color: #fff;
      margin-bottom: 24px;
    }

    .kantin-item img {
      width: 140px;
      height: 100px;
      object-fit: cover;
      border-radius: 12px;
    }

    .kantin-info {
      flex: 1;
    }

    .kantin-info h3 {
      margin: 0;
      font-size: 20px;
      font-weight: bold;
    }

    .badge {
      display: inline-block;
      background-color: red;
      color: white;
      font-size: 12px;
      padding: 2px 8px;
      border-radius: 12px;
      margin: 4px 0;
    }

    .info-line {
      display: flex;
      align-items: center;
      font-size: 14px;
      color: #555;
      margin-top: 4px;
    }

    .info-line img {
      width: 16px;
      height: 16px;
      margin-right: 6px;
    }

    footer {
      background-color: red;
      color: white;
      text-align: center;
      padding: 12px;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>
<body>

  <header>
    <div class="brand">Kantin<span>Reborn</span></div>
  </header>

  <div class="category-bar">
    <a href="index.php" class="back">←</a>
    <img src="img/camilan.png" alt="Camilan">
    <h2>Camilan</h2>
  </div>

<div class="container">
  <?php if ($result && $result->num_rows > 0): ?>
    <?php while($row = $result->fetch_assoc()): ?>
      <div class="kantin-item">
        <img src="img/<?= htmlspecialchars($row['gambar'] ?? 'placeholder.jpg') ?>" alt="<?= htmlspecialchars($row['nama_kantin'] ?? 'Nama tidak tersedia') ?>">
        <div class="kantin-info">
          <h3><?= htmlspecialchars($row["nama_kantin"] ?? 'Nama tidak tersedia') ?></h3>
          <div class="badge">Camilan</div>
          <div class="info-line">
            <img src="img/icon-tag.png" alt="Harga">
            <?php if (isset($row["harga_min"]) && isset($row["harga_max"])): ?>
              Rp<?= number_format($row["harga_min"], 0, ',', '.') ?>–Rp<?= number_format($row["harga_max"], 0, ',', '.') ?>
            <?php else: ?>
              Harga tidak tersedia
            <?php endif; ?>
          </div>
          <p>Jam buka: <?= htmlspecialchars($row["jam_buka"] ?? '-') ?> - <?= htmlspecialchars($row["jam_tutup"] ?? '-') ?></p>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>Tidak ada toko yang menjual camilan.</p>
  <?php endif; ?>
</div>


  <footer>
    Hak cipta © 2025 Dibuat oleh Kelompok 6
  </footer>

</body>
</html>

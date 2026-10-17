<?php
$page_title = "Beranda";
include __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$totalBuku    = $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();
$totalAnggota = $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();
$totalStok    = $pdo->query("SELECT COALESCE(SUM(stok), 0) FROM buku")->fetchColumn();
?>
<section>
  <h2>Selamat Datang di SIMPUS-Mini</h2>
  <?php if ($flash): ?>
    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo e($flash['pesan']); ?></p>
  <?php endif; ?>
  <p>Sistem Informasi Perpustakaan Mini untuk mengelola data buku dan anggota.</p>
  <?php if (!$sudahLogin): ?>
    <p>Anda masuk sebagai tamu. <a href="auth/login.php">Login sebagai petugas</a> untuk mengelola data.</p>
  <?php endif; ?>
</section>

<section>
  <h2>Statistik</h2>
  <div class="stats">
    <article>
      <h3>Total Buku</h3>
      <p><?php echo $totalBuku; ?></p>
    </article>
    <article>
      <h3>Total Anggota</h3>
      <p><?php echo $totalAnggota; ?></p>
    </article>
    <article>
      <h3>Total Stok</h3>
      <p><?php echo $totalStok; ?></p>
    </article>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>

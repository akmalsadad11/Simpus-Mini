<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}
csrf_verify();

$nama = trim($_POST['nama'] ?? '');
$no_anggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');

$errors = [];
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($no_anggota === '') {
    $errors[] = "No. anggota wajib diisi.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        "INSERT INTO anggota (nama, no_anggota, alamat, no_hp)
         VALUES (:nama, :no_anggota, :alamat, :no_hp)
         RETURNING id"
    );
    $stmt->execute([
    'nama' => $nama,
    'no_anggota' => $no_anggota,
    'alamat' => $alamat,
    'no_hp' => $no_hp,
    ]);
} catch (PDOException $e) {
    $pesan = $e->getCode() === '23505' ? 'Data sudah ada (nomor duplikat).' : 'Gagal menyimpan data.';
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => $pesan];
    header('Location: tambah.php');
    exit;
}

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil ditambahkan.'];
header('Location: list.php');
exit;

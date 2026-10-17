<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}
csrf_verify();

$id = $_POST['id'] ?? null;
$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = $_POST['tahun'] ?? '';
$isbn = trim($_POST['isbn'] ?? '');
$stok = $_POST['stok'] ?? '';
$kategori = trim($_POST['kategori'] ?? '');

if (!$id) {
    header('Location: list.php');
    exit;
}

$errors = [];
if ($judul === '') {
    $errors[] = "Judul wajib diisi.";
}
if ($pengarang === '') {
    $errors[] = "Pengarang wajib diisi.";
}
if (!is_numeric($tahun) || $tahun < 1900 || $tahun > 2026) {
    $errors[] = "Tahun harus antara 1900-2026.";
}
if (!is_numeric($stok) || $stok < 0) {
    $errors[] = "Stok tidak boleh negatif.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: edit.php?id=' . $id);
    exit;
}

try {
    $stmt = $pdo->prepare(
        "UPDATE buku SET judul = :judul, pengarang = :pengarang, tahun = :tahun, isbn = :isbn, stok = :stok, kategori = :kategori
         WHERE id = :id"
    );
    $stmt->execute([
    'judul' => $judul,
    'pengarang' => $pengarang,
    'tahun' => (int) $tahun,
    'isbn' => $isbn,
    'stok' => (int) $stok,
    'kategori' => $kategori,
    'id' => $id,
    ]);
} catch (PDOException $e) {
    $pesan = $e->getCode() === '23505' ? 'Data sudah ada (nomor duplikat).' : 'Gagal memperbarui data.';
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => $pesan];
    header('Location: edit.php?id=' . $id);
    exit;
}

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Buku berhasil diperbarui.'];
header('Location: list.php');
exit;

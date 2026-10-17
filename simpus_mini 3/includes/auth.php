<?php
// Guard clause: include di baris paling atas setiap halaman yang wajib login
// (SEBELUM header.php), agar header('Location: ...') masih bisa dipanggil.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

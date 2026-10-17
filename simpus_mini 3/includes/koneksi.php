<?php
// Koneksi ke PostgreSQL menggunakan PDO
$host = "localhost";
$port = "5433";
$db   = "simpus_mini 3";
$user = "postgres";
$pass = "1";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

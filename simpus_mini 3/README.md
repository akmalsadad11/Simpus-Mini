# SIMPUS-Mini (Jobsheet 1-11, hasil akhir)

Sistem Informasi Perpustakaan Mini: PHP + PostgreSQL (PDO).

## Menjalankan
1. Pastikan PostgreSQL berjalan dan ekstensi `pdo_pgsql` aktif (`php -m | grep pgsql`).
2. `createdb simpus_mini`
3. `psql -d simpus_mini -f sql/01_buku_anggota.sql`
4. `psql -d simpus_mini -f sql/02_users.sql`
5. Sesuaikan `$user` dan `$pass` di `includes/koneksi.php`.
6. Jalankan: `php -S localhost:8000` di folder ini, lalu buka http://localhost:8000

Daftar akun petugas lewat halaman Registrasi, lalu login.

## Keamanan (Jobsheet 11)
- `includes/helpers.php`: fungsi `e()` untuk mencegah XSS.
- `includes/csrf.php`: `csrf_token()`, `csrf_field()`, `csrf_verify()` untuk semua form POST.
- `session_regenerate_id(true)` setelah login berhasil.
- Query memakai prepared statement. Detail audit: `docs/security-checklist.md`.

## Hak akses
- Tamu: Beranda + Daftar Buku. Login wajib untuk tambah/edit/hapus buku dan seluruh halaman anggota.

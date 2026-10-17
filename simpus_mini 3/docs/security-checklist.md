# Security Checklist — Jobsheet 11

Audit terhadap kode Jobsheet 7-10. Prinsip utama: **jangan percaya input dari luar**.

| # | Kerentanan | Ditemukan di | Sebelum | Sesudah (perbaikan) |
|---|------------|--------------|---------|---------------------|
| 1 | SQL Injection | seluruh query (`koneksi.php`, `proses_*.php`, `list.php`) | Sudah memakai prepared statement sejak Jobsheet 8 | Audit ulang: aman, tidak ada perubahan. Uji `' OR '1'='1` di form login tidak berhasil. |
| 2 | XSS | `list.php`, `edit.php`, header (nama petugas), flash | `echo` langsung nilai dari DB/`$_GET` | Semua output teks dibungkus `e()` (`htmlspecialchars`, `ENT_QUOTES`). Kolom angka (`tahun`, `stok`) tidak perlu. |
| 3 | CSRF | semua form POST, `proses_*.php`, `hapus.php` | Form bisa dikirim dari situs lain | `csrf_field()` di setiap form, `csrf_verify()` sebelum menyentuh database. Tanpa token: HTTP 403. |
| 4 | Input Validation | `proses_tambah.php`, `proses_edit.php` | Validasi sudah ada | Audit ulang + type casting `(int)` untuk id, tahun, stok. |
| 5 | Session Fixation | `auth/proses_login.php` | ID sesi tetap setelah login | `session_regenerate_id(true)` dipanggil setelah `password_verify` berhasil. |

## Cara menguji
1. **XSS**: tambah buku dengan judul `<script>alert(1)</script>` -> di daftar buku tampil sebagai teks, bukan pop-up.
2. **CSRF**: setelah login, kirim `curl -X POST http://localhost:8000/buku/proses_tambah.php -d "judul=x"` tanpa `csrf_token` -> harus 403.
3. **Urutan guard**: `auth.php` selalu di-require sebelum `csrf.php` pada halaman proses, sehingga pengguna yang belum login langsung dialihkan ke login.

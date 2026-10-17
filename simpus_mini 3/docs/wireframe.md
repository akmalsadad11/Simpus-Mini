# Wireframe SIMPUS-Mini

## Aktor
- **Tamu**: hanya melihat Beranda dan Daftar Buku (tanpa login).
- **Petugas**: login untuk mengelola buku dan anggota (CRUD).

## Halaman Login
```
+--------------------------------------+
|             SIMPUS-Mini              |
|--------------------------------------|
|  [ Login Petugas ]                   |
|  Username : [______________]         |
|  Password : [______________]         |
|  [ Login ]                           |
|  Belum punya akun? Daftar di sini    |
+--------------------------------------+
```

## Dashboard / Beranda
```
+-----------------------------------------------------+
| SIMPUS-Mini  Beranda | Buku | Anggota   (Nama) Logout|
|-----------------------------------------------------|
|  [ Total Buku ]  [ Total Anggota ]  [ Total Stok ]   |
+-----------------------------------------------------+
```

## Alur Pengguna
Login -> Beranda -> Daftar Buku -> Tambah / Edit / Hapus -> Daftar Buku (flash message)

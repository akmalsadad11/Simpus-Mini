CREATE TABLE IF NOT EXISTS buku (
    id        SERIAL PRIMARY KEY,
    judul     VARCHAR(255) NOT NULL,
    pengarang VARCHAR(255) NOT NULL,
    tahun     INTEGER NOT NULL,
    isbn      VARCHAR(50),
    stok      INTEGER NOT NULL DEFAULT 0,
    kategori  VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS anggota (
    id         SERIAL PRIMARY KEY,
    nama       VARCHAR(255) NOT NULL,
    no_anggota VARCHAR(50) NOT NULL UNIQUE,
    alamat     VARCHAR(255),
    no_hp      VARCHAR(30)
);

INSERT INTO buku (judul, pengarang, tahun, isbn, stok, kategori) VALUES
 ('Algoritma dan Pemrograman', 'Rinaldi Munir', 2016, '9786026231', 5, 'non-fiction'),
 ('Laskar Pelangi', 'Andrea Hirata', 2005, '9789793062792', 3, 'fiction'),
 ('Kamus Besar Bahasa Indonesia', 'Tim Redaksi', 2016, NULL, 2, 'reference');

INSERT INTO anggota (nama, no_anggota, alamat, no_hp) VALUES
 ('Budi Santoso', 'A001', 'Malang', '081234567890'),
 ('Siti Aminah', 'A002', 'Surabaya', '081298765432');

CREATE TABLE IF NOT EXISTS users (
    id       SERIAL PRIMARY KEY,
    nama     VARCHAR(255) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role     VARCHAR(20) NOT NULL DEFAULT 'petugas'
);


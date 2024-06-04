-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 31 Mar 2024 pada 15.17
-- Versi server: 8.0.30
-- Versi PHP: 8.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_arsip_digital`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `admin_id` int NOT NULL,
  `admin_nama` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_nama`, `admin_username`, `admin_password`, `admin_foto`) VALUES
(1, 'Fan Fan Firgiawan', 'admin', '0192023a7bbd73250516f069df18b500', '1471275613_Screen Shot 2019-10-11 at 16.26.42.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `arsip`
--

CREATE TABLE `arsip` (
  `arsip_id` int NOT NULL,
  `arsip_waktu_upload` datetime NOT NULL,
  `arsip_petugas` int NOT NULL,
  `arsip_kode` varchar(255) NOT NULL,
  `arsip_nama` varchar(255) NOT NULL,
  `arsip_jenis` varchar(255) NOT NULL,
  `arsip_kategori` int NOT NULL,
  `arsip_keterangan` text NOT NULL,
  `arsip_file` varchar(255) NOT NULL,
  `status` enum('Pending','Diterima','Ditolak') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `arsip`
--

INSERT INTO `arsip` (`arsip_id`, `arsip_waktu_upload`, `arsip_petugas`, `arsip_kode`, `arsip_nama`, `arsip_jenis`, `arsip_kategori`, `arsip_keterangan`, `arsip_file`, `status`) VALUES
(14, '2024-03-31 15:50:25', 4, 'test1', 'test1', 'xlsx', 4, 'test1', '780705458_Format.xlsx', 'Diterima'),
(15, '2024-03-31 15:50:40', 4, 'test2', 'test2', 'docx', 8, 'test2', '68091662_26547705_CV_FANFAN_EC.docx', 'Diterima'),
(18, '2024-03-31 15:52:04', 5, 'test3', 'test3', 'xlsx', 4, 'test3', '982100753_Format.xlsx', 'Ditolak'),
(19, '2024-03-31 15:52:37', 5, 'test4', 'test4', 'docx', 8, 'test4', '1641138031_26547705_CV_FANFAN_EC.docx', 'Diterima'),
(20, '2024-03-31 20:57:17', 5, 'test5', 'test5', 'pdf', 4, 'test5', '257906340_Booklet-MPASI-revised-A-10-oktober-2018.pdf', 'Pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int NOT NULL,
  `kategori_nama` varchar(255) NOT NULL,
  `kategori_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_nama`, `kategori_keterangan`) VALUES
(1, 'Tidak berkategori', 'Semua yang tidak memiliki kategori'),
(8, 'Surat Lampiran Skripsi', 'Surat contoh lampiran untuk skripsi'),
(10, 'Curiculum Vitae', 'Contoh format surat curiculum vitae untuk kenaikan jabatan'),
(12, 'Surat Keputusan Jadwal', 'Surat Keputasan Untuk Merubah Jadwal Pelajaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `mahasiswa_id` int NOT NULL,
  `mahasiswa_nama` varchar(255) NOT NULL,
  `mahasiswa_nim` varchar(100) NOT NULL,
  `mahasiswa_password` varchar(255) NOT NULL,
  `mahasiswa_foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`mahasiswa_id`, `mahasiswa_nama`, `mahasiswa_nim`, `mahasiswa_password`, `mahasiswa_foto`) VALUES
(4, 'Fan Fan Firgiawan', '1222624', 'e10adc3949ba59abbe56e057f20f883e', ''),
(5, 'Angga T Yanuar', '1222638', 'e10adc3949ba59abbe56e057f20f883e', ''),
(22, 'Ananda Raisya', '1222621', 'e10adc3949ba59abbe56e057f20f883e', ''),
(23, 'Hadi Rahmat', '1222622', 'e10adc3949ba59abbe56e057f20f883e', ''),
(24, 'Gatau', '1222620', 'e10adc3949ba59abbe56e057f20f883e', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `petugas_id` int NOT NULL,
  `petugas_nama` varchar(255) NOT NULL,
  `petugas_username` varchar(255) NOT NULL,
  `petugas_password` varchar(255) NOT NULL,
  `petugas_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`petugas_id`, `petugas_nama`, `petugas_username`, `petugas_password`, `petugas_foto`) VALUES
(4, 'Jhony Andrean', 'petugas1', 'b53fe7751b37e40ff34d012c7774d65f', ''),
(5, 'Junaidi Mus', 'petugas2', 'ac5604a8b8504d4ff5b842480df02e91', ''),
(6, 'Jamilah Suanda', 'petugas3', '6f7dc121bccfd778744109cac9593474', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat`
--

CREATE TABLE `riwayat` (
  `riwayat_id` int NOT NULL,
  `riwayat_waktu` datetime NOT NULL,
  `riwayat_user` int NOT NULL,
  `riwayat_arsip` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `riwayat`
--

INSERT INTO `riwayat` (`riwayat_id`, `riwayat_waktu`, `riwayat_user`, `riwayat_arsip`) VALUES
(1, '2019-10-11 15:32:29', 8, 3),
(2, '2019-10-12 17:09:31', 8, 10),
(3, '2019-10-12 17:09:45', 8, 9),
(4, '2019-10-12 17:09:50', 8, 8),
(5, '2019-10-12 17:09:53', 8, 3),
(6, '2019-10-12 17:10:07', 9, 10),
(7, '2019-10-12 17:10:16', 9, 9),
(8, '2019-10-12 17:10:19', 9, 8),
(9, '2019-10-12 17:10:22', 9, 6),
(10, '2019-10-12 17:10:26', 9, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_foto`) VALUES
(8, 'Samsul Bahri', 'user1', '24c9e15e52afc47c225b757e7bee1f9d', ''),
(9, 'Reza Yuzanni', 'user2', '7e58d63b60197ceb55a1c487989a3720', ''),
(10, 'Ajir Muhajier', 'user3', '92877af70a45fd6a2ed7fe81e1236b78', ''),
(11, 'Cut Nanda Somay', 'user4', '3f02ebe3d7929b091e3d8ccfde2f3bc6', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`arsip_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`mahasiswa_id`),
  ADD UNIQUE KEY `unique_mahasiswa_nim` (`mahasiswa_nim`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`petugas_id`);

--
-- Indeks untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`riwayat_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `arsip`
--
ALTER TABLE `arsip`
  MODIFY `arsip_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `mahasiswa_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `petugas_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `riwayat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

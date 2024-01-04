-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jan 2024 pada 16.33
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rekammedis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_obat`
--

CREATE TABLE `tb_obat` (
  `id` int(10) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `kegunaan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_obat`
--

INSERT INTO `tb_obat` (`id`, `nama_obat`, `kegunaan`) VALUES
(4, 'acetazolamide', 'mencegah kejang dan epilepsi'),
(5, 'benzodiazepin', 'mengendurkan otot tubuh'),
(7, 'Extract Ganja', 'Penenang otak'),
(9, 'balsem', 'untuk nyeri otot,\r\nkeseleo'),
(10, 'rivanol', 'kompres luka yang membengkak'),
(11, 'Hansaplast', 'menutup luka kecil'),
(12, 'Betadin', 'mencegah infeksi'),
(13, 'Perban roll', 'untuk membalut luka'),
(14, 'Panadol', 'untuk demam'),
(15, 'Oskadon', 'untuk sakit kepala, sakit gigi'),
(16, 'Ching Wan Hun', 'untuk luka bakar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `id` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tnggl_lahir` date NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `telpon` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pasien`
--

INSERT INTO `tb_pasien` (`id`, `nama`, `tnggl_lahir`, `gender`, `telpon`, `alamat`) VALUES
('231220113854', 'asep', '2001-01-01', 'L', '123456789', 'jln tamrin'),
('231220123422', 'cinta laura', '2010-02-16', 'P', '08767865453', 'Jln medan'),
('231220123537', 'eying', '2004-09-09', 'P', '0890866453', 'jln cut nyak dien'),
('231220123617', 'dewa', '2010-11-11', 'L', '0876546890', 'jln deponegoro'),
('231220123641', 'dewi', '2022-02-12', 'P', '556534345', 'jln moh yamin'),
('231224081416', 'Rahma', '2023-10-19', 'P', '087654321', 'pancor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rekammedis`
--

CREATE TABLE `tb_rekammedis` (
  `no_rm` varchar(15) NOT NULL,
  `tgl_rm` date NOT NULL,
  `id_pasien` varchar(20) NOT NULL,
  `keluhan` text NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `diagnosa` text NOT NULL,
  `obat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_rekammedis`
--

INSERT INTO `tb_rekammedis` (`no_rm`, `tgl_rm`, `id_pasien`, `keluhan`, `id_dokter`, `diagnosa`, `obat`) VALUES
('RM-001-241223', '2023-03-11', '231220123617', 'sakit kepala', 48, 'kepala berdarah', 'benzodiazepin, Extract Ganja, rivanol, Betadin, Panadol, Oskadon, Ching Wan Hun'),
('RM-002-221223', '2023-05-18', '231220123537', 'sakit perut', 41, 'perutt kosong', 'Betadin, Hansaplast'),
('RM-002-241223', '2023-02-16', '231220123641', 'sakit kepala', 48, 'kepala berdarah', 'benzodiazepin, Extract Ganja'),
('RM-003-241223', '2023-03-16', '231220123641', 'sakit tangan, sakit mata, sakit kepala', 48, 'kepala dingin, kepala panas, tangan panjang, mata merah', 'acetazolamide, rivanol, benzodiazepin, Oskadon'),
('RM-004-241223', '2023-05-19', '231220123422', 'flu', 41, 'demam', 'Betadin'),
('RM-005-241223', '2023-07-20', '231220123537', 'sakit hati', 41, 'hati ayam', 'benzodiazepin'),
('RM-006-241223', '2023-11-23', '231220123641', 'filek', 41, 'filek', 'balsem, Betadin'),
('RM-007-241223', '2023-05-24', '231224081416', 'pelit', 48, 'siti qorun', 'Perban roll'),
('RM-008-241223', '2022-12-22', '231224081416', 'sakit pinggang', 41, 'kelelahan', 'Extract Ganja, Ching Wan Hun');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jabatan` enum('1','2','3') NOT NULL COMMENT '1=administrator, 2=petugas, 3=dokter',
  `alamat` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `fullname`, `password`, `jabatan`, `alamat`, `gambar`) VALUES
(36, 'admin', 'Administrator', '$2y$10$G5awr/oKTZPV4LxiHWC7M.GAQ2nVidt3BGqNslALOxrE.y8uWQzl6', '1', 'jalan depanogoro', '1702901396-ganjar.jpg'),
(41, 'Asep', 'DR. Asep', '$2y$10$cCmasN3kwIkyNzR6SrgX6.ARB1XtKJG49C8sTvjJqesifB70wZaLO', '3', 'jln z', 'user2.png'),
(48, 'rudi', 'DR. SALIM', '$2y$10$awX0dC3tnSCXDWZ7qww7HekAQAjNYI5S7PVahDpwHiul51Vjgw9.e', '3', 'Jln kencana', '1703380694-doctor-man.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_rekammedis`
--
ALTER TABLE `tb_rekammedis`
  ADD PRIMARY KEY (`no_rm`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_rekammedis`
--
ALTER TABLE `tb_rekammedis`
  ADD CONSTRAINT `tb_rekammedis_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `tb_pasien` (`id`),
  ADD CONSTRAINT `tb_rekammedis_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `tb_user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

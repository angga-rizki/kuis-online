-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2022 at 04:05 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuis_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `gambar`
--

CREATE TABLE `gambar` (
  `id` int(9) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `ukuran_file` double NOT NULL,
  `tipe_file` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gambar`
--

INSERT INTO `gambar` (`id`, `deskripsi`, `nama_file`, `ukuran_file`, `tipe_file`) VALUES
(37, 'logo', 'logo.png', 50.836, 'png'),
(111, 'foto_anggarizki', 'img1-logo.png', 50.836, 'png');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(10) NOT NULL,
  `username` varchar(12) NOT NULL,
  `nama_quis` varchar(50) NOT NULL,
  `level` varchar(10) NOT NULL,
  `tanggal` datetime NOT NULL,
  `hasil` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `username`, `nama_quis`, `level`, `tanggal`, `hasil`) VALUES
(55, 'ibnu', 'Matematika', 'newbie', '2020-07-18 13:37:45', 20),
(56, 'anggarizki', 'IPA', 'advance', '2020-07-18 13:51:48', 100),
(57, 'ibnu', 'IPA', 'newbie', '2020-07-18 13:53:01', 100),
(58, 'ibnu', 'IPA', 'newbie', '2021-07-15 14:32:47', 40);

-- --------------------------------------------------------

--
-- Table structure for table `quis`
--

CREATE TABLE `quis` (
  `kode_quis` varchar(20) NOT NULL,
  `nama_quis` varchar(20) NOT NULL,
  `jumlah_soal` double NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quis`
--

INSERT INTO `quis` (`kode_quis`, `nama_quis`, `jumlah_soal`, `level`) VALUES
('ipa_advance', 'IPA', 5, 'advance'),
('ipa_newbie', 'IPA', 5, 'newbie'),
('mtk_advance', 'Matematika', 5, 'advance'),
('mtk_newbie', 'Matematika', 5, 'newbie');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id` int(10) NOT NULL,
  `kode_quis` varchar(20) NOT NULL,
  `pertanyaan` varchar(255) NOT NULL,
  `jawaban_a` varchar(255) NOT NULL,
  `jawaban_b` varchar(255) NOT NULL,
  `jawaban_c` varchar(255) NOT NULL,
  `jawaban_benar` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id`, `kode_quis`, `pertanyaan`, `jawaban_a`, `jawaban_b`, `jawaban_c`, `jawaban_benar`) VALUES
(4, 'ipa_newbie', 'Ikan bernafas dengan...', 'Insang', 'Paru - paru', 'Hidung', 'a'),
(5, 'ipa_newbie', 'Ciri - ciri makhluk hidup adalah...', 'Diam di tempat', 'Menghadap ke atas', 'Berkembang biak', 'c'),
(6, 'ipa_newbie', 'Berikut ini yang bukan makhluk hidup adalah...', 'Ikan', 'Bunga Mawar', 'Batu kali', 'c'),
(7, 'ipa_newbie', 'Burung dapat bertelur untuk melanjutkan keturunannya, hal itu adalah ciri makhluk hidup yaitu...', 'Bernafas', 'Berkembang biak', 'Tumbuh', 'b'),
(8, 'ipa_newbie', 'Hewan yang dapat hidup di darat dan di air dinamakan hewan...', 'Amfibi', 'Karnivora', 'Herbivora', 'a'),
(10, 'ipa_advance', 'Jantung berfungsi untuk...', 'Membuat butir - butir darah', 'Memompa darah ke seluruh tubuh', 'Tempat menyimpan darah', 'b'),
(11, 'ipa_advance', 'Punuk pada punggung unta berguna untuk...', 'Memperindah bentuk tubuh', 'Mengangkut barang bawaan', 'Menyimpan cadangan makanan dlm bentuk lemak', 'c'),
(12, 'ipa_advance', 'Hewan ini mengeluarkan tinta hitam ketika dikejar musuhnya. Hewan yang dimaksud adalah...', 'Burung hantu', 'Cecak', 'Cumi - cumi', 'c'),
(13, 'ipa_advance', 'Makhluk hidup setiap hari bertambah banyak karena...', 'Berkembang biak', 'Bernafas', 'Hidup dan tumbuh', 'a'),
(14, 'ipa_advance', 'Kemampuan kelelawar dalam ekolokasi karena kelelawar mempunyai ciri khusus berupa...', 'Sistem sonar', 'Gema', 'Gaung', 'a'),
(15, 'mtk_newbie', 'Andi baru saja membeli 5 buku tulis. Setiap buku harga Rp. 3.000,00. Maka Andi bisa membayarnya dengan...', '7 lembar dua ribuan', '13 lembar seribuan', '3 lembar lima ribuan', 'c'),
(16, 'mtk_newbie', 'Uang saku Anita adalah Rp. 10.000,00. Anita membeli 1 bungkus roti dengan harga Rp. 2.500,00. Maka sisa uang Saku Anita adalah…', 'Rp. 8.500,00', 'Rp. 7.500,00', 'Rp. 6.500,00', 'b'),
(17, 'mtk_newbie', 'Siska memiliki uang sebanyak Rp. 40.700,00 dan Rani juga memiliki uang sebesar Rp. 31.500,00. Jumlah uang mereka berdua adalah...', 'Rp. 72.200,00', 'Rp. 72.500,00', 'Rp. 72.100,00', 'a'),
(18, 'mtk_newbie', 'Bentuk panjang dari bilangan 3.756 adalah...', '3000 + 700 + 50 + 6', '3000 + 500 + 70 + 6', '3 + 700 + 6 + 6', 'a'),
(19, 'mtk_newbie', 'Meteran adalah alat untuk mengukur...', 'Berat', 'Volume', 'Panjang', 'c'),
(20, 'mtk_advance', 'Hasil dari 9 x 50 ÷ 30 adalah...', '5', '25', '35', 'a'),
(21, 'mtk_advance', 'Hasil dari 17 ^ 2  - 15 ^ 2  adalah...', '4', '16', '64', 'c'),
(22, 'mtk_advance', 'Hasil dari 70 - (–25) adalah...', '-45', '45', '95', 'c'),
(23, 'mtk_advance', 'FPB dari 48, 72 dan 96 adalah...', '2 ^ 5  x 3', '2 ^ 4  x 3 ', '2 ^ 3  x 3', 'c'),
(24, 'mtk_advance', 'Tiga buah tangki masing-masing berisi minyak tanah 4,25 m3 , 2,500 liter, dan 5,500 dm3 . Jumlah minyak tanah seluruhnya ... liter', '12.250', '11.425', '10.700', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(12) NOT NULL,
  `password` varchar(12) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL,
  `level` varchar(10) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `type`, `level`, `foto`) VALUES
('admin', 'admin', 'Admin', 'admin', 'superadmin', ''),
('anggarizki', '120996', 'Angga Rizki Dwi Septian', 'user', 'advance', 'img1-logo.png'),
('ibnu', 'ibnu', 'Ibnu', 'user', 'newbie', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `quis`
--
ALTER TABLE `quis`
  ADD PRIMARY KEY (`kode_quis`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_quis` (`kode_quis`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `id` (`foto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gambar`
--
ALTER TABLE `gambar`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_ibfk_1` FOREIGN KEY (`kode_quis`) REFERENCES `quis` (`kode_quis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

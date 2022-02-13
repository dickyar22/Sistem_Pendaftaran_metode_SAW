-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2021 at 03:03 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` char(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `jenkel` char(15) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `img_foto` varchar(50) DEFAULT NULL,
  `flag_aktif` smallint(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `name`, `nisn`, `nickname`, `jenkel`, `alamat`, `tempat_lahir`, `tgl_lahir`, `img_foto`, `flag_aktif`, `created`, `modified`) VALUES
('A20210412231400vjY', 'Alif Mawani Putra', '0054208546', 'Alif', 'Laki-laki', 'Jl. Jalan', 'Jakarta', '2010-05-05', '20210419230608_BGUSW.jpg', 1, '2021-04-12 23:14:00', '2021-04-19 23:06:08'),
('A20210412231412UzW', 'Alfin Gustian', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-04-12 23:14:12', '2021-04-12 23:14:12'),
('A202104122314198eP', 'Arief Fitriansyah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-04-12 23:14:19', '2021-04-12 23:14:19'),
('A20210412231426hSt', 'Azalia Zenitania', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-04-12 23:14:26', '2021-04-12 23:14:26'),
('A20210412231432VkM', 'Budi Setiawan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-04-12 23:14:32', '2021-04-12 23:14:32');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` char(20) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `img_berita` varchar(50) DEFAULT NULL,
  `flag_aktif` smallint(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `judul`, `detail`, `img_berita`, `flag_aktif`, `created`, `modified`) VALUES
('B20210419005807Wbc', 'Berita 1', 'Berita 1 bla bla bla', '20210419005807_hy5Wv.jpg', 1, '2021-04-19 00:58:07', '2021-04-19 00:58:07'),
('B20210419005821AZE', 'Berita 2', 'Berita 2 bla bla bla', '20210419005821_2wvJT.jpg', 1, '2021-04-19 00:58:21', '2021-04-19 00:58:21'),
('B20210419165152aCL', 'Berita 3', 'Berita 3 bla bla', '20210419165152_lMPJP.png', 1, '2021-04-19 16:51:52', '2021-04-19 16:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` char(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `img_galeri` varchar(50) DEFAULT NULL,
  `flag_aktif` smallint(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `name`, `img_galeri`, `flag_aktif`, `created`, `modified`) VALUES
('G20210419005727lk4', 'Galeri 1', '20210419005727_hAbYq.jpg', 1, '2021-04-19 00:57:27', '2021-04-19 00:57:27'),
('G20210419005735U9T', 'Galeri 2', '20210419005735_1iNHc.jpg', 1, '2021-04-19 00:57:35', '2021-04-19 00:57:35'),
('G20210419005745xCf', 'Galeri 3', '20210419005745_p4p8X.png', 1, '2021-04-19 00:57:45', '2021-04-19 00:57:45'),
('G20210419162958FGG', 'Galeri 4', '20210419162958_wXWPI.png', 1, '2021-04-19 16:29:58', '2021-04-19 16:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` char(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `golongan` varchar(30) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `pendidikan_terakhir` char(5) DEFAULT NULL,
  `img_guru` varchar(50) DEFAULT NULL,
  `id_mata_pelajaran` char(20) DEFAULT NULL,
  `flag_aktif` smallint(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `name`, `nip`, `golongan`, `jabatan`, `pendidikan_terakhir`, `img_guru`, `id_mata_pelajaran`, `flag_aktif`, `created`, `modified`) VALUES
('G20210418234632FBf', 'Rahmat Antoni', '199003182012015', '3A', 'Guru', 'S2', '20210419031133_9I2VL.jpg', 'MP20210418234408gjl', 1, '2021-04-18 23:46:32', '2021-04-19 17:09:59'),
('G2021041823475751W', 'Dimas Aryo Setya', '198211012005008', '3B', 'Guru', 'S1', '20210419031141_au4Xu.jpg', 'MP2021041823442728e', 1, '2021-04-18 23:47:57', '2021-04-19 17:10:14'),
('G20210418234816kSU', 'Riska Maimunah', '196707211990009', '4C', 'Guru', 'S1', '20210419031149_yHLso.jpg', 'MP20210418234439IvG', 1, '2021-04-18 23:48:16', '2021-04-19 17:09:15'),
('G20210418234832YlK', 'Kirena Alhamin', '197307011996018', '3B', 'Guru', 'S1', '20210419031159_d5VVN.jpg', 'MP20210418234445KzY', 1, '2021-04-18 23:48:32', '2021-04-19 17:09:41'),
('G20210418234846HtI', 'David Nuranto', '198208282005010', '3A', 'Guru', 'S1', '20210419031209_UyT9h.jpg', 'MP202104182344509dM', 1, '2021-04-18 23:48:46', '2021-04-19 17:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` char(20) NOT NULL,
  `id_alternatif` char(20) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `tahun` char(4) DEFAULT NULL,
  `flag_aktif` smallint(1) DEFAULT 0,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_alternatif`, `nilai`, `tahun`, `flag_aktif`, `created`) VALUES
('H20210418004858ETe', 'A202104122314198eP', 8, '2021', 1, '2021-04-18 00:48:58'),
('H20210418004858nCi', 'A20210412231400vjY', 6.25, '2021', 0, '2021-04-18 00:48:58'),
('H20210418004858skz', 'A20210412231432VkM', 4.75, '2021', 0, '2021-04-18 00:48:58'),
('H20210418004858W6I', 'A20210412231412UzW', 6.25, '2021', 0, '2021-04-18 00:48:58'),
('H20210418004858wNT', 'A20210412231426hSt', 5.5, '2021', 0, '2021-04-18 00:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` char(3) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `jenis` enum('Cost','Benefit') DEFAULT NULL,
  `bobot` float DEFAULT NULL,
  `flag_aktif` smallint(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `name`, `jenis`, `bobot`, `flag_aktif`, `created`, `modified`) VALUES
('K01', 'Nilai UN', 'Benefit', 50, 1, '2021-04-12 22:32:21', '2021-04-12 22:32:21'),
('K02', 'Jarak Rumah ke Sekolah', 'Benefit', 50, 1, '2021-04-12 22:32:35', '2021-04-12 22:32:35');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id_mata_pelajaran` char(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `detail` varchar(200) DEFAULT NULL,
  `flag_aktif` smallint(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_mata_pelajaran`, `name`, `detail`, `flag_aktif`, `created`, `modified`) VALUES
('MP20210418234408gjl', 'Bahasa Indonesia', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis debitis explicabo nulla ullam aperiam iusto expedita vitae officia totam sed voluptas, mollitia officiis corrupti? Ipsam corrupti au', 1, '2021-04-18 23:44:08', '2021-04-18 23:44:08'),
('MP2021041823442728e', 'Matematika', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis debitis explicabo nulla ullam aperiam iusto expedita vitae officia totam sed voluptas, mollitia officiis corrupti? Ipsam corrupti au', 1, '2021-04-18 23:44:27', '2021-04-18 23:44:27'),
('MP20210418234439IvG', 'Fisika', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis debitis explicabo nulla ullam aperiam iusto expedita vitae officia totam sed voluptas, mollitia officiis corrupti? Ipsam corrupti au', 1, '2021-04-18 23:44:39', '2021-04-18 23:44:39'),
('MP20210418234445KzY', 'Kimia', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis debitis explicabo nulla ullam aperiam iusto expedita vitae officia totam sed voluptas, mollitia officiis corrupti? Ipsam corrupti au', 1, '2021-04-18 23:44:45', '2021-04-18 23:44:45'),
('MP202104182344509dM', 'Biologi', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis debitis explicabo nulla ullam aperiam iusto expedita vitae officia totam sed voluptas, mollitia officiis corrupti? Ipsam corrupti au', 1, '2021-04-18 23:44:50', '2021-04-18 23:44:50');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` smallint(3) NOT NULL,
  `name` char(20) DEFAULT NULL,
  `flag_aktif` smallint(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `name`, `flag_aktif`, `created`, `modified`) VALUES
(1, 'Register', 1, '2021-07-25 19:38:35', '2021-07-25 19:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` char(20) NOT NULL,
  `id_alternatif` char(20) DEFAULT NULL,
  `id_kriteria` char(20) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `tahun` char(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_alternatif`, `id_kriteria`, `nilai`, `tahun`, `created`) VALUES
('P20210413233100hjO', 'A20210412231400vjY', 'K02', 5, '2021', '2021-04-13 23:31:00'),
('P20210413233100RjC', 'A20210412231400vjY', 'K01', 1, '2021', '2021-04-13 23:31:00'),
('P20210413234135KiQ', 'A20210412231412UzW', 'K01', 1, '2021', '2021-04-13 23:41:35'),
('P20210413234135WNc', 'A20210412231412UzW', 'K02', 5, '2021', '2021-04-13 23:41:35'),
('P202104132343073dG', 'A202104122314198eP', 'K01', 4, '2021', '2021-04-13 23:43:07'),
('P20210413234307syu', 'A202104122314198eP', 'K02', 3, '2021', '2021-04-13 23:43:07'),
('P202104132343356yR', 'A20210412231426hSt', 'K01', 2, '2021', '2021-04-13 23:43:35'),
('P20210413234335wia', 'A20210412231426hSt', 'K02', 3, '2021', '2021-04-13 23:43:35'),
('P20210413234403fXn', 'A20210412231432VkM', 'K01', 3, '2021', '2021-04-13 23:44:03'),
('P20210413234403lwr', 'A20210412231432VkM', 'K02', 1, '2021', '2021-04-13 23:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id_slide` char(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `detail` varchar(250) DEFAULT NULL,
  `img_slide` varchar(30) DEFAULT NULL,
  `flag_aktif` smallint(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id_slide`, `name`, `detail`, `img_slide`, `flag_aktif`, `created`, `modified`) VALUES
('S20210223003553Uma', 'Welcome to School', 'Learning and teaching online easier for everyone.', '20210419174820_5yW3v.jpg', 1, '2021-02-23 00:35:53', '2021-04-19 17:48:20'),
('S20210419174922AZd', 'Welcome to School', 'Learning and teaching online easier for everyone.', '20210419174922_GUGBP.jpg', 1, '2021-04-19 17:49:22', '2021-04-19 17:49:31');

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` char(4) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `nilai` int(2) DEFAULT NULL,
  `id_kriteria` char(3) DEFAULT NULL,
  `flag_aktif` smallint(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `name`, `nilai`, `id_kriteria`, `flag_aktif`, `created`, `modified`) VALUES
('SK01', '0-50', 1, 'K01', 1, '2021-04-12 22:48:58', '2021-04-19 23:10:00'),
('SK02', '51-60', 2, 'K01', 1, '2021-04-12 22:49:11', '2021-04-19 23:10:11'),
('SK03', '61-70', 3, 'K01', 1, '2021-04-12 22:53:06', '2021-04-19 23:10:21'),
('SK04', '71-80', 4, 'K01', 1, '2021-04-12 22:53:24', '2021-04-19 23:10:43'),
('SK05', '81-100', 5, 'K01', 1, '2021-04-12 22:53:36', '2021-04-19 23:10:51'),
('SK06', '>5 KM', 1, 'K02', 1, '2021-04-12 22:54:04', '2021-04-19 23:12:22'),
('SK07', '3-5 KM', 3, 'K02', 1, '2021-04-12 22:55:44', '2021-04-19 23:12:14'),
('SK08', '0-2 KM', 5, 'K02', 1, '2021-04-12 22:55:57', '2021-04-19 23:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` char(20) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_user_level` smallint(3) DEFAULT NULL,
  `id_user_table` char(20) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `flag_aktif` smallint(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `id_user_level`, `id_user_table`, `fullname`, `flag_aktif`, `created`, `modified`) VALUES
('U20200413155850hor', 'admin', '$2y$12$adoM2geXUi2lv5KcuFn7rea04.mP8Bi70cjrqNwDyKNSf8VgX6kOy', 1, 'Administrator', 'Administrator', 1, '2020-04-13 15:58:50', '2020-05-16 15:04:10'),
('U20210416235445WXB', 'alif', '$2y$12$vMb5iCxYoGwa/zt0OySG2uXELUzlIPbKCGgE2T6/DUjMufd5MdBgS', 2, 'A20210412231400vjY', 'Alif Mawani Putra', 1, '2021-04-16 23:54:46', '2021-04-16 23:54:46'),
('U20210417010352vxZ', 'alfin', '$2y$12$vMb5iCxYoGwa/zt0OySG2uXELUzlIPbKCGgE2T6/DUjMufd5MdBgS', 2, 'A20210412231412UzW', 'Alfin Gustian', 1, '2021-04-17 01:03:52', '2021-04-17 01:03:52'),
('U20210417010444sSP', 'arief', '$2y$12$CGnlynxyBEDz6Kgoey1UvOFspdo44pD6drOMcP6IXk3jvJsM2uEG6', 2, 'A202104122314198eP', 'Arief Fitriansyah', 1, '2021-04-17 01:04:44', '2021-04-17 01:04:44'),
('U202104170105144xT', 'azalia', '$2y$12$GHPglJMdtUGh0MGQOIxuOe.Kmg7fzOFGhwAHb6jocw/Y..R/kiLei', 2, 'A20210412231426hSt', 'Azalia Zenitania', 1, '2021-04-17 01:05:14', '2021-04-17 01:05:14'),
('U20210417010544FZW', 'budi', '$2y$12$tXPWz807oxmb4aClZrONBuT/eYAKPOWGazAXw4uIkzhAnRnRDwxaC', 2, 'A20210412231432VkM', 'Budi Setiawan', 1, '2021-04-17 01:05:44', '2021-04-17 01:05:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id` smallint(3) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Calon Siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id_mata_pelajaran`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id_slide`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

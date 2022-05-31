-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2022 at 12:59 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diemrenluyen`
--

-- --------------------------------------------------------

--
-- Table structure for table `chamdiemrenluyen`
--

CREATE TABLE `chamdiemrenluyen` (
  `maChamDiemRenLuyen` int(11) NOT NULL,
  `maPhieuRenLuyen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maTieuChi3` int(11) DEFAULT NULL,
  `maTieuChi2` int(11) DEFAULT NULL,
  `maSinhVien` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diemSinhVienDanhGia` int(11) DEFAULT NULL,
  `diemLopDanhGia` int(11) DEFAULT NULL,
  `ghiChu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chamdiemrenluyen`
--

INSERT INTO `chamdiemrenluyen` (`maChamDiemRenLuyen`, `maPhieuRenLuyen`, `maTieuChi3`, `maTieuChi2`, `maSinhVien`, `diemSinhVienDanhGia`, `diemLopDanhGia`, `ghiChu`) VALUES
(484, 'PRLHK221223118410018', 1, 0, '3118410018', 0, 0, ''),
(485, 'PRLHK221223118410018', 2, 0, '3118410018', 12, 12, ''),
(486, 'PRLHK221223118410018', 3, 0, '3118410018', 0, 0, ''),
(487, 'PRLHK221223118410018', 4, 0, '3118410018', 0, 0, ''),
(488, 'PRLHK221223118410018', 5, 0, '3118410018', 0, 0, ''),
(489, 'PRLHK221223118410018', 6, 0, '3118410018', 0, 0, ''),
(490, 'PRLHK221223118410018', 7, 0, '3118410018', 0, 0, ''),
(491, 'PRLHK221223118410018', 8, 0, '3118410018', 0, 0, ''),
(492, 'PRLHK221223118410018', 9, 0, '3118410018', 0, 0, ''),
(493, 'PRLHK221223118410018', 10, 0, '3118410018', 0, 0, ''),
(494, 'PRLHK221223118410018', 11, 0, '3118410018', 0, 0, ''),
(495, 'PRLHK221223118410018', 12, 0, '3118410018', 0, 0, ''),
(496, 'PRLHK221223118410018', 13, 0, '3118410018', 0, 0, ''),
(497, 'PRLHK221223118410018', 14, 0, '3118410018', 0, 0, ''),
(498, 'PRLHK221223118410018', 15, 0, '3118410018', 0, 0, ''),
(499, 'PRLHK221223118410018', 16, 0, '3118410018', 0, 0, ''),
(500, 'PRLHK221223118410018', 17, 0, '3118410018', 0, 0, ''),
(501, 'PRLHK221223118410018', 18, 0, '3118410018', 0, 0, ''),
(502, 'PRLHK221223118410018', 19, 0, '3118410018', 0, 0, ''),
(503, 'PRLHK221223118410018', 20, 0, '3118410018', 0, 0, ''),
(504, 'PRLHK221223118410018', 21, 0, '3118410018', 0, 0, ''),
(505, 'PRLHK221223118410018', 0, 7, '3118410018', 15, 15, ''),
(506, 'PRLHK221223118410018', 0, 8, '3118410018', 10, 10, ''),
(507, 'PRLHK221223118410018', 0, 9, '3118410018', 0, 0, ''),
(508, 'PRLHK221223118410018', 0, 10, '3118410018', 0, 0, ''),
(509, 'PRLHK221223118410018', 22, 0, '3118410018', 10, 10, ''),
(510, 'PRLHK221223118410018', 23, 0, '3118410018', 0, 0, ''),
(511, 'PRLHK221223118410018', 0, 12, '3118410018', 5, 5, ''),
(512, 'PRLHK221223118410018', 24, 0, '3118410018', 0, 0, ''),
(513, 'PRLHK221223118410018', 25, 0, '3118410018', 0, 0, ''),
(514, 'PRLHK221223118410018', 26, 0, '3118410018', 0, 0, ''),
(515, 'PRLHK221223118410018', 0, 14, '3118410018', 10, 10, ''),
(516, 'PRLHK221223118410018', 0, 15, '3118410018', 0, 0, ''),
(517, 'PRLHK221223118410018', 0, 16, '3118410018', 0, 0, ''),
(518, 'PRLHK221223118410018', 0, 17, '3118410018', 0, 0, ''),
(519, 'PRLHK221223118410018', 0, 18, '3118410018', 0, 0, ''),
(520, 'PRLHK221223118410018', 0, 19, '3118410018', 0, 0, ''),
(521, 'PRLHK221223118410018', 0, 20, '3118410018', 0, 0, ''),
(522, 'PRLHK221223118410018', 0, 21, '3118410018', 0, 0, ''),
(523, 'PRLHK221223118410018', 0, 22, '3118410018', 0, 0, ''),
(524, 'PRLHK221223118410018', 0, 23, '3118410018', 0, 0, ''),
(525, 'PRLHK221223118410018', 0, 24, '3118410018', 0, 0, ''),
(526, 'PRLHK221223118410018', 0, 25, '3118410018', 0, 0, ''),
(527, 'PRLHK221223118410018', 0, 26, '3118410018', 0, 0, ''),
(528, 'PRLHK221223118410018', 0, 27, '3118410018', 3, 3, ''),
(529, 'PRLHK221223118410018', 27, 0, '3118410018', 0, 0, ''),
(530, 'PRLHK221223118410018', 28, 0, '3118410018', 0, 0, ''),
(531, 'PRLHK221223118410018', 0, 29, '3118410018', 0, 0, ''),
(532, 'PRLHK221223118410018', 0, 30, '3118410018', 0, 15, ''),
(533, 'PRLHK221223118410262', 1, 0, '3118410262', 0, 0, ''),
(534, 'PRLHK221223118410262', 2, 0, '3118410262', 12, 12, ''),
(535, 'PRLHK221223118410262', 3, 0, '3118410262', 0, 0, ''),
(536, 'PRLHK221223118410262', 4, 0, '3118410262', 0, 0, ''),
(537, 'PRLHK221223118410262', 5, 0, '3118410262', 0, 0, ''),
(538, 'PRLHK221223118410262', 6, 0, '3118410262', 0, 0, ''),
(539, 'PRLHK221223118410262', 7, 0, '3118410262', 0, 0, ''),
(540, 'PRLHK221223118410262', 8, 0, '3118410262', 0, 0, ''),
(541, 'PRLHK221223118410262', 9, 0, '3118410262', 0, 0, ''),
(542, 'PRLHK221223118410262', 10, 0, '3118410262', 0, 0, ''),
(543, 'PRLHK221223118410262', 11, 0, '3118410262', 0, 0, ''),
(544, 'PRLHK221223118410262', 12, 0, '3118410262', 0, 0, ''),
(545, 'PRLHK221223118410262', 13, 0, '3118410262', 0, 0, ''),
(546, 'PRLHK221223118410262', 14, 0, '3118410262', 0, 0, ''),
(547, 'PRLHK221223118410262', 15, 0, '3118410262', 0, 0, ''),
(548, 'PRLHK221223118410262', 16, 0, '3118410262', 0, 0, ''),
(549, 'PRLHK221223118410262', 17, 0, '3118410262', 0, 0, ''),
(550, 'PRLHK221223118410262', 18, 0, '3118410262', 2, 2, ''),
(551, 'PRLHK221223118410262', 19, 0, '3118410262', 0, 0, ''),
(552, 'PRLHK221223118410262', 20, 0, '3118410262', 0, 0, ''),
(553, 'PRLHK221223118410262', 21, 0, '3118410262', 0, 0, ''),
(554, 'PRLHK221223118410262', 0, 7, '3118410262', 15, 15, ''),
(555, 'PRLHK221223118410262', 0, 8, '3118410262', 10, 10, ''),
(556, 'PRLHK221223118410262', 0, 9, '3118410262', 0, 0, ''),
(557, 'PRLHK221223118410262', 0, 10, '3118410262', 0, 0, ''),
(558, 'PRLHK221223118410262', 22, 0, '3118410262', 10, 10, ''),
(559, 'PRLHK221223118410262', 23, 0, '3118410262', 0, 0, ''),
(560, 'PRLHK221223118410262', 0, 12, '3118410262', 5, 5, ''),
(561, 'PRLHK221223118410262', 24, 0, '3118410262', 0, 0, ''),
(562, 'PRLHK221223118410262', 25, 0, '3118410262', 0, 0, ''),
(563, 'PRLHK221223118410262', 26, 0, '3118410262', 0, 0, ''),
(564, 'PRLHK221223118410262', 0, 14, '3118410262', 10, 10, ''),
(565, 'PRLHK221223118410262', 0, 15, '3118410262', 0, 0, ''),
(566, 'PRLHK221223118410262', 0, 16, '3118410262', 0, 0, ''),
(567, 'PRLHK221223118410262', 0, 17, '3118410262', 0, 0, ''),
(568, 'PRLHK221223118410262', 0, 18, '3118410262', 5, 5, ''),
(569, 'PRLHK221223118410262', 0, 19, '3118410262', 0, 0, ''),
(570, 'PRLHK221223118410262', 0, 20, '3118410262', 0, 0, ''),
(571, 'PRLHK221223118410262', 0, 21, '3118410262', 0, 0, ''),
(572, 'PRLHK221223118410262', 0, 22, '3118410262', 0, 0, ''),
(573, 'PRLHK221223118410262', 0, 23, '3118410262', 0, 0, ''),
(574, 'PRLHK221223118410262', 0, 24, '3118410262', 0, 0, ''),
(575, 'PRLHK221223118410262', 0, 25, '3118410262', 0, 0, ''),
(576, 'PRLHK221223118410262', 0, 26, '3118410262', 0, 0, ''),
(577, 'PRLHK221223118410262', 0, 27, '3118410262', 3, 3, ''),
(578, 'PRLHK221223118410262', 27, 0, '3118410262', 0, 0, ''),
(579, 'PRLHK221223118410262', 28, 0, '3118410262', 0, 0, ''),
(580, 'PRLHK221223118410262', 0, 29, '3118410262', 0, 0, ''),
(581, 'PRLHK221223118410262', 0, 30, '3118410262', 5, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `covanhoctap`
--

CREATE TABLE `covanhoctap` (
  `maCoVanHocTap` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `hoTenCoVan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `soDienThoai` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `matKhauTaiKhoanCoVan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quyen` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'cvht'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `covanhoctap`
--

INSERT INTO `covanhoctap` (`maCoVanHocTap`, `hoTenCoVan`, `soDienThoai`, `matKhauTaiKhoanCoVan`, `quyen`) VALUES
('11364', 'Lương Minh Huấn', '0559349434', 'e96c7de8f6390b1e6c71556e4e0a4959', 'cvht');

-- --------------------------------------------------------

--
-- Table structure for table `hoatdongdanhgia`
--

CREATE TABLE `hoatdongdanhgia` (
  `maHoatDong` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `maTieuChi2` int(11) NOT NULL,
  `maTieuChi3` int(11) NOT NULL,
  `maKhoa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tenHoatDong` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diemNhanDuoc` int(11) NOT NULL,
  `diaDiemDienRaHoatDong` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maQRDiaDiem` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thoiGianBatDauHoatDong` datetime NOT NULL,
  `thoiGianKetThucHoatDong` datetime NOT NULL,
  `maHocKyDanhGia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thoiGianBatDauDiemDanh` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hoatdongdanhgia`
--

INSERT INTO `hoatdongdanhgia` (`maHoatDong`, `maTieuChi2`, `maTieuChi3`, `maKhoa`, `tenHoatDong`, `diemNhanDuoc`, `diaDiemDienRaHoatDong`, `maQRDiaDiem`, `thoiGianBatDauHoatDong`, `thoiGianKetThucHoatDong`, `maHocKyDanhGia`, `thoiGianBatDauDiemDanh`) VALUES
('HD7', 16, 0, 'DCT', 'Hoạt động 23', 3, 'SGU', '62940ede5bd82.png', '2022-05-30 07:24:00', '2022-05-31 07:24:00', 'HK12122', '2022-05-30 18:26:21'),
('HD8', 16, 0, 'DCT', 'Hoạt động chủ nhật xanh', 5, 'SGU', '62946bafd3720.png', '2022-05-30 14:00:00', '2022-05-31 14:01:00', 'HK22122', '2022-05-30 18:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `hockydanhgia`
--

CREATE TABLE `hockydanhgia` (
  `maHocKyDanhGia` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `hocKyXet` int(11) NOT NULL,
  `namHocXet` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hockydanhgia`
--

INSERT INTO `hockydanhgia` (`maHocKyDanhGia`, `hocKyXet`, `namHocXet`) VALUES
('HK12122', 1, '2021-2022'),
('HK22122', 2, '2021-2022');

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE `khoa` (
  `maKhoa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tenKhoa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `taiKhoanKhoa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `matKhauKhoa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quyen` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'khoa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khoa`
--

INSERT INTO `khoa` (`maKhoa`, `tenKhoa`, `taiKhoanKhoa`, `matKhauKhoa`, `quyen`) VALUES
('DCT', 'Công nghệ thông tin', 'cntt', '8e347e789002556f4b6043bbd2c0862f', 'khoa');

-- --------------------------------------------------------

--
-- Table structure for table `khoahoc`
--

CREATE TABLE `khoahoc` (
  `maKhoaHoc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `namBatDau` year(4) NOT NULL,
  `namKetThuc` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khoahoc`
--

INSERT INTO `khoahoc` (`maKhoaHoc`, `namBatDau`, `namKetThuc`) VALUES
('K18', 2018, 2022);

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

CREATE TABLE `lop` (
  `maLop` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tenLop` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maKhoa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maCoVanHocTap` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maKhoaHoc` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`maLop`, `tenLop`, `maKhoa`, `maCoVanHocTap`, `maKhoaHoc`) VALUES
('DCT1184', 'CNTT K18 lớp 4', 'DCT', '11364', 'K18'),
('DCT1186', 'CNTT lớp 6', 'DCT', '11363', 'K18'),
('DCT1188', 'CNTT lớp 8', 'DCT', '11364', 'K18'),
('DCT1189', 'Công nghệ thông tin lớp 9', 'DCT', '11364', 'K18');

-- --------------------------------------------------------

--
-- Table structure for table `phieurenluyen`
--

CREATE TABLE `phieurenluyen` (
  `maPhieuRenLuyen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `xepLoai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemTongCong` int(11) DEFAULT NULL,
  `maSinhVien` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diemTrungBinhChungHKTruoc` double NOT NULL,
  `diemTrungBinhChungHKXet` double NOT NULL,
  `maHocKyDanhGia` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `coVanDuyet` tinyint(1) DEFAULT NULL,
  `khoaDuyet` tinyint(1) DEFAULT NULL,
  `fileDinhKem` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phieurenluyen`
--

INSERT INTO `phieurenluyen` (`maPhieuRenLuyen`, `xepLoai`, `diemTongCong`, `maSinhVien`, `diemTrungBinhChungHKTruoc`, `diemTrungBinhChungHKXet`, `maHocKyDanhGia`, `coVanDuyet`, `khoaDuyet`, `fileDinhKem`) VALUES
('PRLHK221223118410018', 'Tốt', 80, '3118410018', 3.5, 3.42, 'HK22122', 1, 0, 'New WinRAR archive.rar'),
('PRLHK221223118410262', 'Khá', 75, '3118410262', 3.5, 3.42, 'HK22122', 1, 0, 'New WinRAR archive.rar');

-- --------------------------------------------------------

--
-- Table structure for table `phongcongtacsinhvien`
--

CREATE TABLE `phongcongtacsinhvien` (
  `taiKhoan` varchar(255) NOT NULL,
  `matKhau` varchar(255) NOT NULL,
  `hoTenNhanVien` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sodienthoai` varchar(255) NOT NULL,
  `diaChi` varchar(255) NOT NULL,
  `quyen` varchar(255) NOT NULL DEFAULT 'ctsv'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phongcongtacsinhvien`
--

INSERT INTO `phongcongtacsinhvien` (`taiKhoan`, `matKhau`, `hoTenNhanVien`, `email`, `sodienthoai`, `diaChi`, `quyen`) VALUES
('ctsv1', '0bf27758133599500db277a95366941b', 'Nhân viên CTSV 1', 'ctsv1@edu.vn', '0562346234', '87 Nguyễn Văn Cừ, TP HCM', 'ctsv');

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `maSinhVien` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `hoTenSinhVien` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngaySinh` date NOT NULL,
  `he` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `matKhauSinhVien` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maLop` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quyen` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'sinhvien'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`maSinhVien`, `hoTenSinhVien`, `ngaySinh`, `he`, `matKhauSinhVien`, `maLop`, `quyen`) VALUES
('3118410018', 'LÊ NGÔ THIÊN ẤN', '2000-12-16', 'Đại học', '041f7b834b36b8d4f10e5a62b978550e', 'DCT1189', 'sinhvien'),
('3118410030', 'BÙI HỮU BẰNG', '2000-04-07', 'Đại học', '1e0b1e37e1e1705428d0f3d22c81685d', 'DCT1189', 'sinhvien'),
('3118410046', 'TRẦN THANH CỦA', '2000-10-13', 'Đại học', 'e10adc3949ba59abbe56e057f20f883e', 'DCT1189', 'sinhvien'),
('3118410059', 'NGUYỄN PHƯỚC DUY', '2000-11-13', 'Đại học', 'd78c4e1abc3480c8899313aa648f9e03', 'DCT1189', 'sinhvien'),
('3118410262', 'NGUYỄN THƯƠNG MẾN', '2000-06-01', 'Đại học', 'b75617aed87d1a170dd25d22547f888d', 'DCT1189', 'sinhvien');

-- --------------------------------------------------------

--
-- Table structure for table `thamgiahoatdong`
--

CREATE TABLE `thamgiahoatdong` (
  `maThamGiaHoatDong` int(11) NOT NULL,
  `maHoatDong` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `maSinhVienThamGia` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `thamgiahoatdong`
--

INSERT INTO `thamgiahoatdong` (`maThamGiaHoatDong`, `maHoatDong`, `maSinhVienThamGia`) VALUES
(4, 'HD9', '3118410018'),
(5, 'HD9', '3118410262');

-- --------------------------------------------------------

--
-- Table structure for table `thongbaodanhgia`
--

CREATE TABLE `thongbaodanhgia` (
  `maThongBao` int(11) NOT NULL,
  `ngaySinhVienDanhGia` date NOT NULL,
  `ngaySinhVienKetThucDanhGia` date NOT NULL,
  `ngayCoVanDanhGia` date NOT NULL,
  `ngayCoVanKetThucDanhGia` date NOT NULL,
  `ngayKhoaDanhGia` date NOT NULL,
  `ngayKhoaKetThucDanhGia` date NOT NULL,
  `ngayThongBao` date NOT NULL,
  `maHocKyDanhGia` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `taiKhoanCTSV` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `thongbaodanhgia`
--

INSERT INTO `thongbaodanhgia` (`maThongBao`, `ngaySinhVienDanhGia`, `ngaySinhVienKetThucDanhGia`, `ngayCoVanDanhGia`, `ngayCoVanKetThucDanhGia`, `ngayKhoaDanhGia`, `ngayKhoaKetThucDanhGia`, `ngayThongBao`, `maHocKyDanhGia`, `taiKhoanCTSV`) VALUES
(1, '2021-12-14', '2022-01-14', '2022-01-15', '2022-02-16', '2022-02-17', '2022-02-24', '2022-02-13', 'HK12122', NULL),
(2, '2022-05-20', '2022-05-31', '2022-05-18', '2022-06-15', '2022-05-16', '2022-06-30', '2022-05-20', 'HK22122', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tieuchicap1`
--

CREATE TABLE `tieuchicap1` (
  `matc1` int(11) NOT NULL,
  `noidung` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diemtoida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tieuchicap1`
--

INSERT INTO `tieuchicap1` (`matc1`, `noidung`, `diemtoida`) VALUES
(1, 'I - Đánh giá về ý thức và kết quả học tập (tối đa 20 điểm).', 20),
(2, 'II - Đánh giá về ý thức và kết quả chấp hành quy chế, nội quy, quy định trong nhà trường (tối đa 25 điểm).', 25),
(3, 'III - Đánh giá về ý thức và kết quả tham gia các hoạt động chính trị - xã hội, văn hóa, văn nghệ, thể thao, phòng chống các tệ nạn xã hội (tối đa 20 điểm).', 20),
(4, 'IV – Đánh giá ý thức công dân trong quan hệ cộng đồng (tối đa 25 điểm).', 25),
(5, 'V - Đánh giá về ý thức và kết quả tham gia phụ trách lớp, các đoàn thể trong nhà trường (tối đa 10 điểm).', 10),
(6, 'VI. Hoạt động khác', 30);

-- --------------------------------------------------------

--
-- Table structure for table `tieuchicap2`
--

CREATE TABLE `tieuchicap2` (
  `matc2` int(11) NOT NULL,
  `noidung` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diemtoida` int(11) NOT NULL,
  `matc1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tieuchicap2`
--

INSERT INTO `tieuchicap2` (`matc2`, `noidung`, `diemtoida`, `matc1`) VALUES
(1, '1.Kết quả học tập: ', 0, 1),
(2, '2.Tinh thần vượt khó trong học tập:', 0, 1),
(3, '3.Tham gia nghiên cứu khoa học (NCKH):', 0, 1),
(4, '4.Tham gia rèn luyện nghiệp vụ (RLNV):', 0, 1),
(5, '5. Tham gia các câu lạc bộ học thuật', 0, 1),
(6, '6. Thành viên đội tuyển dự thi Olympic các môn học:', 0, 1),
(7, '1. Chấp hành tốt nội quy, quy chế của nhà trường', 15, 2),
(8, '2. Tham gia đầy đủ các buổi họp của trường, khoa, CVHT, lớp tổ chức', 10, 2),
(9, '3. Một lần vi phạm quy chế, quy định của trường (có biên bản xử lý)', -10, 2),
(10, '4. Vắng 01 buổi họp do trường, khoa, CVHT, lớp tổ chức không lý do', -5, 2),
(11, '1. Tham gia các hoạt động chính trị – xã hội do nhà trường quy định:', 0, 3),
(12, '2. Tham gia hoạt động văn hóa, văn nghệ, TDTT, phòng chống TNXH…', 5, 3),
(13, '3. Tham gia trong đội tuyển văn nghệ, TDTT :', 0, 3),
(14, '1. Chấp hành tốt các chủ trương, chính sách, pháp luật của nhà nước:', 10, 4),
(15, '2. Được biểu dương người tốt, việc tốt ở nhà trường hoặc ở địa phương (có giấy chứng nhận)', 5, 4),
(16, '3. Tham gia các hoạt động tình nguyện trung hạn: MHX, Tiếp sức mùa thi', 10, 4),
(17, '4. Tham gia các công tác xã hội và các hoạt động tình nguyện ngắn ngày (có xác nhận của đơn vị tổ chức)', 10, 4),
(18, '5. Có tinh thần chia sẻ, giúp đỡ người có khó khăn, hoạn nạn', 5, 4),
(19, '6. Tham gia hiến máu tình nguyện', 5, 4),
(20, '7. Tham gia hội thao GDQP –AN cấp quận, cấp TP', 5, 4),
(21, '8. Vi phạm ATGT, trật tự công cộng (có giấy báo gửi về trường)', -10, 4),
(22, '1. Lớp trưởng, BCH Đoàn trường, BCH Hội sinh viên trường', 10, 5),
(23, '2. Lớp phó, BCH Đoàn khoa, BCH LCH SV; BCH CĐ, BCH chi hội lớp', 8, 5),
(24, '3. Tổ trưởng, tổ phó', 3, 5),
(25, '4. Đảng viên', 8, 5),
(26, '5. Đối tượng Đảng', 5, 5),
(27, '6. Đoàn viên TNCS Hồ Chí Minh', 3, 5),
(28, '7. Được Đoàn thanh niên, Hội sinh viên biểu dương, khen thưởng', 0, 5),
(29, '*Tham gia các họat động đặc biệt do nhà trường huy động', 15, 6),
(30, '*Đạt giải thưởng trong các kì thi cấp tỉnh thành trở lên', 15, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tieuchicap3`
--

CREATE TABLE `tieuchicap3` (
  `matc3` int(11) NOT NULL,
  `noidung` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diem` int(11) NOT NULL,
  `matc2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tieuchicap3`
--

INSERT INTO `tieuchicap3` (`matc3`, `noidung`, `diem`, `matc2`) VALUES
(1, 'a. Điểm trung bình chung học kì từ  3,60 đến 4,00', 14, 1),
(2, 'b. Điểm trung bình chung học kì từ  3,20 đến 3,59', 12, 1),
(3, 'c. Điểm trung bình chung học kì từ  2,50 đến 3,19', 10, 1),
(4, 'd. Điểm trung bình chung học kì từ  2,00 đến 2,49', 2, 1),
(5, 'đ. Điểm trung bình chung học kì  dưới 2,00', 0, 1),
(6, 'a. Kết quả học tập tăng một bậc so với học kỳ trước,  ĐTBCHK từ  2,00 trở lên', 3, 2),
(7, 'b. Kết quả học tập tăng hai bậc so với học kỳ trước,  ĐTBCHK từ  2,00 trở lên', 6, 2),
(8, 'c. Sinh viên năm thứ I, nếu có kết quả học tập HK I từ 2,00 trở lên', 3, 2),
(9, 'a. Khóa luận tốt nghiệp từ loại giỏi trở lên', 6, 3),
(10, 'b. Đề tài NCKH cấp trường từ loại giỏi trở lên', 6, 3),
(11, 'c. Đề tài NCKH cấp trường từ loại đạt trở lên', 5, 3),
(12, 'a. Tham gia hội thi RLNV cấp khoa', 2, 4),
(13, 'b. Tham gia hội thi  RLNV cấp trường', 4, 4),
(14, 'c. Tham gia hội thi  RLNV toàn quốc', 4, 4),
(15, 'd. Tham gia đầy đủ các buổi hội thảo khoa học, báo cáo chuyên đề', 2, 4),
(16, 'a. Ban chủ nhiệm câu lạc bộ cấp khoa', 4, 5),
(17, 'b. Ban chủ nhiệm câu lạc bộ cấp trường', 6, 5),
(18, 'c. Thành viên tham gia thường xuyên các câu lạc bộ học thuật', 2, 5),
(19, 'a. Cấp khoa', 4, 6),
(20, 'b. Cấp trường', 6, 6),
(21, 'c. Cấp toàn quốc', 10, 6),
(22, 'a. Tham gia đầy đủ các buổi sinh hoạt chính trị xã hội theo quy định', 10, 11),
(23, 'b. Vắng mặt 01 buổi không lý do', -5, 11),
(24, 'a. Cấp khoa', 5, 13),
(25, 'b. Cấp trường', 10, 13),
(26, 'c. Được khen thưởng cấp toàn quốc', 15, 13),
(27, 'a. Cấp khoa', 5, 28),
(28, 'b. Cấp trường, cấp thành phố', 10, 28);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `stt` int(11) NOT NULL,
  `maSo` varchar(11) NOT NULL,
  `token` text NOT NULL,
  `quyen` varchar(255) NOT NULL,
  `thoiGianDangNhap` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `thoiGianHetHan` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`stt`, `maSo`, `token`, `quyen`, `thoiGianDangNhap`, `thoiGianHetHan`) VALUES
(254, '3118410046', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTM0MTA4NzgsIm5iZiI6MTY1MzQxMDg4OCwiZXhwIjoxNjUzNDk3Mjc4LCJhdWQiOiJzaW5odmllbiIsInNpbmh2aWVuIjp7Im1hU2luaFZpZW4iOiIzMTE4NDEwMDQ2IiwiaG9UZW5TaW5oVmllbiI6IlRSXHUxZWE2TiBUSEFOSCBDXHUxZWU2QSIsInF1eWVuIjoic2luaHZpZW4ifX0.riF7cOGFXA7r5Tgo_nFwO4A29AXj4UbPfU9IOIWqZU4', 'sinhvien', '2022-05-24 16:47:58', '2022-05-25 16:47:58'),
(304, '3118410018', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTM4OTQyODksIm5iZiI6MTY1Mzg5NDI5OSwiZXhwIjoxNjUzOTgwNjg5LCJhdWQiOiJzaW5odmllbiIsInNpbmh2aWVuIjp7Im1hU2luaFZpZW4iOiIzMTE4NDEwMDE4IiwiaG9UZW5TaW5oVmllbiI6IkxcdTAwY2EgTkdcdTAwZDQgVEhJXHUwMGNhTiBcdTFlYTROIiwicXV5ZW4iOiJzaW5odmllbiJ9fQ.-Tyel4_NNz6p3-nmNTMEBHXl1HaMWZFB3uGDiyImPiM', 'sinhvien', '2022-05-30 07:04:49', '2022-05-31 07:04:49'),
(315, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTM5NTgyNDIsIm5iZiI6MTY1Mzk1ODI1MiwiZXhwIjoxNjU0MDQ0NjQyLCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.8Axv1vUvnhUPACYDB4w5Cds3RTqVVXnhwjBqq82nFyo', 'ctsv', '2022-05-31 00:50:42', '2022-06-01 00:50:42'),
(316, '11364', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTM5NzU3MDAsIm5iZiI6MTY1Mzk3NTcxMCwiZXhwIjoxNjU0MDYyMTAwLCJhdWQiOiJjdmh0IiwiY3ZodCI6eyJtYUNvVmFuSG9jVGFwIjoiMTEzNjQiLCJob1RlbkNvVmFuIjoiTFx1MDFiMFx1MDFhMW5nIE1pbmggSHVcdTFlYTVuIiwicXV5ZW4iOiJjdmh0In19.620yR76iBrlhLcWb-DUqpjAio-221dDTBghHpYymCCI', 'cvht', '2022-05-31 05:41:40', '2022-06-01 05:41:40'),
(317, '3118410262', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTM5NzYxNjUsIm5iZiI6MTY1Mzk3NjE3NSwiZXhwIjoxNjU0MDYyNTY1LCJhdWQiOiJzaW5odmllbiIsInNpbmh2aWVuIjp7Im1hU2luaFZpZW4iOiIzMTE4NDEwMjYyIiwiaG9UZW5TaW5oVmllbiI6Ik5HVVlcdTFlYzROIFRIXHUwMWFmXHUwMWEwTkcgTVx1MWViZU4iLCJxdXllbiI6InNpbmh2aWVuIn19.KT10WwR3aJ2GUkmdB_iEUIjOuxfjFDOhCcxmr8bPDyw', 'sinhvien', '2022-05-31 05:49:25', '2022-06-01 05:49:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chamdiemrenluyen`
--
ALTER TABLE `chamdiemrenluyen`
  ADD PRIMARY KEY (`maChamDiemRenLuyen`);

--
-- Indexes for table `covanhoctap`
--
ALTER TABLE `covanhoctap`
  ADD PRIMARY KEY (`maCoVanHocTap`);

--
-- Indexes for table `hoatdongdanhgia`
--
ALTER TABLE `hoatdongdanhgia`
  ADD PRIMARY KEY (`maHoatDong`);

--
-- Indexes for table `hockydanhgia`
--
ALTER TABLE `hockydanhgia`
  ADD PRIMARY KEY (`maHocKyDanhGia`);

--
-- Indexes for table `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`maKhoa`);

--
-- Indexes for table `khoahoc`
--
ALTER TABLE `khoahoc`
  ADD PRIMARY KEY (`maKhoaHoc`);

--
-- Indexes for table `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`maLop`);

--
-- Indexes for table `phieurenluyen`
--
ALTER TABLE `phieurenluyen`
  ADD PRIMARY KEY (`maPhieuRenLuyen`);

--
-- Indexes for table `phongcongtacsinhvien`
--
ALTER TABLE `phongcongtacsinhvien`
  ADD PRIMARY KEY (`taiKhoan`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`maSinhVien`);

--
-- Indexes for table `thamgiahoatdong`
--
ALTER TABLE `thamgiahoatdong`
  ADD PRIMARY KEY (`maThamGiaHoatDong`);

--
-- Indexes for table `thongbaodanhgia`
--
ALTER TABLE `thongbaodanhgia`
  ADD PRIMARY KEY (`maThongBao`);

--
-- Indexes for table `tieuchicap1`
--
ALTER TABLE `tieuchicap1`
  ADD PRIMARY KEY (`matc1`);

--
-- Indexes for table `tieuchicap2`
--
ALTER TABLE `tieuchicap2`
  ADD PRIMARY KEY (`matc2`);

--
-- Indexes for table `tieuchicap3`
--
ALTER TABLE `tieuchicap3`
  ADD PRIMARY KEY (`matc3`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`stt`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chamdiemrenluyen`
--
ALTER TABLE `chamdiemrenluyen`
  MODIFY `maChamDiemRenLuyen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=582;

--
-- AUTO_INCREMENT for table `thamgiahoatdong`
--
ALTER TABLE `thamgiahoatdong`
  MODIFY `maThamGiaHoatDong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `thongbaodanhgia`
--
ALTER TABLE `thongbaodanhgia`
  MODIFY `maThongBao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tieuchicap1`
--
ALTER TABLE `tieuchicap1`
  MODIFY `matc1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tieuchicap2`
--
ALTER TABLE `tieuchicap2`
  MODIFY `matc2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tieuchicap3`
--
ALTER TABLE `tieuchicap3`
  MODIFY `matc3` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `stt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=318;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

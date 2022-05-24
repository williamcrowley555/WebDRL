-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2022 at 06:36 AM
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
(337, 'PRLHK221223118410262', 1, 0, '3118410262', 0, 0, ''),
(338, 'PRLHK221223118410262', 2, 0, '3118410262', 0, 0, ''),
(339, 'PRLHK221223118410262', 3, 0, '3118410262', 0, 0, ''),
(340, 'PRLHK221223118410262', 4, 0, '3118410262', 0, 0, ''),
(341, 'PRLHK221223118410262', 5, 0, '3118410262', 0, 0, ''),
(342, 'PRLHK221223118410262', 6, 0, '3118410262', 0, 0, ''),
(343, 'PRLHK221223118410262', 7, 0, '3118410262', 0, 0, ''),
(344, 'PRLHK221223118410262', 8, 0, '3118410262', 0, 0, ''),
(345, 'PRLHK221223118410262', 9, 0, '3118410262', 0, 0, ''),
(346, 'PRLHK221223118410262', 10, 0, '3118410262', 0, 0, ''),
(347, 'PRLHK221223118410262', 11, 0, '3118410262', 0, 0, ''),
(348, 'PRLHK221223118410262', 12, 0, '3118410262', 0, 0, ''),
(349, 'PRLHK221223118410262', 13, 0, '3118410262', 0, 0, ''),
(350, 'PRLHK221223118410262', 14, 0, '3118410262', 0, 0, ''),
(351, 'PRLHK221223118410262', 15, 0, '3118410262', 0, 0, ''),
(352, 'PRLHK221223118410262', 16, 0, '3118410262', 0, 0, ''),
(353, 'PRLHK221223118410262', 17, 0, '3118410262', 0, 0, ''),
(354, 'PRLHK221223118410262', 18, 0, '3118410262', 0, 0, ''),
(355, 'PRLHK221223118410262', 19, 0, '3118410262', 0, 0, ''),
(356, 'PRLHK221223118410262', 20, 0, '3118410262', 0, 0, ''),
(357, 'PRLHK221223118410262', 21, 0, '3118410262', 0, 0, ''),
(358, 'PRLHK221223118410262', 0, 7, '3118410262', 0, 0, ''),
(359, 'PRLHK221223118410262', 0, 8, '3118410262', 0, 0, ''),
(360, 'PRLHK221223118410262', 0, 9, '3118410262', 0, 0, ''),
(361, 'PRLHK221223118410262', 0, 10, '3118410262', 0, 0, ''),
(362, 'PRLHK221223118410262', 22, 0, '3118410262', 0, 0, ''),
(363, 'PRLHK221223118410262', 23, 0, '3118410262', 0, 0, ''),
(364, 'PRLHK221223118410262', 0, 12, '3118410262', 0, 0, ''),
(365, 'PRLHK221223118410262', 24, 0, '3118410262', 0, 0, ''),
(366, 'PRLHK221223118410262', 25, 0, '3118410262', 0, 0, ''),
(367, 'PRLHK221223118410262', 26, 0, '3118410262', 0, 0, ''),
(368, 'PRLHK221223118410262', 0, 14, '3118410262', 0, 0, ''),
(369, 'PRLHK221223118410262', 0, 15, '3118410262', 0, 0, ''),
(370, 'PRLHK221223118410262', 0, 16, '3118410262', 0, 0, ''),
(371, 'PRLHK221223118410262', 0, 17, '3118410262', 0, 0, ''),
(372, 'PRLHK221223118410262', 0, 18, '3118410262', 0, 0, ''),
(373, 'PRLHK221223118410262', 0, 19, '3118410262', 0, 0, ''),
(374, 'PRLHK221223118410262', 0, 20, '3118410262', 0, 0, ''),
(375, 'PRLHK221223118410262', 0, 21, '3118410262', 0, 0, ''),
(376, 'PRLHK221223118410262', 0, 22, '3118410262', 0, 0, ''),
(377, 'PRLHK221223118410262', 0, 23, '3118410262', 0, 0, ''),
(378, 'PRLHK221223118410262', 0, 24, '3118410262', 0, 0, ''),
(379, 'PRLHK221223118410262', 0, 25, '3118410262', 0, 0, ''),
(380, 'PRLHK221223118410262', 0, 26, '3118410262', 0, 0, ''),
(381, 'PRLHK221223118410262', 0, 27, '3118410262', 0, 0, ''),
(382, 'PRLHK221223118410262', 27, 0, '3118410262', 0, 0, ''),
(383, 'PRLHK221223118410262', 28, 0, '3118410262', 0, 0, ''),
(384, 'PRLHK221223118410262', 0, 29, '3118410262', 15, 0, ''),
(385, 'PRLHK221223118410262', 0, 30, '3118410262', 10, 0, '');

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
('11364', 'Lương Minh Huấn', '0559349434', '804fce744c17d9250210436d98709490', 'cvht');

-- --------------------------------------------------------

--
-- Table structure for table `hoatdongdanhgia`
--

CREATE TABLE `hoatdongdanhgia` (
  `maHoatDong` int(11) NOT NULL,
  `maTieuChi2` int(11) NOT NULL,
  `maTieuChi3` int(11) NOT NULL,
  `maKhoa` int(11) NOT NULL,
  `tenHoatDong` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diemNhanDuoc` int(11) NOT NULL,
  `diaDiemDienRaHoatDong` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maQRDiaDiem` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thoiGianBatDauHoatDong` datetime NOT NULL,
  `thoiGianKetThucHoatDong` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
('PRLHK221223118410262', 'Kém', 25, '3118410262', 3.5, 4, 'HK22122', 0, 0, 'alohe.zip');

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
('3118410046', 'TRẦN THANH CỦA', '2000-10-13', 'Đại học', '73ea22f44907a127b85844322e41447c', 'DCT1189', 'sinhvien'),
('3118410059', 'NGUYỄN PHƯỚC DUY', '2000-11-13', 'Đại học', 'd78c4e1abc3480c8899313aa648f9e03', 'DCT1189', 'sinhvien'),
('3118410262', 'NGUYỄN THƯƠNG MẾN', '2000-06-01', 'Đại học', 'b75617aed87d1a170dd25d22547f888d', 'DCT1189', 'sinhvien');

-- --------------------------------------------------------

--
-- Table structure for table `thamgiahoatdong`
--

CREATE TABLE `thamgiahoatdong` (
  `maThamGiaHoatDong` int(11) NOT NULL,
  `maHoatDong` int(11) NOT NULL,
  `maSinhVienThamGia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(245, '3118410018', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTMzNDYxOTAsIm5iZiI6MTY1MzM0NjIwMCwiZXhwIjoxNjUzNDMyNTkwLCJhdWQiOiJzaW5odmllbiIsInNpbmh2aWVuIjp7Im1hU2luaFZpZW4iOiIzMTE4NDEwMDE4IiwiaG9UZW5TaW5oVmllbiI6IkxcdTAwY2EgTkdcdTAwZDQgVEhJXHUwMGNhTiBcdTFlYTROIiwicXV5ZW4iOiJzaW5odmllbiJ9fQ.U4VvWUJ9dJ5CC7SdsVzSPiHWP_VwYQ8V0Zc1CeSRGhs', 'sinhvien', '2022-05-23 22:49:50', '2022-05-24 22:49:50'),
(252, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTMzOTQ2OTUsIm5iZiI6MTY1MzM5NDcwNSwiZXhwIjoxNjUzNDgxMDk1LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0._hH8iegJr9wwNhchEuH6RdPh3YqF_ZxeAFHtrjvecE0', 'ctsv', '2022-05-24 12:18:15', '2022-05-25 12:18:15'),
(254, '3118410046', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTM0MTA4NzgsIm5iZiI6MTY1MzQxMDg4OCwiZXhwIjoxNjUzNDk3Mjc4LCJhdWQiOiJzaW5odmllbiIsInNpbmh2aWVuIjp7Im1hU2luaFZpZW4iOiIzMTE4NDEwMDQ2IiwiaG9UZW5TaW5oVmllbiI6IlRSXHUxZWE2TiBUSEFOSCBDXHUxZWU2QSIsInF1eWVuIjoic2luaHZpZW4ifX0.riF7cOGFXA7r5Tgo_nFwO4A29AXj4UbPfU9IOIWqZU4', 'sinhvien', '2022-05-24 16:47:58', '2022-05-25 16:47:58'),
(257, '11364', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTM0MjQ4MDAsIm5iZiI6MTY1MzQyNDgxMCwiZXhwIjoxNjUzNTExMjAwLCJhdWQiOiJjdmh0IiwiY3ZodCI6eyJtYUNvVmFuSG9jVGFwIjoiMTEzNjQiLCJob1RlbkNvVmFuIjoiTFx1MDFiMFx1MDFhMW5nIE1pbmggSHVcdTFlYTVuIiwicXV5ZW4iOiJjdmh0In19.8fEhoaTpfevjMUD8znYvKJmzDx-EZjrfIugYjHTxFPo', 'cvht', '2022-05-24 20:40:00', '2022-05-25 20:40:00'),
(258, '3118410262', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTM0Mjg1MTAsIm5iZiI6MTY1MzQyODUyMCwiZXhwIjoxNjUzNTE0OTEwLCJhdWQiOiJzaW5odmllbiIsInNpbmh2aWVuIjp7Im1hU2luaFZpZW4iOiIzMTE4NDEwMjYyIiwiaG9UZW5TaW5oVmllbiI6Ik5HVVlcdTFlYzROIFRIXHUwMWFmXHUwMWEwTkcgTVx1MWViZU4iLCJxdXllbiI6InNpbmh2aWVuIn19.-vpcT9QSkzwP7lJ3vwruwV1_nyMcZVgyYF3sySW6afQ', 'sinhvien', '2022-05-24 21:41:50', '2022-05-25 21:41:50');

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
  MODIFY `maChamDiemRenLuyen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT for table `hoatdongdanhgia`
--
ALTER TABLE `hoatdongdanhgia`
  MODIFY `maHoatDong` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thamgiahoatdong`
--
ALTER TABLE `thamgiahoatdong`
  MODIFY `maThamGiaHoatDong` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thongbaodanhgia`
--
ALTER TABLE `thongbaodanhgia`
  MODIFY `maThongBao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `stt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

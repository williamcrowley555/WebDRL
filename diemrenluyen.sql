-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 09, 2022 lúc 11:43 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `diemrenluyen`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chamdiemrenluyen`
--

CREATE TABLE `chamdiemrenluyen` (
  `maChamDiemRenLuyen` int(11) NOT NULL,
  `maPhieuRenLuyen` int(11) NOT NULL,
  `maTieuChi3` int(11) NOT NULL,
  `maTieuChi2` int(11) NOT NULL,
  `maSinhVien` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diemSinhVienDanhGia` int(11) NOT NULL,
  `diemLopDanhGia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `covanhoctap`
--

CREATE TABLE `covanhoctap` (
  `maCoVanHocTap` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `hoTenCoVan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `soDienThoai` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `matKhauTaiKhoanCoVan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quyen` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'covanhoctap'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `covanhoctap`
--

INSERT INTO `covanhoctap` (`maCoVanHocTap`, `hoTenCoVan`, `soDienThoai`, `matKhauTaiKhoanCoVan`, `quyen`) VALUES
('23423', 'Nguyễn Văn B', '045234234234', '468171c825c02408cc99935447c785a5', 'covanhoctap'),
('321', 'men', '0987654321', 'caf1a3dfb505ffed0d024130f58c5cfa', 'covanhoctap'),
('34234', 'Cố vấn 1', '3424', 'e10adc3949ba59abbe56e057f20f883e', 'covanhoctap'),
('969363', 'AAAA', '969363', '3223ebb174aaba8db2c4af254266cca0', 'covanhoctap'),
('aloha', 'aloha', 'aloha', 'd34b6c59ef0497d8ff246abd1049352e', 'covanhoctap'),
('data', 'data', 'data', '8d777f385d3dfec8815d20f7496026dc', 'covanhoctap'),
('đádasd', 'ádasd', 'ádasd', '202cb962ac59075b964b07152d234b70', 'covanhoctap'),
('fdfdsf', 'fdfdsf', 'fdfdsf', '0decf2e926011bf53eb22c7e6e73094d', 'covanhoctap'),
('GV321', 'men', '0987654321', 'caf1a3dfb505ffed0d024130f58c5cfa', 'covanhoctap'),
('vcvxcvxcvx', 'vcvxcvxcvx', 'vcvxcvxcvx', '7e529a9ee5d6a3a01833cf9eaeb41d29', 'covanhoctap');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoatdongdanhgia`
--

CREATE TABLE `hoatdongdanhgia` (
  `maHoatDong` int(11) NOT NULL,
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
-- Cấu trúc bảng cho bảng `hockydanhgia`
--

CREATE TABLE `hockydanhgia` (
  `maHocKyDanhGia` int(11) NOT NULL,
  `hocKyXet` int(11) NOT NULL,
  `namHocXet` int(11) NOT NULL,
  `maSinhVien` int(11) NOT NULL,
  `coVanDuyet` int(11) NOT NULL,
  `khoaDuyet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoa`
--

CREATE TABLE `khoa` (
  `maKhoa` int(11) NOT NULL,
  `tenKhoa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `taiKhoanKhoa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `matKhauKhoa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quyen` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'khoa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khoa`
--

INSERT INTO `khoa` (`maKhoa`, `tenKhoa`, `taiKhoanKhoa`, `matKhauKhoa`, `quyen`) VALUES
(6, 'Công nghệ thông tinnn', 'cntt', '8e347e789002556f4b6043bbd2c0862f', 'khoa'),
(7, 'nghe thuat', 'nghethuat', '0fb7d766f7c97572770762946940ce9a', 'khoa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoahoc`
--

CREATE TABLE `khoahoc` (
  `maKhoaHoc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `namBatDau` year(4) NOT NULL,
  `namKetThuc` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop`
--

CREATE TABLE `lop` (
  `maLop` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tenLop` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maKhoa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maCoVanHocTap` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maKhoaHoc` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lop`
--

INSERT INTO `lop` (`maLop`, `tenLop`, `maKhoa`, `maCoVanHocTap`, `maKhoaHoc`) VALUES
('DCT1189', 'Công nghệ thông tin lớp 9', 'DCT', '11898', 'K18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieurenluyen`
--

CREATE TABLE `phieurenluyen` (
  `maPhieuRenLuyen` int(11) NOT NULL,
  `xepLoai` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diemTongCong` int(11) NOT NULL,
  `maSinhVien` int(11) NOT NULL,
  `diemTrungBinhChungHKTruoc` double NOT NULL,
  `diemTrungBinhChungHKXet` double NOT NULL,
  `maHocKyDanhGia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phongcongtacsinhvien`
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
-- Đang đổ dữ liệu cho bảng `phongcongtacsinhvien`
--

INSERT INTO `phongcongtacsinhvien` (`taiKhoan`, `matKhau`, `hoTenNhanVien`, `email`, `sodienthoai`, `diaChi`, `quyen`) VALUES
('ctsv1', '0bf27758133599500db277a95366941b', 'Nhân viên CTSV 1', 'ctsv1@edu.vn', '0562346234', '87 Nguyễn Văn Cừ, TP HCM', 'ctsv');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
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
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`maSinhVien`, `hoTenSinhVien`, `ngaySinh`, `he`, `matKhauSinhVien`, `maLop`, `quyen`) VALUES
('1234', 'phong', '2022-04-12', 'a', '202cb962ac59075b964b07152d234b70', '123', 'sinhvien'),
('3118410262', 'Nguyễn Thương Mến', '2006-04-07', 'd', 'e10adc3949ba59abbe56e057f20f883e', 's', 'sinhvien'),
('3118410328', 'men', '2022-04-12', 'a', '202cb962ac59075b964b07152d234b70', '123', 'sinhvien'),
('3119200001', 'VÕ TUẤN ANH ', '2001-01-13', 'Đại học', '0a76e3b1832d55f9dfdfc9e29ff59d38', 'DGD1191', 'sinhvien'),
('3119200002', 'VƯƠNG NGỌC CHÂU ', '2000-09-25', 'Đại học', 'dcfcdfef773c27cee8850b66d6416df9', 'DGD1191', 'sinhvien'),
('3119200003', 'NGUYỄN THỊ KIỀU DIỂM ', '2001-05-28', 'Đại học', '7df07f5ead2efcf30ffacf0a5d718564', 'DGD1191', 'sinhvien'),
('3119200007', 'CAO HỒNG NHUẬN ', '2001-08-31', 'Đại học', 'da0b1a83844ee73f2c497f78c5a7df68', 'DGD1191', 'sinhvien'),
('3119200008', 'HUỲNH THỊ HOÀNG PHẤN ', '2001-04-01', 'Đại học', 'd321a2e046edbb1d6b3e2d58fe19e0a2', 'DGD1191', 'sinhvien'),
('3119200009', 'PHẠM THỊ YẾN PHƯƠNG ', '2001-07-25', 'Đại học', 'e424d1a0166e86dd2f10d649255b7ad3', 'DGD1191', 'sinhvien'),
('3119200010', 'DƯƠNG PHẠM NGÂN QUỲNH ', '2001-06-19', 'Đại học', '561327ec9100e8073e5645989b9af25f', 'DGD1191', 'sinhvien'),
('3119200011', 'LÊ THỊ THÙY TRANG ', '2001-09-18', 'Đại học', 'e1583b89e6bbbe884670af8ee7853520', 'DGD1191', 'sinhvien'),
('3119200013', 'TÔ BẢO VY ', '2001-08-01', 'Đại học', '09e8f94923f747d130994a8d7a594e79', 'DGD1191', 'sinhvien'),
('3120200001', 'NGUYỄN TUẤN ANH ', '2002-03-06', 'Đại học', 'cb4129b7759ba216e85b929f211d11de', 'DGD1201', 'sinhvien'),
('3120200002', 'LÂM NHÃ BÌNH ', '2002-03-26', 'Đại học', 'd76f0c379930b4cfbfa734f533c5292f', 'DGD1201', 'sinhvien'),
('3120200003', 'HUỲNH THỊ THANH CHÚC ', '2002-08-10', 'Đại học', 'bcf1e579199347b4d304da6d98c99554', 'DGD1201', 'sinhvien'),
('3120200005', 'ĐẶNG NGỌC DUYÊN ', '2002-11-15', 'Đại học', '71600d42e6ec5232b6efa37757e9e8f7', 'DGD1201', 'sinhvien'),
('3120200006', 'PHÙNG KIM HÂN ', '2002-06-20', 'Đại học', 'd83ea6067d01acbaf4f768c7a7110ef8', 'DGD1201', 'sinhvien'),
('3120200009', 'TRẦN THỊ YẾN KHOA ', '2002-11-18', 'Đại học', '7ab23d2373a191f3c385d02089ff2028', 'DGD1201', 'sinhvien'),
('3120200010', 'NGUYỄN THỊ MỸ LINH ', '2002-10-05', 'Đại học', '407a0e03b95fae25b85f354401877f4f', 'DGD1201', 'sinhvien'),
('3120200011', 'ĐẶNG LƯU NỮ CẨM LY ', '2002-02-01', 'Đại học', '3004618885b27a2a371f4b8be9c48963', 'DGD1201', 'sinhvien'),
('3120200012', 'NGUYỄN LÊ HỒNG MAI ', '2002-10-20', 'Đại học', 'e42ea2678ea3bcaeff776aff256e9c28', 'DGD1201', 'sinhvien'),
('3120200013', 'NGUYỄN THỊ NGỌC MAI ', '2002-11-12', 'Đại học', '95f571953e9589494be43e41ae6e9da5', 'DGD1201', 'sinhvien'),
('3120200014', 'ĐINH THỊ DIỄM MY ', '2002-10-23', 'Đại học', '71c2573ef384e67c8b0269f907c4f608', 'DGD1201', 'sinhvien'),
('3120200015', 'ĐÀO THỊ THU NGA ', '2002-01-12', 'Đại học', 'dd2f27180c0bbe920fdf49b691dfa88c', 'DGD1201', 'sinhvien'),
('3120200016', 'NGUYỄN THỊ TUYẾT NGÂN ', '2002-01-02', 'Đại học', '4da7ae226de70fca73184b33455d8ead', 'DGD1201', 'sinhvien'),
('3120200017', 'PHÙNG NGUYỄN NGỌC KIM NGÂN ', '2002-01-17', 'Đại học', 'cd8655e4e1db45d795b850a817ecd9c7', 'DGD1201', 'sinhvien'),
('3120200018', 'PHÙNG ÁNH NGỌC ', '2002-12-11', 'Đại học', 'ad6dabe58bb9a9a63e211c506da92472', 'DGD1201', 'sinhvien'),
('3120200019', 'ĐINH TÔ HOÀNG NGUYÊN ', '2002-04-16', 'Đại học', 'a6cd16ea4dca6907a1c673cd1798fb03', 'DGD1201', 'sinhvien'),
('3120200022', 'DƯƠNG THỊ KIM QUYÊN ', '2002-08-07', 'Đại học', '0765d434e5b35c5af7f8a2012867dcd7', 'DGD1201', 'sinhvien'),
('3120200024', 'HỒ QUANG THỊNH ', '2002-10-13', 'Đại học', 'a95a9de8ae625ec5370fc9d3d6f60e9f', 'DGD1201', 'sinhvien'),
('3120200025', 'NGUYỄN THỊ HOÀI THU ', '2002-08-09', 'Đại học', 'f5f19da822341df5bf1330ad43c228fd', 'DGD1201', 'sinhvien'),
('3120200026', 'NGUYỄN THỊ CẨM THUY ', '2002-03-05', 'Đại học', 'dfaaf8e5d813f1e77ff6a01f6b4b05c1', 'DGD1201', 'sinhvien'),
('3120200029', 'NGUYỄN THỊ THÙY TRANG ', '2002-09-07', 'Đại học', '821185cddafe58f2976b03a925aec71c', 'DGD1201', 'sinhvien'),
('3120200030', 'ĐÀO THỊ BÍCH TRÂM ', '2002-04-05', 'Đại học', 'd114955b922a4502439e1043913ff640', 'DGD1201', 'sinhvien'),
('3120200032', 'NGUYỄN MAI TRÂN ', '2002-07-27', 'Đại học', 'c6b88bc00eff72264ccea1dbd63266e2', 'DGD1201', 'sinhvien'),
('3120200033', 'NGUYỄN THANH TRÚC ', '2002-12-23', 'Đại học', '4c0d2dc3c5a8c7fe2b2292f82ccd4076', 'DGD1201', 'sinhvien'),
('3120200034', 'PHƯƠNG PHI TRƯỜNG ', '2001-06-09', 'Đại học', 'cb27e3cd790850e20ca224b89df05590', 'DGD1201', 'sinhvien'),
('3120200036', 'TÔ XUÂN VÀNG ', '2002-08-04', 'Đại học', 'e7c8e67ee008d86f6489aca3d3813e81', 'DGD1201', 'sinhvien'),
('3120200037', 'LÊ THÚY VÂN ', '2002-09-11', 'Đại học', '1539678f34b8ddf39201472e26fcec8b', 'DGD1201', 'sinhvien'),
('3120200038', 'NGUYỄN HUỲNH THẢO VY ', '2002-06-02', 'Đại học', 'fd20a307c1c11a5bb5a2ab05e9e36c0d', 'DGD1201', 'sinhvien'),
('3120200039', 'NGUYỄN THỊ NGỌC YẾN ', '2002-10-28', 'Đại học', '94846eba5712252c0d5ea2fc2a317de9', 'DGD1201', 'sinhvien'),
('3120200040', 'TRẦN THỊ KIM YẾN ', '2002-09-02', 'Đại học', '576972c2f455e1e024bfeddcb44c7f09', 'DGD1201', 'sinhvien'),
('3121200002', 'CAO THỊ NGỌC ANH ', '2003-07-25', 'Đại học', '614cfd6748d614dcfe50852382601df0', 'DGD1211', 'sinhvien'),
('3121200003', 'NGUYỄN HOÀNG PHƯƠNG ANH ', '2003-10-23', 'Đại học', 'e3713daae2a158844bccb2effab08f5c', 'DGD1211', 'sinhvien'),
('3121200004', 'NGUYỄN QUỲNH ANH ', '2003-10-25', 'Đại học', 'af35525028fba23f63080b99f1da4820', 'DGD1211', 'sinhvien'),
('3121200005', 'NGUYỄN LÊ KHÁNH DUY ', '2003-03-23', 'Đại học', '8726393725b768076e408177f871809a', 'DGD1211', 'sinhvien'),
('3121200007', 'TRẦN THỊ KHÁNH HUYỀN ', '2003-04-04', 'Đại học', 'e4c666716af3cd9e7e29a1fdda4b2b56', 'DGD1211', 'sinhvien'),
('3121200010', 'NGUYỄN THỊ PHƯƠNG LAN ', '0000-00-00', 'Đại học', 'e387f02b505af5ef67a9ac0f94877cf0', 'DGD1211', 'sinhvien'),
('3121200011', 'NGUYỄN THANH LIÊM ', '2003-08-01', 'Đại học', '800e8ff35839f7adbaa32da8ffaa4dc0', 'DGD1211', 'sinhvien'),
('3121200012', 'TRẦN NGỌC LIÊN ', '2003-02-22', 'Đại học', '94892bce34ca2fcbbe879393eca43afd', 'DGD1211', 'sinhvien'),
('3121200013', 'LÊ THỊ THÙY LINH ', '2003-10-04', 'Đại học', '1e805dc3a38189ceeb06380a93e9310c', 'DGD1211', 'sinhvien'),
('3121200014', 'THÁI THỊ BÍCH LOAN ', '2003-02-17', 'Đại học', 'cf6de6a4c8260c0787bc2bd36a2c497c', 'DGD1211', 'sinhvien'),
('3121200016', 'NGUYỄN HỒ NGỌC NGÂN ', '2003-06-30', 'Đại học', '659d36ce8f5dd05549d3c17ac072dd9b', 'DGD1211', 'sinhvien'),
('3121200017', 'NGUYỄN THỊ HỒNG NHUNG ', '2003-11-23', 'Đại học', 'fd0a06d98281cae4781afa4c25bbae3f', 'DGD1211', 'sinhvien'),
('3121200018', 'ĐẶNG THỊ HUỲNH NHƯ ', '2003-10-20', 'Đại học', 'a0b844a6cf5c28fef2c3a4b7a1e16fa5', 'DGD1211', 'sinhvien'),
('3121200019', 'SIM NIÊ ', '2003-11-20', 'Đại học', 'd59a56d14f005defd06067f5d6d60165', 'DGD1211', 'sinhvien'),
('3121200020', 'TRẦN THỊ TÚ PHƯƠNG ', '2003-10-01', 'Đại học', '51d7cb151d3009e8d51b98406bcd7aab', 'DGD1211', 'sinhvien'),
('3121200023', 'HỒ ANH THƯ ', '2003-02-12', 'Đại học', '2ab8abfb0d8050efe09db17b8df1939a', 'DGD1211', 'sinhvien'),
('3121200024', 'MAI HOÀNG ĐOAN THƯ ', '2003-09-23', 'Đại học', '6c446ca4f9b85c6f3e575219613fbeea', 'DGD1211', 'sinhvien'),
('3121200025', 'PHAN LÊ ANH THƯ ', '2003-12-08', 'Đại học', 'f8318da9fdf10bf24f155fb36fd98891', 'DGD1211', 'sinhvien'),
('3121200026', 'TRẦN THỊ NGỌC THƯƠNG ', '0000-00-00', 'Đại học', 'c30834aff42a2814d5e86acedab306d9', 'DGD1211', 'sinhvien'),
('3121200027', 'LĂNG NGUYỄN ĐOAN TRANG ', '2003-11-10', 'Đại học', 'f6dd2b849f55d5b36a06153d1636ff65', 'DGD1211', 'sinhvien'),
('3121200028', 'LÊ PHẠM PHƯƠNG TRANG ', '2003-07-10', 'Đại học', '45605c7a6678b895dc492e4640c836af', 'DGD1211', 'sinhvien'),
('3121200029', 'NGUYỄN THỊ BẢO TRÂM ', '2003-12-03', 'Đại học', '891147c5eeca69baf90c0892abe3b377', 'DGD1211', 'sinhvien'),
('3121200030', 'NGUYỄN THỊ NGỌC TRÂM ', '2003-06-07', 'Đại học', '25f34038dc4aff8fe6a4f370c464373a', 'DGD1211', 'sinhvien'),
('3121200032', 'MAI DƯƠNG HOÀNG TRINH ', '2003-01-31', 'Đại học', 'fce2cab5d569b81dc205147ef906d9ef', 'DGD1211', 'sinhvien'),
('3121200033', 'TRẦN THỊ DIỄM TRINH ', '2003-08-26', 'Đại học', '0194892dd37298ab0670acd122fcabf0', 'DGD1211', 'sinhvien'),
('3121200034', 'HUỲNH THỊ CẨM TÚ ', '2003-06-13', 'Đại học', 'cbfcf1523d1edd23fb5fbcb61ee4687f', 'DGD1211', 'sinhvien'),
('3121200035', 'TRẦN NGUYỄN DIỄM TUYỀN ', '2003-10-23', 'Đại học', '55959c39896da629f01fe42745899ceb', 'DGD1211', 'sinhvien'),
('3121200037', 'LÊ HUY VŨ ', '2003-11-08', 'Đại học', '666ac9e714b27da64e3cc8980e6d00b4', 'DGD1211', 'sinhvien'),
('3121200039', 'TRẦN BẢO YẾN ', '2003-07-17', 'Đại học', '90f3aae95fad6648590fc2805f3c410d', 'DGD1211', 'sinhvien');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thamgiahoatdong`
--

CREATE TABLE `thamgiahoatdong` (
  `maThamGiaHoatDong` int(11) NOT NULL,
  `maHoatDong` int(11) NOT NULL,
  `maSinhVienThamGia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongbaodanhgia`
--

CREATE TABLE `thongbaodanhgia` (
  `maThongBao` int(11) NOT NULL,
  `ngaySinhVienDanhGia` int(11) NOT NULL,
  `ngaySinhVienKetThucDanhGia` int(11) NOT NULL,
  `ngayCoVanDanhGia` int(11) NOT NULL,
  `ngayCoVanKetThucDanhGia` int(11) NOT NULL,
  `ngayKhoaDanhGia` int(11) NOT NULL,
  `ngayKhoaKetThucDanhGia` int(11) NOT NULL,
  `ngayThongBao` int(11) NOT NULL,
  `maHocKyDanhGia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tieuchicap1`
--

CREATE TABLE `tieuchicap1` (
  `matc1` int(11) NOT NULL,
  `noidung` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diemtoida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tieuchicap1`
--

INSERT INTO `tieuchicap1` (`matc1`, `noidung`, `diemtoida`) VALUES
(1, 'I - Đánh giá về ý thức và kết quả học tập (tối đa 20 điểm).', 20),
(2, 'II - Đánh giá về ý thức và kết quả chấp hành quy chế, nội quy, quy định trong nhà trường (tối đa 25 điểm).', 25),
(3, 'III - Đánh giá về ý thức và kết quả tham gia các hoạt động chính trị - xã hội, văn hóa, văn nghệ, thể thao, phòng chống các tệ nạn xã hội (tối đa 20 điểm).', 20),
(4, 'IV – Đánh giá ý thức công dân trong quan hệ cộng đồng (tối đa 25 điểm).', 25),
(5, 'V - Đánh giá về ý thức và kết quả tham gia phụ trách lớp, các đoàn thể trong nhà trường (tối đa 10 điểm).', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tieuchicap2`
--

CREATE TABLE `tieuchicap2` (
  `matc2` int(11) NOT NULL,
  `noidung` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diemtoida` int(11) NOT NULL,
  `matc1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tieuchicap2`
--

INSERT INTO `tieuchicap2` (`matc2`, `noidung`, `diemtoida`, `matc1`) VALUES
(1, '1.Kết quả học tập: TBC học kì trước:       TBC học kì được đánh giá:', 0, 1),
(2, '2.Tinh thần vượt khó trong học tập:', 0, 1),
(3, '3.Tham gia nghiên cứu khoa học (NCKH):', 0, 1),
(4, '4.Tham gia rèn luyện nghiệp vụ (RLNV):', 0, 1),
(5, '5.Tham gia các câu lạc bộ học thuật', 0, 1),
(6, '6.Thành viên đội tuyển dự thi Olympic các môn học:', 0, 1),
(7, '1. Tham gia các hoạt động chính trị – xã hội do nhà trường quy định:', 0, 3),
(8, '2. Tham gia hoạt động văn hóa, văn nghệ, TDTT, phòng chống TNXH…', 5, 3),
(9, '3. Tham gia trong đội tuyển văn nghệ, TDTT :', 0, 3),
(10, '2. Được biểu dương người tốt, việc tốt ở nhà trường hoặc ở địa phương (có giấy chứng nhận)', 5, 4),
(11, '3. Tham gia các hoạt động tình nguyện trung hạn: MHX, Tiếp sức mùa thi', 10, 4),
(12, '4. Tham gia các công tác xã hội và các hoạt động tình nguyện ngắn ngày (có xác nhận của đơn vị tổ chức)', 10, 4),
(13, '5. Có tinh thần chia sẻ, giúp đỡ người có khó khăn, hoạn nạn', 5, 4),
(14, '6. Tham gia hiến máu tình nguyện', 5, 4),
(15, '7. Tham gia hội thao GDQP –AN cấp quận, cấp TP', 5, 4),
(16, '8. Vi phạm ATGT, trật tự công cộng (có giấy báo gửi về trường)', -10, 4),
(17, '1. Lớp trưởng, BCH Đoàn trường, BCH Hội sinh viên trường', 10, 5),
(18, '2. Lớp phó, BCH Đoàn khoa, BCH LCH SV; BCH CĐ, BCH chi hội lớp', 8, 5),
(19, '3. Tổ trưởng, tổ phó', 3, 5),
(20, '4. Đảng viên', 8, 5),
(21, '5. Đối tượng Đảng', 5, 5),
(22, '6. Đoàn viên TNCS Hồ Chí Minh', 3, 5),
(23, '7. Được Đoàn thanh niên, Hội sinh viên biểu dương, khen thưởng', 0, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tieuchicap3`
--

CREATE TABLE `tieuchicap3` (
  `matc3` int(11) NOT NULL,
  `noidung` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diem` int(11) NOT NULL,
  `matc2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tieuchicap3`
--

INSERT INTO `tieuchicap3` (`matc3`, `noidung`, `diem`, `matc2`) VALUES
(1, 'a. Điểm trung bình chung học kì từ  3,60 đến 4,00', 14, 1),
(2, 'b. Điểm trung bình chung học kì từ  3,20 đến 3,59', 12, 1),
(3, 'c. Điểm trung bình chung học kì từ  2,50 đến 3,19', 10, 1),
(4, 'd. Điểm trung bình chung học kì từ  2,00 đến 2,49', 2, 1),
(5, 'đ. Điểm trung bình chung học kì  dưới 2,00', 0, 1),
(6, 'a. Kết quả học tập tăng một bậc so với học kỳ trước,  ĐTBCHK từ  2,00 trở lên', 3, 2),
(7, 'a. Kết quả học tập tăng một bậc so với học kỳ trước,  ĐTBCHK từ  2,00 trở lên', 6, 2),
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
(21, 'c. Cấp toàn quốc', 10, 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_token`
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
-- Đang đổ dữ liệu cho bảng `user_token`
--

INSERT INTO `user_token` (`stt`, `maSo`, `token`, `quyen`, `thoiGianDangNhap`, `thoiGianHetHan`) VALUES
(28, '3119200001', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTEzNDU5MDcsIm5iZiI6MTY1MTM0NTkxNywiZXhwIjoxNjUxNDMyMzA3LCJhdWQiOiJzaW5odmllbiIsInNpbmh2aWVuIjp7Im1hU2luaFZpZW4iOiIzMTE5MjAwMDAxIiwiaG9UZW5TaW5oVmllbiI6IlZcdTAwZDUgVFVcdTFlYTROIEFOSCAiLCJxdXllbiI6InNpbmh2aWVuIn19.cd59iQafcdfpokouj8BDeHPvn56C0DNJnLUWjlnywAo', 'sinhvien', '2022-04-30 14:11:47', '2022-05-01 14:11:47'),
(29, '3118410262', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE0MTk2MTAsIm5iZiI6MTY1MTQxOTYyMCwiZXhwIjoxNjUxNTA2MDEwLCJhdWQiOiJzaW5odmllbiIsInNpbmh2aWVuIjp7Im1hU2luaFZpZW4iOiIzMTE4NDEwMjYyIiwiaG9UZW5TaW5oVmllbiI6Ik5ndXlcdTFlYzVuIFRoXHUwMWIwXHUwMWExbmcgTVx1MWViZm4iLCJxdXllbiI6InNpbmh2aWVuIn19.Vgo5oWnbkjqsIaYWKR6gEFlPklOnwYm054hNva2dqmw', 'sinhvien', '2022-05-01 10:40:10', '2022-05-02 10:40:10'),
(70, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2MDM2NzgsIm5iZiI6MTY1MTYwMzY4OCwiZXhwIjoxNjUxNjkwMDc4LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.4U1s6X9H9PthlFzPPNhFudkc8k-ghyo9KXa87HkIvKA', 'ctsv', '2022-05-03 13:47:58', '2022-05-04 13:47:58'),
(71, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2MDQ4MzQsIm5iZiI6MTY1MTYwNDg0NCwiZXhwIjoxNjUxNjkxMjM0LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.uF9KNP4LdQaakuTH9XH_GxKZh2rvVxnCYiG5dytHNIE', 'ctsv', '2022-05-03 14:07:14', '2022-05-04 14:07:14'),
(72, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2MDQ4ODYsIm5iZiI6MTY1MTYwNDg5NiwiZXhwIjoxNjUxNjkxMjg2LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.QbuxyvoxYEe3RW1q3qvoMWvHwLPE_PS7mBhkWv8Rwyw', 'ctsv', '2022-05-03 14:08:06', '2022-05-04 14:08:06'),
(73, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2MDQ5NjgsIm5iZiI6MTY1MTYwNDk3OCwiZXhwIjoxNjUxNjkxMzY4LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.m3ce4i8MCQf0rehZBFineSNyvA0LltpD2HN12_NkuOk', 'ctsv', '2022-05-03 14:09:28', '2022-05-04 14:09:28'),
(74, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2MDUwMTAsIm5iZiI6MTY1MTYwNTAyMCwiZXhwIjoxNjUxNjkxNDEwLCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.wiQIs-oaPkxymkfFp8CKbUqWyQcEUrgnuShDIUg4wWg', 'ctsv', '2022-05-03 14:10:10', '2022-05-04 14:10:10'),
(75, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2MDU0MzUsIm5iZiI6MTY1MTYwNTQ0NSwiZXhwIjoxNjUxNjkxODM1LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.JZfqB817WwkJRdJFTcx7H8YeNJT8oLfEJWAOkS8DcBI', 'ctsv', '2022-05-03 14:17:15', '2022-05-04 14:17:15'),
(76, '3118410262', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2NDk3OTQsIm5iZiI6MTY1MTY0OTgwNCwiZXhwIjoxNjUxNzM2MTk0LCJhdWQiOiJzaW5odmllbiIsInNpbmh2aWVuIjp7Im1hU2luaFZpZW4iOiIzMTE4NDEwMjYyIiwiaG9UZW5TaW5oVmllbiI6Ik5ndXlcdTFlYzVuIFRoXHUwMWIwXHUwMWExbmcgTVx1MWViZm4iLCJxdXllbiI6InNpbmh2aWVuIn19.fN2vfQtNrEablMRG7Fw_Z1Tw55W8ZP9T2GrFFR_eTrQ', 'sinhvien', '2022-05-04 02:36:34', '2022-05-05 02:36:34'),
(77, '3118410262', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2NTE0MjcsIm5iZiI6MTY1MTY1MTQzNywiZXhwIjoxNjUxNzM3ODI3LCJhdWQiOiJzaW5odmllbiIsInNpbmh2aWVuIjp7Im1hU2luaFZpZW4iOiIzMTE4NDEwMjYyIiwiaG9UZW5TaW5oVmllbiI6Ik5ndXlcdTFlYzVuIFRoXHUwMWIwXHUwMWExbmcgTVx1MWViZm4iLCJxdXllbiI6InNpbmh2aWVuIn19.4aGwmNYUTO6BuL60pTZXF_vFjXG1bCaUS2eZTBCcPAI', 'sinhvien', '2022-05-04 03:03:47', '2022-05-05 03:03:47'),
(78, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2NTE0OTMsIm5iZiI6MTY1MTY1MTUwMywiZXhwIjoxNjUxNzM3ODkzLCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.MF45EVl_yDvk97bvpj8AdqZBc4xkI_MXb7uDlrmS_-g', 'ctsv', '2022-05-04 03:04:53', '2022-05-05 03:04:53'),
(79, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2NTIwMTYsIm5iZiI6MTY1MTY1MjAyNiwiZXhwIjoxNjUxNzM4NDE2LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.1BpeyKeBQItueL7nitGhlviZxdgzBxt5SMfWt2u0974', 'ctsv', '2022-05-04 03:13:36', '2022-05-05 03:13:36'),
(80, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2NTY1NjUsIm5iZiI6MTY1MTY1NjU3NSwiZXhwIjoxNjUxNzQyOTY1LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.1Ne6M0KX53-6HQU4cY1bPIosRecHquL74TR1oPtDjEQ', 'ctsv', '2022-05-04 04:29:25', '2022-05-05 04:29:25'),
(81, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2NTk3NzQsIm5iZiI6MTY1MTY1OTc4NCwiZXhwIjoxNjUxNzQ2MTc0LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.ufYYsyNerF14Jjk6cbvZmurtP_fA0CVG0qku15vsrwQ', 'ctsv', '2022-05-04 05:22:54', '2022-05-05 05:22:54'),
(82, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2NjAxNzAsIm5iZiI6MTY1MTY2MDE4MCwiZXhwIjoxNjUxNzQ2NTcwLCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.werAOHep0CeoqpXzXIWibxuIx8T3q_vi83Hxpa6sXF0', 'ctsv', '2022-05-04 05:29:30', '2022-05-05 05:29:30'),
(83, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2NjA1MDUsIm5iZiI6MTY1MTY2MDUxNSwiZXhwIjoxNjUxNzQ2OTA1LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.nurSpyCEVFUN9UAxemDYwKtdt4pkdQuwa_03RGb755I', 'ctsv', '2022-05-04 05:35:05', '2022-05-05 05:35:05'),
(84, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2NjA2NTYsIm5iZiI6MTY1MTY2MDY2NiwiZXhwIjoxNjUxNzQ3MDU2LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.8kmjryr6Ub4LpyAYs9mtppVKsGoWOKhn2FIWsAOYvmE', 'ctsv', '2022-05-04 05:37:36', '2022-05-05 05:37:36'),
(85, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2NjYzODksIm5iZiI6MTY1MTY2NjM5OSwiZXhwIjoxNjUxNzUyNzg5LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.JKmZHcrilK8p94y1pli0khTHoC1u_dOS6UYNVgcXjW0', 'ctsv', '2022-05-04 07:13:09', '2022-05-05 07:13:09'),
(86, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2NjY0MDEsIm5iZiI6MTY1MTY2NjQxMSwiZXhwIjoxNjUxNzUyODAxLCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.qV-4JNbviFiZb52Vr9B3z8R0oewxozyeunEGAxyrYq8', 'ctsv', '2022-05-04 07:13:21', '2022-05-05 07:13:21'),
(87, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2NjY0NDgsIm5iZiI6MTY1MTY2NjQ1OCwiZXhwIjoxNjUxNzUyODQ4LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.CxvZYBcKVro-uirZlqaCEn5ooT3-_w6Y3MnL40CiC-A', 'ctsv', '2022-05-04 07:14:08', '2022-05-05 07:14:08'),
(88, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2NjY0OTEsIm5iZiI6MTY1MTY2NjUwMSwiZXhwIjoxNjUxNzUyODkxLCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.Tf3OriGWKIOVcOh83g_t4QtduF9utIF3BDGRs68V_KA', 'ctsv', '2022-05-04 07:14:51', '2022-05-05 07:14:51'),
(89, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2NjY1NTAsIm5iZiI6MTY1MTY2NjU2MCwiZXhwIjoxNjUxNzUyOTUwLCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.RFXPKKiQQquwT3mZtheqJxgUOamw82Hj28pILzyfLfs', 'ctsv', '2022-05-04 07:15:50', '2022-05-05 07:15:50'),
(90, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2NjY1NjEsIm5iZiI6MTY1MTY2NjU3MSwiZXhwIjoxNjUxNzUyOTYxLCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.hVPc76Rc2oC9Hsjy5K0Nt6pQKbiVYJGhZS2a1yRNOU8', 'ctsv', '2022-05-04 07:16:01', '2022-05-05 07:16:01'),
(91, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2NjY2ODgsIm5iZiI6MTY1MTY2NjY5OCwiZXhwIjoxNjUxNzUzMDg4LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.ZetdgPzbnIn38UxDcMa0xse2iWQZPQhL_BvxTHtY4kU', 'ctsv', '2022-05-04 07:18:08', '2022-05-05 07:18:08'),
(92, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE2NjY3MTgsIm5iZiI6MTY1MTY2NjcyOCwiZXhwIjoxNjUxNzUzMTE4LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.s8Vp1o56L5L9vZg7_ncqnWeekOoF3BSVUtDg8QnUL7c', 'ctsv', '2022-05-04 07:18:38', '2022-05-05 07:18:38'),
(93, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE3NjQ0NDksIm5iZiI6MTY1MTc2NDQ1OSwiZXhwIjoxNjUxODUwODQ5LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.aUeLk1xCO5gpmMtvht_-URvp_HWr7q_gq9Vnpqw3qf0', 'ctsv', '2022-05-05 10:27:29', '2022-05-06 10:27:29'),
(94, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE3NjQ1MDgsIm5iZiI6MTY1MTc2NDUxOCwiZXhwIjoxNjUxODUwOTA4LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.2Oae1Zn8qoenctyKeVPCTlckPWAH27W7WJUAAkIO9fg', 'ctsv', '2022-05-05 10:28:28', '2022-05-06 10:28:28'),
(95, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE3NzA0MzAsIm5iZiI6MTY1MTc3MDQ0MCwiZXhwIjoxNjUxODU2ODMwLCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.bXdDx8XhXtJmVcKk6Ca0w_7_tuXbwD7Z_kiwD2lHENw', 'ctsv', '2022-05-05 12:07:10', '2022-05-06 12:07:10'),
(96, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE3NzA0NDcsIm5iZiI6MTY1MTc3MDQ1NywiZXhwIjoxNjUxODU2ODQ3LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.YKP-XZSQcXILTETXWWDmD4hUJNIDG7ZQwv1C8r8wF_M', 'ctsv', '2022-05-05 12:07:27', '2022-05-06 12:07:27'),
(97, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE3NzA0OTQsIm5iZiI6MTY1MTc3MDUwNCwiZXhwIjoxNjUxODU2ODk0LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.dtx3r-TWZhmUv1uUR_80hUNXnPGo4WKLd6lhAX0DRVs', 'ctsv', '2022-05-05 12:08:14', '2022-05-06 12:08:14'),
(98, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE3NzA1ODYsIm5iZiI6MTY1MTc3MDU5NiwiZXhwIjoxNjUxODU2OTg2LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.ygiLVXJRupny98hD-ii4jmWlfBowQzu4hEYbdHuTgoo', 'ctsv', '2022-05-05 12:09:46', '2022-05-06 12:09:46'),
(99, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE3NzA3MTgsIm5iZiI6MTY1MTc3MDcyOCwiZXhwIjoxNjUxODU3MTE4LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.iPD8Do_o9o4nuxLDJXB3InVUGrQL0k7cUYhUaoaQ9RI', 'ctsv', '2022-05-05 12:11:58', '2022-05-06 12:11:58'),
(100, '3118410262', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTIwMjkzNTIsIm5iZiI6MTY1MjAyOTM2MiwiZXhwIjoxNjUyMTE1NzUyLCJhdWQiOiJzaW5odmllbiIsInNpbmh2aWVuIjp7Im1hU2luaFZpZW4iOiIzMTE4NDEwMjYyIiwiaG9UZW5TaW5oVmllbiI6Ik5ndXlcdTFlYzVuIFRoXHUwMWIwXHUwMWExbmcgTVx1MWViZm4iLCJxdXllbiI6InNpbmh2aWVuIn19.xe4zo0Hjs59rPReW4G5qdcwIJak9TnlKXgj9ddEsX_Q', 'sinhvien', '2022-05-08 12:02:32', '2022-05-09 12:02:32'),
(101, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTIwODI2NzYsIm5iZiI6MTY1MjA4MjY4NiwiZXhwIjoxNjUyMTY5MDc2LCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.EJQFN1snKH_RrEsMvYTQmjqTCASvUheE6_v7i4cAUsM', 'ctsv', '2022-05-09 02:51:16', '2022-05-10 02:51:16'),
(102, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTIwODI3MDEsIm5iZiI6MTY1MjA4MjcxMSwiZXhwIjoxNjUyMTY5MTAxLCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.Pi_sn9bYVp7pmHabDole7Hq_in9iXe6cnjCYDLCojoY', 'ctsv', '2022-05-09 02:51:41', '2022-05-10 02:51:41'),
(103, '3118410262', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTIwODI5MzEsIm5iZiI6MTY1MjA4Mjk0MSwiZXhwIjoxNjUyMTY5MzMxLCJhdWQiOiJzaW5odmllbiIsInNpbmh2aWVuIjp7Im1hU2luaFZpZW4iOiIzMTE4NDEwMjYyIiwiaG9UZW5TaW5oVmllbiI6Ik5ndXlcdTFlYzVuIFRoXHUwMWIwXHUwMWExbmcgTVx1MWViZm4iLCJxdXllbiI6InNpbmh2aWVuIn19.QqthwcPPloqaoOhiPVLko5LDnhF4Pdsqro9yczuAcLk', 'sinhvien', '2022-05-09 02:55:31', '2022-05-10 02:55:31'),
(104, 'ctsv1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTIwODM2OTMsIm5iZiI6MTY1MjA4MzcwMywiZXhwIjoxNjUyMTcwMDkzLCJhdWQiOiJwaG9uZ2Nvbmd0YWNzaW5odmllbiIsInBob25nY29uZ3RhY3Npbmh2aWVuIjp7InRhaUtob2FuIjoiY3RzdjEiLCJob1Rlbk5oYW5WaWVuIjoiTmhcdTAwZTJuIHZpXHUwMGVhbiBDVFNWIDEiLCJxdXllbiI6ImN0c3YifX0.QCxiyMsu_KUQeOIATZ-tMhh0ZHhCRt1FOPN2hHYD8Sk', 'ctsv', '2022-05-09 03:08:13', '2022-05-10 03:08:13');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chamdiemrenluyen`
--
ALTER TABLE `chamdiemrenluyen`
  ADD PRIMARY KEY (`maChamDiemRenLuyen`);

--
-- Chỉ mục cho bảng `covanhoctap`
--
ALTER TABLE `covanhoctap`
  ADD PRIMARY KEY (`maCoVanHocTap`);

--
-- Chỉ mục cho bảng `hoatdongdanhgia`
--
ALTER TABLE `hoatdongdanhgia`
  ADD PRIMARY KEY (`maHoatDong`);

--
-- Chỉ mục cho bảng `hockydanhgia`
--
ALTER TABLE `hockydanhgia`
  ADD PRIMARY KEY (`maHocKyDanhGia`);

--
-- Chỉ mục cho bảng `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`maKhoa`);

--
-- Chỉ mục cho bảng `khoahoc`
--
ALTER TABLE `khoahoc`
  ADD PRIMARY KEY (`maKhoaHoc`);

--
-- Chỉ mục cho bảng `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`maLop`);

--
-- Chỉ mục cho bảng `phieurenluyen`
--
ALTER TABLE `phieurenluyen`
  ADD PRIMARY KEY (`maPhieuRenLuyen`);

--
-- Chỉ mục cho bảng `phongcongtacsinhvien`
--
ALTER TABLE `phongcongtacsinhvien`
  ADD PRIMARY KEY (`taiKhoan`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`maSinhVien`);

--
-- Chỉ mục cho bảng `thamgiahoatdong`
--
ALTER TABLE `thamgiahoatdong`
  ADD PRIMARY KEY (`maThamGiaHoatDong`);

--
-- Chỉ mục cho bảng `thongbaodanhgia`
--
ALTER TABLE `thongbaodanhgia`
  ADD PRIMARY KEY (`maThongBao`);

--
-- Chỉ mục cho bảng `tieuchicap1`
--
ALTER TABLE `tieuchicap1`
  ADD PRIMARY KEY (`matc1`);

--
-- Chỉ mục cho bảng `tieuchicap2`
--
ALTER TABLE `tieuchicap2`
  ADD PRIMARY KEY (`matc2`);

--
-- Chỉ mục cho bảng `tieuchicap3`
--
ALTER TABLE `tieuchicap3`
  ADD PRIMARY KEY (`matc3`);

--
-- Chỉ mục cho bảng `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`stt`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chamdiemrenluyen`
--
ALTER TABLE `chamdiemrenluyen`
  MODIFY `maChamDiemRenLuyen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hoatdongdanhgia`
--
ALTER TABLE `hoatdongdanhgia`
  MODIFY `maHoatDong` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hockydanhgia`
--
ALTER TABLE `hockydanhgia`
  MODIFY `maHocKyDanhGia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khoa`
--
ALTER TABLE `khoa`
  MODIFY `maKhoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `phieurenluyen`
--
ALTER TABLE `phieurenluyen`
  MODIFY `maPhieuRenLuyen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thamgiahoatdong`
--
ALTER TABLE `thamgiahoatdong`
  MODIFY `maThamGiaHoatDong` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thongbaodanhgia`
--
ALTER TABLE `thongbaodanhgia`
  MODIFY `maThongBao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tieuchicap1`
--
ALTER TABLE `tieuchicap1`
  MODIFY `matc1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tieuchicap2`
--
ALTER TABLE `tieuchicap2`
  MODIFY `matc2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `tieuchicap3`
--
ALTER TABLE `tieuchicap3`
  MODIFY `matc3` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `user_token`
--
ALTER TABLE `user_token`
  MODIFY `stt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

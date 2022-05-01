-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 01, 2022 lúc 07:23 PM
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
  `maTieuChi3` int(11) NOT NULL,
  `maSinhVien` int(11) NOT NULL,
  `diemSinhVienDanhGia` int(11) NOT NULL,
  `diemLopDanhGia` int(11) NOT NULL,
  `diemTrungBinhChungHKTruoc` double NOT NULL,
  `diemTrungBinhChungHKXet` double NOT NULL
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
('321', 'men', '0987654321', 'caf1a3dfb505ffed0d024130f58c5cfa', 'covanhoctap'),
('34234', 'Cố vấn 1', '3424', 'e10adc3949ba59abbe56e057f20f883e', 'covanhoctap'),
('GV321', 'men', '0987654321', 'caf1a3dfb505ffed0d024130f58c5cfa', 'covanhoctap');

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
  `tenLop` int(11) NOT NULL,
  `maKhoa` int(11) NOT NULL,
  `maCoVanHocTap` int(11) NOT NULL,
  `maKhoaHoc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieurenluyen`
--

CREATE TABLE `phieurenluyen` (
  `maPhieuRenLuyen` int(11) NOT NULL,
  `xepLoai` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diemTongCong` int(11) NOT NULL,
  `maSinhVien` int(11) NOT NULL,
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
  `diaChi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tieuchicap2`
--

CREATE TABLE `tieuchicap2` (
  `matc2` int(11) NOT NULL,
  `noidung` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `matc1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(29, '3118410262', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTE0MTk2MTAsIm5iZiI6MTY1MTQxOTYyMCwiZXhwIjoxNjUxNTA2MDEwLCJhdWQiOiJzaW5odmllbiIsInNpbmh2aWVuIjp7Im1hU2luaFZpZW4iOiIzMTE4NDEwMjYyIiwiaG9UZW5TaW5oVmllbiI6Ik5ndXlcdTFlYzVuIFRoXHUwMWIwXHUwMWExbmcgTVx1MWViZm4iLCJxdXllbiI6InNpbmh2aWVuIn19.Vgo5oWnbkjqsIaYWKR6gEFlPklOnwYm054hNva2dqmw', 'sinhvien', '2022-05-01 10:40:10', '2022-05-02 10:40:10');

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
-- AUTO_INCREMENT cho bảng `user_token`
--
ALTER TABLE `user_token`
  MODIFY `stt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

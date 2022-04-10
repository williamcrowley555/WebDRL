-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 10, 2022 lúc 12:17 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

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
  `matKhauTaiKhoanCoVan` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `covanhoctap`
--

INSERT INTO `covanhoctap` (`maCoVanHocTap`, `hoTenCoVan`, `soDienThoai`, `matKhauTaiKhoanCoVan`) VALUES
('321', 'men', '0987654321', 'caf1a3dfb505ffed0d024130f58c5cfa'),
('GV321', 'men', '0987654321', 'caf1a3dfb505ffed0d024130f58c5cfa');

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
  `matKhauKhoa` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khoa`
--

INSERT INTO `khoa` (`maKhoa`, `tenKhoa`, `taiKhoanKhoa`, `matKhauKhoa`) VALUES
(6, 'Công nghệ thông tinnn', 'cntt', '8e347e789002556f4b6043bbd2c0862f'),
(7, 'nghe thuat', 'nghethuat', '0fb7d766f7c97572770762946940ce9a');

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
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `maSinhVien` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `hoTenSinhVien` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngaySinh` date NOT NULL,
  `he` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `matKhauSinhVien` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maLop` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`maSinhVien`, `hoTenSinhVien`, `ngaySinh`, `he`, `matKhauSinhVien`, `maLop`) VALUES
('1234', 'phong', '2022-04-12', 'a', '202cb962ac59075b964b07152d234b70', '123'),
('3118410328', 'men', '2022-04-12', 'a', '202cb962ac59075b964b07152d234b70', '123');

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
  `id` varchar(11) NOT NULL,
  `token` text NOT NULL,
  `quyen` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

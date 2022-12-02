//HOST DOMAIN
const host_domain_url = "http://localhost/WebDRL";

const api_url = host_domain_url + "/api";

//const api_url = 'https://5674-115-73-162-67.ap.ngrok.io/WebDRL/api';

//---------------SINH VIEN---------------//----------------------------------
//---------//

//READ
const urlapi_sinhvien_read = api_url + "/sinhvien/read.php";
const urlapi_sinhvien_read_maKhoa = urlapi_sinhvien_read + "?maKhoa=";
const urlapi_sinhvien_read_maLop = urlapi_sinhvien_read + "?maLop=";
const urlapi_sinhvien_read_mssv = urlapi_sinhvien_read + "?mssv=";

//SINGLE READ//
const urlapi_sinhvien_single_read = api_url + "/sinhvien/single_read.php?mssv=";

//DETAILS READ
const urlapi_sinhvien_details_read =
  api_url + "/sinhvien/details_read.php?mssv=";

//CREATE//
const urlapi_sinhvien_create = api_url + "/sinhvien/create.php";

//UPDATE//
const urlapi_sinhvien_update = api_url + "/sinhvien/update.php";
const urlapi_sinhvien_update_matKhau = api_url + "/sinhvien/updateMatKhau.php";
const urlapi_sinhvien_update_taikhoan =
  api_url + "/sinhvien/updateTaiKhoan.php?maSinhVien=";
const urlapi_sinhvien_update_xettotnghiep =
  api_url + "/sinhvien/updateXetTotNghiep.php";

//---------------   DIEM TRUNG BINH HE 4    ---------------//----------------------------------
//---------//

//READ
const urlapi_diemtrungbinhhe4_read = api_url + "/diemtrungbinhhe4/read.php";

const urlapi_diemtrungbinhhe4_read_MaSV =
  urlapi_diemtrungbinhhe4_read + "?maSinhVien=";

  const urlapi_diemtrungbinhhe4_read_Lop =
  urlapi_diemtrungbinhhe4_read + "?maLop=";

//SINGLE READ//
const urlapi_diemtrungbinhhe4_single_read =
  api_url + "/diemtrungbinhhe4/single_read.php";

//CREATE//
const urlapi_diemtrungbinhhe4_create = api_url + "/diemtrungbinhhe4/create.php";

//UPDATE//
const urlapi_diemtrungbinhhe4_update = api_url + "/diemtrungbinhhe4/update.php";

//---------------   CVHT    ---------------//----------------------------------
//---------//

//READ
const urlapi_cvht_read = api_url + "/covanhoctap/read.php";
const urlapi_cvht_read_maKhoa = urlapi_cvht_read + "?maKhoa=";
// const urlapi_cvht_read_maLop = urlapi_cvht_read + "?maLop=";
const urlapi_cvht_read_maCVHT = urlapi_cvht_read + "?maCVHT=";

//SINGLE READ//
const urlapi_cvht_single_read =
  api_url + "/covanhoctap/single_read.php?maCoVanHocTap=";

//CREATE//
const urlapi_cvht_create = api_url + "/covanhoctap/create.php";

//UPDATE//
const urlapi_cvht_update = api_url + "/covanhoctap/update.php";
const urlapi_cvht_update_matKhau = api_url + "/covanhoctap/updateMatKhau.php";

//---------------KHOA---------------//----------------------------------
//---------//

//READ
const urlapi_khoa_read = api_url + "/khoa/read.php";
const urlapi_khoa_read_maKhoa = urlapi_khoa_read + "?maKhoa=";

//SINGLE READ//
const urlapi_khoa_single_read = api_url + "/khoa/single_read.php?maKhoa=";
const urlapi_khoa_single_read_taiKhoanKhoa =
  api_url + "/khoa/single_read.php?taiKhoanKhoa=";

//CREATE
const urlapi_khoa_create = api_url + "/khoa/create.php";

//UPDATE
const urlapi_khoa_update = api_url + "/khoa/update.php";

//---------------LOP---------------//----------------------------------
//---------//

//READ
const urlapi_lop_read = api_url + "/lop/read.php";
const urlapi_lop_read_maKhoa = urlapi_lop_read + "?maKhoa=";
const urlapi_lop_read_maCVHT = urlapi_lop_read + "?maCoVanHocTap=";
const urlapi_lop_read_maLop = urlapi_lop_read + "?maLop=";

//SINGLE READ
const urlapi_lop_single_read = api_url + "/lop/single_read.php?maLop=";

//DETAILS READ
const urlapi_lop_details_read = api_url + "/lop/details_read.php?maLop=";

//CREATE
const urlapi_lop_create = api_url + "/lop/create.php";

//UPDATE
const urlapi_lop_update = api_url + "/lop/update.php";

//---------------THONG BAO DANH GIA---------------//----------------------------------
//---------//

//READ
const urlapi_thongbaodanhgia_read = api_url + "/thongbaodanhgia/read.php";
const urlapi_thongbaodanhgia_read_maHKDG =
  api_url + "/thongbaodanhgia/read.php?maHKDG=";

//SINGLE READ (maHocKyDanhGia)
const urlapi_thongbaodanhgia_single_read_MaHKDG =
  api_url + "/thongbaodanhgia/single_read.php?maHocKyDanhGia=";

//SINGLE READ (maThongBao)
const urlapi_thongbaodanhgia_single_read_MaThongBao =
  api_url + "/thongbaodanhgia/single_read.php?maThongBao=";

//CREATE
const urlapi_thongbaodanhgia_create = api_url + "/thongbaodanhgia/create.php";

//UPDATE
const urlapi_thongbaodanhgia_update = api_url + "/thongbaodanhgia/update.php";

const urlapi_thongbaodanhgia_update_kichHoat =
  api_url + "/thongbaodanhgia/update_kichHoat.php";

//---------------HOC KY DANH GIA---------------//----------------------------------
//---------//

//READ
const urlapi_hockydanhgia_read = api_url + "/hockydanhgia/read.php";

//SINGLE READ
const urlapi_hockydanhgia_single_read =
  api_url + "/hockydanhgia/single_read.php?maHocKyDanhGia=";

//CREATE
const urlapi_hockydanhgia_create = api_url + "/hockydanhgia/create.php";

//UPDATE
const urlapi_hockydanhgia_update = api_url + "/hockydanhgia/update.php";

//---------------HOAT DONG DANH GIA---------------//----------------------------------
//---------//

//READ
const urlapi_hoatdongdanhgia_read = api_url + "/hoatdongdanhgia/read.php";
const urlapi_hoatdongdanhgia_read_maHD = urlapi_hoatdongdanhgia_read + "?maHD=";

//SINGLE READ
const urlapi_hoatdongdanhgia_single_read =
  api_url + "/hoatdongdanhgia/single_read.php?maHoatDong=";

//CREATE
const urlapi_hoatdongdanhgia_create = api_url + "/hoatdongdanhgia/create.php";

//UPDATE
const urlapi_hoatdongdanhgia_update = api_url + "/hoatdongdanhgia/update.php";

//---------------THAM GIA HOAT DONG---------------//----------------------------------
//---------//

//READ
const urlapi_thamgiahoatdong_read = api_url + "/thamgiahoatdong/read.php";
const urlapi_thamgiahoatdong_read_MaSV =
  urlapi_thamgiahoatdong_read + "?maSinhVienThamGia=";
const urlapi_thamgiahoatdong_read_MaHD =
  urlapi_thamgiahoatdong_read + "?maHoatDong=";

//SINGLE READ (maHoatDong & maSinhVienThamGia)
const urlapi_thamgiahoatdong_single_read =
  api_url + "/thamgiahoatdong/single_read.php?maHoatDong=";

//CREATE
const urlapi_thamgiahoatdong_create = api_url + "/thamgiahoatdong/create.php";

//---------------PHIEU REN LUYEN---------------//----------------------------------
//---------//

//READ
const urlapi_phieurenluyen_read = api_url + "/phieurenluyen/read.php";
const urlapi_phieurenluyen_read_MaPhieuRenLuyen =
  urlapi_phieurenluyen_read + "?maPhieuRenLuyen=";
const urlapi_phieurenluyen_read_MaLop = urlapi_phieurenluyen_read + "?maLop=";
const urlapi_phieurenluyen_read_MaSV =
  urlapi_phieurenluyen_read + "?maSinhVien=";

//SINGLE READ
const urlapi_phieurenluyen_single_read =
  api_url + "/phieurenluyen/single_read.php?maPhieuRenLuyen=";

//SINGLE READ (maHocKyDanhGia AND maSinhVien)
const urlapi_phieurenluyen_single_read_MaHKDG_MaSV =
  api_url + "/phieurenluyen/single_read.php?maHocKyDanhGia=";

//CREATE
const urlapi_phieurenluyen_create = api_url + "/phieurenluyen/create.php";

//UPDATE
const urlapi_phieurenluyen_update = api_url + "/phieurenluyen/update.php";

//---------------CHAM DIEM REN LUYEN---------------//----------------------------------
//---------//

//READ
const urlapi_chamdiemrenluyen_read = api_url + "/chamdiemrenluyen/read.php";
const urlapi_chamdiemrenluyen_read_maPhieuRenLuyen =
  urlapi_chamdiemrenluyen_read + "?maPhieuRenLuyen=";

//SINGLE READ (maPhieuRenLuyen AND maTieuChi2)
const urlapi_chamdiemrenluyen_single_read =
  api_url + "/chamdiemrenluyen/single_read.php";

//CREATE
const urlapi_chamdiemrenluyen_create = api_url + "/chamdiemrenluyen/create.php";

//CREATE
const urlapi_chamdiemrenluyen_update = api_url + "/chamdiemrenluyen/update.php";

//---------------CO VAN HOC TAP---------------//----------------------------------
//---------//

//READ
const urlapi_covanhoctap_read = api_url + "/covanhoctap/read.php";

//CREATE
const urlapi_covanhoctap_create = api_url + "/covanhoctap/create.php";

//SINGLE READ
const urlapi_covanhoctap_single_read =
  api_url + "/covanhoctap/single_read.php?maCoVanHocTap=";

//CREATE
const urlapi_covanhoctap_update = api_url + "/covanhoctap/update.php";

//---------------KHOA HOC---------------//----------------------------------
//---------//

//READ
const urlapi_khoahoc_read = api_url + "/khoahoc/read.php";

//SINGLE READ
const urlapi_khoahoc_single_read = api_url + "/khoahoc/single_read.php";

//CREATE
const urlapi_khoahoc_create = api_url + "/khoahoc/create.php";

//UPDATE
const urlapi_khoahoc_update = api_url + "/khoahoc/update.php";

//---------------TIEU CHI CAP 1---------------//----------------------------------
//---------//

//READ
const urlapi_tieuchicap1_read = api_url + "/tieuchicap1/read.php";
const urlapi_tieuchicap1_read_kichHoat = urlapi_tieuchicap1_read + "?kichHoat=";
const urlapi_tieuchicap1_read_matc2 = urlapi_tieuchicap1_read + "?matc2=";
const urlapi_tieuchicap1_read_matc3 = urlapi_tieuchicap1_read + "?matc3=";

//CREATE
const urlapi_tieuchicap1_create = api_url + "/tieuchicap1/create.php";

//UPDATE
const urlapi_tieuchicap1_update = api_url + "/tieuchicap1/update.php";
const urlapi_tieuchicap1_update_kichHoat =
  api_url + "/tieuchicap1/update_kichHoat.php";

//---------------TIEU CHI CAP 2---------------//----------------------------------
//---------//

//READ
const urlapi_tieuchicap2_read = api_url + "/tieuchicap2/read.php";
const urlapi_tieuchicap2_read_kichHoat = urlapi_tieuchicap2_read + "?kichHoat=";
const urlapi_tieuchicap2_read_matc3 = urlapi_tieuchicap2_read + "?matc3=";

//SINGLE READ
const urlapi_tieuchicap2_single_read =
  api_url + "/tieuchicap2/single_read.php?matc2=";

//CREATE
const urlapi_tieuchicap2_create = api_url + "/tieuchicap2/create.php";

//UPDATE
const urlapi_tieuchicap2_update = api_url + "/tieuchicap2/update.php";
const urlapi_tieuchicap2_update_kichHoat =
  api_url + "/tieuchicap2/update_kichHoat.php";

//---------------TIEU CHI CAP 3---------------//----------------------------------
//---------//

//READ
const urlapi_tieuchicap3_read = api_url + "/tieuchicap3/read.php";
const urlapi_tieuchicap3_read_kichHoat = urlapi_tieuchicap3_read + "?kichHoat=";

//SINGLE READ
const urlapi_tieuchicap3_single_read =
  api_url + "/tieuchicap3/single_read.php?matc3=";

//CREATE
const urlapi_tieuchicap3_create = api_url + "/tieuchicap3/create.php";

//UPDATE
const urlapi_tieuchicap3_update = api_url + "/tieuchicap3/update.php";
const urlapi_tieuchicap3_update_kichHoat =
  api_url + "/tieuchicap3/update_kichHoat.php";

//---------------THONG KE---------------//----------------------------------
//---------//

//READ
const urlapi_thongkelop_read = api_url + "/thongkelop/read.php";
const urlapi_thongkesinhvien_read = api_url + "/thongkesinhvien/read.php";

//---------------KHIEU NAI---------------//----------------------------------
//---------//

//READ
const urlapi_khieunai_read = api_url + "/khieunai/read.php";
const urlapi_khieunai_read_maSinhVien = urlapi_khieunai_read + "?maSinhVien=";

//SINGLE READ
const urlapi_khieunai_single_read = api_url + "/khieunai/single_read.php";

//SINGLE DETAILS READ
const urlapi_khieunai_single_details_read =
  api_url + "/khieunai/single_details_read.php";

//CREATE
const urlapi_khieunai_create = api_url + "/khieunai/create.php";

//UPDATE
const urlapi_khieunai_update_trangThai =
  api_url + "/khieunai/update_trangThai.php";

//---------------ADMIN---------------//----------------------------------
//---------//

//READ
const urlapi_admin_read = api_url + "/admin/read.php";
const urlapi_admin_read_searchText = urlapi_admin_read + "?searchText=";

//SINGLE READ
const urlapi_admin_single_read = api_url + "/admin/single_read.php?id=";

//SINGLE DETAILS READ
//const urlapi_khieunai_single_details_read =
//api_url + "/khieunai/single_details_read.php";

//CREATE
const urlapi_admin_create = api_url + "/admin/create.php";

//UPDATE
const urlapi_admin_update = api_url + "/admin/update.php";
const urlapi_admin_update_matkhau = api_url + "/admin/updateMatKhau.php";
const urlapi_admin_update_kichhoat = api_url + "/admin/updateKichHoat.php";
const urlapi_admin_update_vohieuhoa = api_url + "/admin/updateVoHieuHoa.php";

//---------------CONG TAC SINH VIEN---------------//----------------------------------
//---------//

//READ
const urlapi_ctsv_read = api_url + "/phongcongtacsinhvien/read.php";
const urlapi_ctsv_read_searchText = urlapi_ctsv_read + "?searchText=";
//const urlapi_khieunai_read_maSinhVien = urlapi_khieunai_read + "?maSinhVien=";

//SINGLE READ
const urlapi_ctsv_single_read =
  api_url + "/phongcongtacsinhvien/single_read.php?taiKhoan=";

//SINGLE DETAILS READ
//const urlapi_khieunai_single_details_read =
//api_url + "/khieunai/single_details_read.php";

//CREATE
const urlapi_ctsv_create = api_url + "/phongcongtacsinhvien/create.php";

//UPDATE
const urlapi_ctsv_update = api_url + "/phongcongtacsinhvien/update.php";
const urlapi_ctsv_update_matkhau =
  api_url + "/phongcongtacsinhvien/updateMatKhau.php";
const urlapi_ctsv_update_kichhoat =
  api_url + "/phongcongtacsinhvien/updateKichHoat.php";
const urlapi_ctsv_update_vohieuhoa =
  api_url + "/phongcongtacsinhvien/updateVoHieuHoa.php";

//---------------LOGIN ADMIN---------------//----------------------------------
//---------//

//LOGIN
const urlapi_login_admin = api_url + "/auth/login_admin.php";

//---------------LOGIN CLIENT---------------//----------------------------------
//---------//

//LOGIN
const urlapi_login_client = api_url + "/auth/login.php";

//LOGOUT
const urlapi_logout_client = api_url + "/auth/logout.php";

//--------------- TOKEN --------------//----------------------------------
//---------//

//DELETE
const urlapi_token_delete = api_url + "/token/delete.php";

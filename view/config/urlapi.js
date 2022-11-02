//HOST DOMAIN
const host_domain_url = "http://localhost/WebDRL/api";

//const host_domain_url = 'https://5674-115-73-162-67.ap.ngrok.io/WebDRL/api';

//---------------SINH VIEN---------------//----------------------------------
//---------//

//READ
const urlapi_sinhvien_read = host_domain_url + "/sinhvien/read.php";
const urlapi_sinhvien_read_maKhoa = urlapi_sinhvien_read + "?maKhoa=";
const urlapi_sinhvien_read_maLop = urlapi_sinhvien_read + "?maLop=";
const urlapi_sinhvien_read_mssv = urlapi_sinhvien_read + "?mssv=";

//SINGLE READ//
const urlapi_sinhvien_single_read =
  host_domain_url + "/sinhvien/single_read.php?mssv=";

//DETAILS READ
const urlapi_sinhvien_details_read =
  host_domain_url + "/sinhvien/details_read.php?mssv=";

//CREATE//
const urlapi_sinhvien_create = host_domain_url + "/sinhvien/create.php";

//UPDATE//
const urlapi_sinhvien_update = host_domain_url + "/sinhvien/update.php";
const urlapi_sinhvien_update_matKhau =
  host_domain_url + "/sinhvien/updateMatKhau.php";
const urlapi_sinhvien_update_taikhoan =
  host_domain_url + "/sinhvien/updateTaiKhoan.php?maSinhVien=";

//---------------   DIEM TRUNG BINH HE 4    ---------------//----------------------------------
//---------//

//READ
const urlapi_diemtrungbinhhe4_read =
  host_domain_url + "/diemtrungbinhhe4/read.php";

const urlapi_diemtrungbinhhe4_read_MaSV =
  urlapi_diemtrungbinhhe4_read + "?maSinhVien=";

//SINGLE READ//
const urlapi_diemtrungbinhhe4_single_read =
  host_domain_url + "/diemtrungbinhhe4/single_read.php";

//CREATE//
const urlapi_diemtrungbinhhe4_create =
  host_domain_url + "/diemtrungbinhhe4/create.php";

//UPDATE//
const urlapi_diemtrungbinhhe4_update =
  host_domain_url + "/diemtrungbinhhe4/update.php";

//---------------   CVHT    ---------------//----------------------------------
//---------//

//READ
const urlapi_cvht_read = host_domain_url + "/covanhoctap/read.php";
const urlapi_cvht_read_maKhoa = urlapi_cvht_read + "?maKhoa=";
// const urlapi_cvht_read_maLop = urlapi_cvht_read + "?maLop=";
const urlapi_cvht_read_maCVHT = urlapi_cvht_read + "?maCVHT=";

//SINGLE READ//
const urlapi_cvht_single_read =
  host_domain_url + "/covanhoctap/single_read.php?maCoVanHocTap=";

//CREATE//
const urlapi_cvht_create = host_domain_url + "/covanhoctap/create.php";

//UPDATE//
const urlapi_cvht_update = host_domain_url + "/covanhoctap/update.php";

//---------------KHOA---------------//----------------------------------
//---------//

//READ
const urlapi_khoa_read = host_domain_url + "/khoa/read.php";
const urlapi_khoa_read_maKhoa = urlapi_khoa_read + "?maKhoa=";

//SINGLE READ//
const urlapi_khoa_single_read =
  host_domain_url + "/khoa/single_read.php?maKhoa=";

//CREATE
const urlapi_khoa_create = host_domain_url + "/khoa/create.php";

//UPDATE
const urlapi_khoa_update = host_domain_url + "/khoa/update.php";

//---------------LOP---------------//----------------------------------
//---------//

//READ
const urlapi_lop_read = host_domain_url + "/lop/read.php";
const urlapi_lop_read_maKhoa = urlapi_lop_read + "?maKhoa=";
const urlapi_lop_read_maCVHT = urlapi_lop_read + "?maCoVanHocTap=";
const urlapi_lop_read_maLop = urlapi_lop_read + "?maLop=";

//SINGLE READ
const urlapi_lop_single_read = host_domain_url + "/lop/single_read.php?maLop=";

//DETAILS READ
const urlapi_lop_details_read =
  host_domain_url + "/lop/details_read.php?maLop=";

//CREATE
const urlapi_lop_create = host_domain_url + "/lop/create.php";

//UPDATE
const urlapi_lop_update = host_domain_url + "/lop/update.php";

//---------------THONG BAO DANH GIA---------------//----------------------------------
//---------//

//READ
const urlapi_thongbaodanhgia_read =
  host_domain_url + "/thongbaodanhgia/read.php";

//SINGLE READ (maHocKyDanhGia)
const urlapi_thongbaodanhgia_single_read_MaHKDG =
  host_domain_url + "/thongbaodanhgia/single_read.php?maHocKyDanhGia=";

//SINGLE READ (maThongBao)
const urlapi_thongbaodanhgia_single_read_MaThongBao =
  host_domain_url + "/thongbaodanhgia/single_read.php?maThongBao=";

//CREATE
const urlapi_thongbaodanhgia_create =
  host_domain_url + "/thongbaodanhgia/create.php";

//UPDATE
const urlapi_thongbaodanhgia_update =
  host_domain_url + "/thongbaodanhgia/update.php";

const urlapi_thongbaodanhgia_update_kichHoat =
  host_domain_url + "/thongbaodanhgia/update_kichHoat.php";

//---------------HOC KY DANH GIA---------------//----------------------------------
//---------//

//READ
const urlapi_hockydanhgia_read = host_domain_url + "/hockydanhgia/read.php";

//SINGLE READ
const urlapi_hockydanhgia_single_read =
  host_domain_url + "/hockydanhgia/single_read.php?maHocKyDanhGia=";

//CREATE
const urlapi_hockydanhgia_create = host_domain_url + "/hockydanhgia/create.php";

//UPDATE
const urlapi_hockydanhgia_update = host_domain_url + "/hockydanhgia/update.php";

//---------------HOAT DONG DANH GIA---------------//----------------------------------
//---------//

//READ
const urlapi_hoatdongdanhgia_read =
  host_domain_url + "/hoatdongdanhgia/read.php";
const urlapi_hoatdongdanhgia_read_maHD = urlapi_hoatdongdanhgia_read + "?maHD=";

//SINGLE READ
const urlapi_hoatdongdanhgia_single_read =
  host_domain_url + "/hoatdongdanhgia/single_read.php?maHoatDong=";

//CREATE
const urlapi_hoatdongdanhgia_create =
  host_domain_url + "/hoatdongdanhgia/create.php";

//UPDATE
const urlapi_hoatdongdanhgia_update =
  host_domain_url + "/hoatdongdanhgia/update.php";

//---------------THAM GIA HOAT DONG---------------//----------------------------------
//---------//

//READ
const urlapi_thamgiahoatdong_read =
  host_domain_url + "/thamgiahoatdong/read.php";
const urlapi_thamgiahoatdong_read_MaSV =
  urlapi_thamgiahoatdong_read + "?maSinhVienThamGia=";
const urlapi_thamgiahoatdong_read_MaHD =
  urlapi_thamgiahoatdong_read + "?maHoatDong=";

//SINGLE READ (maHoatDong & maSinhVienThamGia)
const urlapi_thamgiahoatdong_single_read =
  host_domain_url + "/thamgiahoatdong/single_read.php?maHoatDong=";

//CREATE
const urlapi_thamgiahoatdong_create =
  host_domain_url + "/thamgiahoatdong/create.php";

//---------------PHIEU REN LUYEN---------------//----------------------------------
//---------//

//READ
const urlapi_phieurenluyen_read = host_domain_url + "/phieurenluyen/read.php";
const urlapi_phieurenluyen_read_MaPhieuRenLuyen =
  urlapi_phieurenluyen_read + "?maPhieuRenLuyen=";
const urlapi_phieurenluyen_read_MaLop = urlapi_phieurenluyen_read + "?maLop=";
const urlapi_phieurenluyen_read_MaSV =
  urlapi_phieurenluyen_read + "?maSinhVien=";

//SINGLE READ
const urlapi_phieurenluyen_single_read =
  host_domain_url + "/phieurenluyen/single_read.php?maPhieuRenLuyen=";

//SINGLE READ (maHocKyDanhGia AND maSinhVien)
const urlapi_phieurenluyen_single_read_MaHKDG_MaSV =
  host_domain_url + "/phieurenluyen/single_read.php?maHocKyDanhGia=";

//CREATE
const urlapi_phieurenluyen_create =
  host_domain_url + "/phieurenluyen/create.php";

//UPDATE
const urlapi_phieurenluyen_update =
  host_domain_url + "/phieurenluyen/update.php";

//---------------CHAM DIEM REN LUYEN---------------//----------------------------------
//---------//

//READ
const urlapi_chamdiemrenluyen_read =
  host_domain_url + "/chamdiemrenluyen/read.php";
const urlapi_chamdiemrenluyen_read_maPhieuRenLuyen =
  urlapi_chamdiemrenluyen_read + "?maPhieuRenLuyen=";

//SINGLE READ (maPhieuRenLuyen AND maTieuChi2)
const urlapi_chamdiemrenluyen_single_read =
  host_domain_url + "/chamdiemrenluyen/single_read.php";

//CREATE
const urlapi_chamdiemrenluyen_create =
  host_domain_url + "/chamdiemrenluyen/create.php";

//CREATE
const urlapi_chamdiemrenluyen_update =
  host_domain_url + "/chamdiemrenluyen/update.php";

//---------------CO VAN HOC TAP---------------//----------------------------------
//---------//

//READ
const urlapi_covanhoctap_read = host_domain_url + "/covanhoctap/read.php";

//CREATE
const urlapi_covanhoctap_create = host_domain_url + "/covanhoctap/create.php";

//SINGLE READ
const urlapi_covanhoctap_single_read =
  host_domain_url + "/covanhoctap/single_read.php?maCoVanHocTap=";

//CREATE
const urlapi_covanhoctap_update = host_domain_url + "/covanhoctap/update.php";

//---------------KHOA HOC---------------//----------------------------------
//---------//

//READ
const urlapi_khoahoc_read = host_domain_url + "/khoahoc/read.php";

//SINGLE READ
const urlapi_khoahoc_single_read = host_domain_url + "/khoahoc/single_read.php";

//CREATE
const urlapi_khoahoc_create = host_domain_url + "/khoahoc/create.php";

//UPDATE
const urlapi_khoahoc_update = host_domain_url + "/khoahoc/update.php";

//---------------TIEU CHI CAP 1---------------//----------------------------------
//---------//

//READ
const urlapi_tieuchicap1_read = host_domain_url + "/tieuchicap1/read.php";
const urlapi_tieuchicap1_read_kichHoat = urlapi_tieuchicap1_read + "?kichHoat=";
const urlapi_tieuchicap1_read_matc2 = urlapi_tieuchicap1_read + "?matc2=";
const urlapi_tieuchicap1_read_matc3 = urlapi_tieuchicap1_read + "?matc3=";

//CREATE
const urlapi_tieuchicap1_create = host_domain_url + "/tieuchicap1/create.php";

//UPDATE
const urlapi_tieuchicap1_update = host_domain_url + "/tieuchicap1/update.php";
const urlapi_tieuchicap1_update_kichHoat =
  host_domain_url + "/tieuchicap1/update_kichHoat.php";

//---------------TIEU CHI CAP 2---------------//----------------------------------
//---------//

//READ
const urlapi_tieuchicap2_read = host_domain_url + "/tieuchicap2/read.php";
const urlapi_tieuchicap2_read_kichHoat = urlapi_tieuchicap2_read + "?kichHoat=";
const urlapi_tieuchicap2_read_matc3 = urlapi_tieuchicap2_read + "?matc3=";

//SINGLE READ
const urlapi_tieuchicap2_single_read =
  host_domain_url + "/tieuchicap2/single_read.php?matc2=";

//CREATE
const urlapi_tieuchicap2_create = host_domain_url + "/tieuchicap2/create.php";

//UPDATE
const urlapi_tieuchicap2_update = host_domain_url + "/tieuchicap2/update.php";
const urlapi_tieuchicap2_update_kichHoat =
  host_domain_url + "/tieuchicap2/update_kichHoat.php";

//---------------TIEU CHI CAP 3---------------//----------------------------------
//---------//

//READ
const urlapi_tieuchicap3_read = host_domain_url + "/tieuchicap3/read.php";
const urlapi_tieuchicap3_read_kichHoat = urlapi_tieuchicap3_read + "?kichHoat=";

//SINGLE READ
const urlapi_tieuchicap3_single_read =
  host_domain_url + "/tieuchicap3/single_read.php?matc3=";

//CREATE
const urlapi_tieuchicap3_create = host_domain_url + "/tieuchicap3/create.php";

//UPDATE
const urlapi_tieuchicap3_update = host_domain_url + "/tieuchicap3/update.php";
const urlapi_tieuchicap3_update_kichHoat =
  host_domain_url + "/tieuchicap3/update_kichHoat.php";

//---------------THONG KE---------------//----------------------------------
//---------//

//READ
const urlapi_thongkelop_read = host_domain_url + "/thongkelop/read.php";
const urlapi_thongkesinhvien_read =
  host_domain_url + "/thongkesinhvien/read.php";

//---------------LOGIN ADMIN---------------//----------------------------------
//---------//

//LOGIN
const urlapi_login_admin = host_domain_url + "/auth/login_admin.php";

//---------------LOGIN CLIENT---------------//----------------------------------
//---------//

//LOGIN
const urlapi_login_client = host_domain_url + "/auth/login.php";

//LOGOUT
const urlapi_logout_client = host_domain_url + "/auth/logout.php";

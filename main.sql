-- Cơ sở dữ liệu: KhachSan_NhaHang
CREATE DATABASE qlks;
USE qlks;

-- Bảng: NguoiDung
CREATE TABLE NguoiDung (
    ma_nguoi_dung INT AUTO_INCREMENT PRIMARY KEY,
    ten_dang_nhap VARCHAR(50) NOT NULL UNIQUE,
    mat_khau VARCHAR(255) NOT NULL,
    so_dien_thoai VARCHAR(15),
    vai_tro ENUM('khach_hang', 'nhan_vien', 'quan_tri') DEFAULT 'khach_hang',
    ngay_tao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE KhachSan (
    ma_khach_san INT AUTO_INCREMENT PRIMARY KEY,
    ten VARCHAR(100) NOT NULL,
    dia_chi TEXT NOT NULL,
    so_dien_thoai VARCHAR(15),
    email VARCHAR(100),
    mo_ta TEXT,
    ngay_tao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng: Phong
CREATE TABLE Phong (
    ma_phong INT AUTO_INCREMENT PRIMARY KEY,
    ma_khach_san INT NOT NULL,
    so_phong VARCHAR(10) NOT NULL,
    loai ENUM('don', 'doi') NOT NULL,
    gia DECIMAL(10, 2) NOT NULL,
    trang_thai ENUM('san_sang', 'da_dat', 'bao_tri') DEFAULT 'san_sang',
    FOREIGN KEY (ma_khach_san) REFERENCES KhachSan(ma_khach_san) ON DELETE CASCADE
);

-- Bảng: DatPhong
CREATE TABLE DatPhong (
    ma_dat_phong INT AUTO_INCREMENT PRIMARY KEY,
    ma_nguoi_dung INT NOT NULL,
    ma_phong INT NOT NULL,
    ngay_nhan_phong DATE NOT NULL,
    ngay_tra_phong DATE NOT NULL,
    tong_tien DECIMAL(10, 2) NOT NULL,
    trang_thai ENUM('cho_xu_ly', 'da_xac_nhan', 'da_huy') DEFAULT 'cho_xu_ly',
    ngay_tao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ma_nguoi_dung) REFERENCES NguoiDung(ma_nguoi_dung) ON DELETE CASCADE,
    FOREIGN KEY (ma_phong) REFERENCES Phong(ma_phong) ON DELETE CASCADE
);

-- Bảng: NhaHang
CREATE TABLE NhaHang (
    ma_nha_hang INT AUTO_INCREMENT PRIMARY KEY,
    ma_khach_san INT NOT NULL,
    ten VARCHAR(100) NOT NULL,
    mo_ta TEXT,
    so_dien_thoai VARCHAR(15),
    FOREIGN KEY (ma_khach_san) REFERENCES KhachSan(ma_khach_san) ON DELETE CASCADE
);

-- Bảng: ThucDon
CREATE TABLE ThucDon (
    ma_thuc_don INT AUTO_INCREMENT PRIMARY KEY,
    ma_nha_hang INT NOT NULL,
    ten VARCHAR(100) NOT NULL,
    mo_ta TEXT,
    FOREIGN KEY (ma_nha_hang) REFERENCES NhaHang(ma_nha_hang) ON DELETE CASCADE
);

-- Bảng: MonAn
CREATE TABLE MonAn (
    ma_mon_an INT AUTO_INCREMENT PRIMARY KEY,
    ma_thuc_don INT NOT NULL,
    ten VARCHAR(100) NOT NULL,
    mo_ta TEXT,
    gia DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (ma_thuc_don) REFERENCES ThucDon(ma_thuc_don) ON DELETE CASCADE
);
-- insert data nek
INSERT INTO NguoiDung (ten_dang_nhap, mat_khau, so_dien_thoai, vai_tro)
VALUES
    ('john_doe', 'password123', '0123456789', 'khach_hang'),
    ('jane_smith', 'mypassword456', '0123456798', 'nhan_vien'),
    ('admin', 'adminpassword789', '0987654321', 'quan_tri');
INSERT INTO KhachSan (ten, dia_chi, so_dien_thoai, email, mo_ta)
VALUES
    ('Khach San A', '123 Pho X, Thanh Pho A', '0901122334', 'contact@khachsana.com', 'Khách sạn 5 sao sang trọng với đầy đủ tiện nghi'),
    ('Khach San B', '456 Duong Y, Thanh Pho B', '0902233445', 'info@khachsanb.com', 'Khách sạn cao cấp, phòng đẹp, dịch vụ hoàn hảo');
INSERT INTO Phong (ma_khach_san, so_phong, loai, gia, trang_thai)
VALUES
    (1, '101', 'don', 5000000, 'san_sang'),
    (1, '102', 'doi', 1000000, 'da_dat'),
    (2, '201', 'don', 600000, 'san_sang'),
    (2, '202', 'doi', 1200000, 'bao_tri');
INSERT INTO DatPhong (ma_nguoi_dung, ma_phong, ngay_nhan_phong, ngay_tra_phong, tong_tien, trang_thai)
VALUES
    (1, 1, '2024-12-20', '2024-12-22', 100.00, 'da_xac_nhan'),
    (2, 3, '2024-12-21', '2024-12-23', 120.00, 'cho_xu_ly');
INSERT INTO NhaHang (ma_khach_san, ten, mo_ta, so_dien_thoai)
VALUES
    (1, 'Nha Hang A', 'Nhà hàng phục vụ các món ăn Âu và Á', '0909876543'),
    (2, 'Nha Hang B', 'Nhà hàng với các món đặc sản địa phương', '0912345678');
INSERT INTO ThucDon (ma_nha_hang, ten, mo_ta)
VALUES
    (1, 'Thuc Don A', 'Thực đơn với các món ăn Âu và Á đa dạng'),
    (2, 'Thuc Don B', 'Thực đơn đặc biệt với các món ăn địa phương');
INSERT INTO MonAn (ma_thuc_don, ten, mo_ta, gia)
VALUES
    (1, 'Spaghetti Bolognese', 'Mì Ý với sốt thịt bò Bolognese', 120000),
    (1, 'Grilled Chicken', 'Gà nướng kiểu Âu', 150000),
    (2, 'Pho Bo', 'Phở bò truyền thống Việt Nam', 80000),
    (2, 'Banh Xeo', 'Bánh xèo đặc sản miền Nam', 70000);
-- truy van bang 
SELECT * FROM NguoiDung;
SELECT * FROM KhachSan;
SELECT * FROM Phong ;-- WHERE ma_khach_san = 1;
SELECT * FROM DatPhong;
SELECT * FROM NhaHang;
SELECT * FROM ThucDon;
SELECT * FROM MonAn;    
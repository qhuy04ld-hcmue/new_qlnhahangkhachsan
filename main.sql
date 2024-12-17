CREATE DATABASE QLKS
GO
USE QLKS
CREATE TABLE Users (
    UserID INT IDENTITY(1,1) PRIMARY KEY,     -- Mã người dùng tự động tăng
    Username NVARCHAR(50) NOT NULL,            -- Tên đăng nhập
    Password NVARCHAR(255) NOT NULL,           -- Mật khẩu
    UserType NVARCHAR(50) NOT NULL,            -- Phân loại người dùng (Ví dụ: admin, member)
    CONSTRAINT UQ_Username UNIQUE (Username)   -- Đảm bảo tên đăng nhập là duy nhất
);

-- Chèn dữ liệu mẫu vào bảng Users
INSERT INTO Users (Username, Password, UserType)
VALUES
    ('admin', 'admin123', 'admin'),
    ('john_doe', 'password123', 'user'),
    ('alice_smith', 'password456', 'user'),
    ('bob_jones', 'securepass789', 'user'),
    ('charlie_brown', 'mypassword', 'admin');
GO
SELECT * FROM dbo.Users
GO
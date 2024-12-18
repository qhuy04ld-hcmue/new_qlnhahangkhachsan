<?php
// Kết nối MySQL
$servername = "localhost"; // Tên máy chủ MySQL
$username = "root"; // Tên đăng nhập MySQL
$password = "12345"; // Mật khẩu MySQL
$dbname = "qlks"; // Tên cơ sở dữ liệu

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu form đã được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu người dùng nhập vào
    $user = $_POST["username"];
    $pass = $_POST["password"];

    // Truy vấn xác thực người dùng từ bảng NguoiDung
    $sql = "SELECT * FROM NguoiDung WHERE ten_dang_nhap = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra nếu có người dùng
    if ($result->num_rows > 0) {
        // Lấy dữ liệu người dùng từ cơ sở dữ liệu
        $row = $result->fetch_assoc();

        // Kiểm tra mật khẩu người dùng (so sánh trực tiếp, nên sử dụng password_verify nếu mật khẩu được mã hóa)
        if ($pass === $row['mat_khau']) {
            // Kiểm tra vai trò và chuyển hướng
            if ($row['vai_tro'] === 'quan_tri') {
                header("Location: form_admin.html");
            } elseif ($row['vai_tro'] === 'khach_hang') {
                header("Location: form_user.html");
            } else {
                $error = "Vai trò không hợp lệ!";
            }
            exit();
        } else {
            $error = "Mật khẩu không đúng!";
        }
    } else {
        $error = "Tên đăng nhập không tồn tại!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
        }

        .login-box {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="login-box">
            <h2>Đăng Nhập</h2>

            <!-- Form đăng nhập -->
            <form action="login.php" method="POST">
                <input type="text" name="username" placeholder="Tên đăng nhập" required>
                <input type="password" name="password" placeholder="Mật khẩu" required>
                <button type="submit">Đăng Nhập</button>
            </form>

            <!-- Hiển thị thông báo lỗi nếu có -->
            <?php if (isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>

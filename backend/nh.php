<?php
// Thiết lập kết nối MySQL
$servername = "localhost"; // Thay đổi nếu bạn đang sử dụng máy chủ khác
$username = "root"; // Tên đăng nhập MySQL
$password = "12345"; // Mật khẩu MySQL
$dbname = "qlks"; // Tên cơ sở dữ liệu

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lấy dữ liệu từ bảng NhaHang
$sql = "SELECT ten, so_dien_thoai, mo_ta FROM NhaHang";
$result = $conn->query($sql);

// Kiểm tra kết quả truy vấn
if ($result === false) {
    die("Error: " . $conn->error); // Hiển thị lỗi nếu truy vấn không thành công
}

if ($result->num_rows > 0) {
    // Dữ liệu trả về
    while($row = $result->fetch_assoc()) {
        $restaurants[] = $row;
    }
} else {
    $restaurants = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Nhà Hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 50px;
        }

        table {
            width: 80%;
            margin: 50px auto;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Danh Sách Nhà Hàng</h1>
        <?php if (count($restaurants) > 0): ?>
            <table>
                <tr>
                    <th>Tên Nhà Hàng</th>
                    <th>Số Điện Thoại</th>
                    <th>Mô Tả</th>
                </tr>
                <?php foreach ($restaurants as $restaurant): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($restaurant['ten']); ?></td>
                        <td><?php echo htmlspecialchars($restaurant['so_dien_thoai']); ?></td>
                        <td><?php echo htmlspecialchars($restaurant['mo_ta']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Không có nhà hàng nào được tìm thấy.</p>
        <?php endif; ?>
    </div>
</body>
</html>

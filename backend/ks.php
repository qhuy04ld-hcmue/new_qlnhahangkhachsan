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

// Lấy dữ liệu từ bảng KhachSan
$sql = "SELECT ten, dia_chi, so_dien_thoai, email, mo_ta FROM KhachSan";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Dữ liệu trả về
    while($row = $result->fetch_assoc()) {
        $hotels[] = $row;
    }
} else {
    $hotels = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Khách Sạn</title>
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
        <h1>Danh Sách Khách Sạn</h1>
        <?php if (count($hotels) > 0): ?>
            <table>
                <tr>
                    <th>Tên Khách Sạn</th>
                    <th>Địa Chỉ</th>
                    <th>Số Điện Thoại</th>
                    <th>Email</th>
                    <th>Mô Tả</th>
                </tr>
                <?php foreach ($hotels as $hotel): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($hotel['ten']); ?></td>
                        <td><?php echo htmlspecialchars($hotel['dia_chi']); ?></td>
                        <td><?php echo htmlspecialchars($hotel['so_dien_thoai']); ?></td>
                        <td><?php echo htmlspecialchars($hotel['email']); ?></td>
                        <td><?php echo htmlspecialchars($hotel['mo_ta']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Không có khách sạn nào được tìm thấy.</p>
        <?php endif; ?>
    </div>
</body>
</html>

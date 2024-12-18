<?php
$conn = new mysqli('localhost', 'root', '12345', 'qlks');
if ($conn->connect_error) die("Kết nối thất bại: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten_dang_nhap = $_POST['ten_dang_nhap'];
    $mat_khau = $_POST['mat_khau'];
    $so_dien_thoai = $_POST['so_dien_thoai'];
    $vai_tro = $_POST['vai_tro'];

    $sql = "INSERT INTO NguoiDung (ten_dang_nhap, mat_khau, so_dien_thoai, vai_tro) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $ten_dang_nhap, $mat_khau, $so_dien_thoai, $vai_tro);
    if ($stmt->execute()) {
        echo "Thêm người dùng thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
}
?>

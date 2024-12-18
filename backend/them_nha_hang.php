<?php
$conn = new mysqli('localhost', 'root', '12345', 'qlks');
if ($conn->connect_error) die("Kết nối thất bại: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten = $_POST['ten'];
    $ma_khach_san = $_POST['ma_khach_san'];
    $mo_ta = $_POST['mo_ta'];
    $so_dien_thoai = $_POST['so_dien_thoai'];

    $sql = "INSERT INTO NhaHang (ten, ma_khach_san, mo_ta, so_dien_thoai) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siss", $ten, $ma_khach_san, $mo_ta, $so_dien_thoai);
    if ($stmt->execute()) {
        echo "Thêm nhà hàng thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
}
?>

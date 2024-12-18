<?php
$conn = new mysqli('localhost', 'root', '12345', 'qlks');
if ($conn->connect_error) die("Kết nối thất bại: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten = $_POST['ten'];
    $ma_thuc_don = $_POST['ma_thuc_don'];
    $mo_ta = $_POST['mo_ta'];
    $gia = $_POST['gia'];

    $sql = "INSERT INTO MonAn (ten, ma_thuc_don, mo_ta, gia) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisd", $ten, $ma_thuc_don, $mo_ta, $gia);
    if ($stmt->execute()) {
        echo "Thêm món ăn thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
}
?>

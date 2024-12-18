<?php
$conn = new mysqli('localhost', 'root', '12345', 'qlks');
if ($conn->connect_error) die("Kết nối thất bại: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten = $_POST['ten'];
    $dia_chi = $_POST['dia_chi'];
    $so_dien_thoai = $_POST['so_dien_thoai'];
    $email = $_POST['email'];
    $mo_ta = $_POST['mo_ta'];

    $sql = "INSERT INTO KhachSan (ten, dia_chi, so_dien_thoai, email, mo_ta) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $ten, $dia_chi, $so_dien_thoai, $email, $mo_ta);
    if ($stmt->execute()) {
        echo "Thêm khách sạn thành công.";
    } else {
        echo "Lỗi: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
}
?>

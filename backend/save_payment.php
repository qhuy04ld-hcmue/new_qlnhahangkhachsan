<?php
// save_payment.php
$data = json_decode(file_get_contents('php://input'), true);
$totalAmount = $data['totalAmount'];

// Lưu vào file
file_put_contents('payment.txt', "Total Payment: $totalAmount VND\n", FILE_APPEND);

// Trả về kết quả
echo json_encode(['status' => 'success']);
?>

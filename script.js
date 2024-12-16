// Mảng lưu thông tin phòng đã đặt
let bookedRooms = [];

// Xử lý nút "Đặt phòng"
document.querySelectorAll('.bookBtn').forEach((btn, index) => {
    btn.addEventListener('click', () => {
        let roomName = btn.previousElementSibling.previousElementSibling.textContent;
        let roomPrice = parseInt(btn.previousElementSibling.textContent.replace(/\D/g, ''));
        
        bookedRooms.push({ name: roomName, price: roomPrice });
        alert(`Đã đặt phòng: ${roomName}`);
        updateTotalPrice();
    });
});

// Cập nhật tổng tiền
function updateTotalPrice() {
    let total = bookedRooms.reduce((sum, room) => sum + room.price, 0);
    document.getElementById('totalPrice').textContent = `Tổng Tiền: ${total} VND`;
}

// Xử lý thanh toán
document.getElementById('payNowBtn').addEventListener('click', () => {
    if (bookedRooms.length > 0) {
        alert("Thanh toán thành công!");
        bookedRooms = [];  // Reset danh sách phòng đã đặt
        updateTotalPrice();
    } else {
        alert("Chưa có phòng nào được đặt.");
    }
});

// Xử lý tìm kiếm phòng
document.getElementById('search').addEventListener('input', (e) => {
    let query = e.target.value.toLowerCase();
    let rooms = document.querySelectorAll('.room-card');
    rooms.forEach(room => {
        let roomName = room.querySelector('h3').textContent.toLowerCase();
        if (roomName.includes(query)) {
            room.style.display = 'block';
        } else {
            room.style.display = 'none';
        }
    });
});

// Hiệu ứng lướt ngang cho địa điểm du lịch
let carousel = document.querySelector('.carousel');
let scrollAmount = 0;
setInterval(() => {
    if (scrollAmount >= carousel.scrollWidth - carousel.clientWidth) {
        scrollAmount = 0;
    } else {
        scrollAmount += 2;
    }
    carousel.scrollTo(scrollAmount, 0);
}, 50);

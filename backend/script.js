

//--------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------
// Mảng lưu thông tin phòng đã đặt
document.getElementById('loginBtn').addEventListener('click', () => {
    // Hiển thị form đăng nhập khi nhấn "Đăng Nhập"
    document.getElementById('loginForm').style.display = 'block';
});

document.getElementById('submitLogin').addEventListener('click', () => {
    // Lấy tên đăng nhập và mật khẩu
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Gửi yêu cầu đăng nhập đến server
    fetch('http://localhost:3000/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Đăng nhập thành công!') {
            // Nếu đăng nhập thành công, thông báo và ẩn form
            document.getElementById('loginMessage').textContent = 'Đăng nhập thành công!';
            document.getElementById('loginForm').style.display = 'none';

            // Lưu thông tin người dùng (ví dụ: trong localStorage, hoặc session)
            localStorage.setItem('user', JSON.stringify(data.user));
        } else {
            // Nếu đăng nhập thất bại, thông báo lỗi
            document.getElementById('loginMessage').textContent = 'Tên đăng nhập hoặc mật khẩu không đúng.';
        }
    })
    .catch(error => {
        // Xử lý lỗi kết nối
        document.getElementById('loginMessage').textContent = 'Lỗi kết nối đến server!';
    });
});
// JavaScript để toggle form đăng nhập
function toggleLoginForm() {
    var loginForm = document.getElementById("loginForm");
    if (loginForm.style.display === "none" || loginForm.style.display === "") {
        loginForm.style.display = "block";
    } else {
        loginForm.style.display = "none";
    }
}


//-------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------
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
document.getElementById('closeLoginForm').addEventListener('click', () => {
    // Ẩn form đăng nhập khi nhấn "Thoát"
    document.getElementById('loginForm').style.display = 'none';
});
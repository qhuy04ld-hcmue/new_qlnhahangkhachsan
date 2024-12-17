document.getElementById('loginBtn').addEventListener('click', () => {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    fetch('http://localhost:3000/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            document.getElementById('message').textContent = data.message;
        }
    })
    .catch(error => {
        document.getElementById('message').textContent = 'Lỗi kết nối!';
    });
});

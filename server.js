const express = require('express');
const mssql = require('mssql');
const bcrypt = require('bcryptjs');
const bodyParser = require('body-parser');

const app = express();
app.use(bodyParser.json());

// Cấu hình kết nối SQL Server sử dụng Windows Authentication
const config = {
    server: 'HUYK48HCMUE\\QUANGHUY', // Tên server
    database: 'Users', // Tên cơ sở dữ liệu
    options: {
        encrypt: true, // Sử dụng mã hóa (nếu sử dụng Azure SQL hoặc có yêu cầu bảo mật)
        trustServerCertificate: true, // Để tránh cảnh báo chứng chỉ khi kết nối không sử dụng SSL
    },
    authentication: {
        type: 'ntlm', // Sử dụng NTLM (Windows Authentication)
        options: {
            domain: '', // Nếu cần, có thể để trống nếu không yêu cầu domain cụ thể
            userName: '', // Tên người dùng sẽ là tài khoản Windows hiện tại của bạn
            password: '' // Mật khẩu nếu cần, thường không cần vì sử dụng Windows Authentication
        }
    }
};

// API đăng nhập
app.post('/login', async (req, res) => {
    const { username, password } = req.body;

    try {
        const pool = await mssql.connect(config);

        const result = await pool.request()
            .input('username', mssql.NVarChar, username)
            .query('SELECT * FROM Users WHERE Username = @username');

        if (result.recordset.length === 0) {
            return res.status(401).send({ message: 'Tên đăng nhập không tồn tại!' });
        }

        const user = result.recordset[0];

        const isPasswordValid = await bcrypt.compare(password, user.Password);
        
        if (isPasswordValid) {
            res.status(200).send({
                message: 'Đăng nhập thành công!',
                user: {
                    UserID: user.UserID,
                    Username: user.Username,
                    UserType: user.UserType,
                }
            });
        } else {
            res.status(401).send({ message: 'Mật khẩu không đúng!' });
        }
    } catch (error) {
        console.error('Lỗi kết nối:', error);
        res.status(500).send({ message: 'Lỗi kết nối cơ sở dữ liệu!' });
    }
});

app.listen(3000, () => {
    console.log('Server đang chạy tại http://localhost:3000');
});

/*
const express = require('express');
const mssql = require('mssql');
const bodyParser = require('body-parser');

const app = express();
app.use(bodyParser.json());

const config = {
    user: 'your_username',
    password: 'your_password',
    server: 'your_server',
    database: 'your_database',
    options: {
        encrypt: true,
        trustServerCertificate: true,
    },
};

// Đăng nhập
app.post('/login', async (req, res) => {
    const { username, password } = req.body;
    try {
        const pool = await mssql.connect(config);
        const result = await pool.request()
            .input('username', mssql.NVarChar, username)
            .input('password', mssql.NVarChar, password)
            .query('SELECT * FROM Users WHERE username = @username AND password = @password');
        
        if (result.recordset.length > 0) {
            res.status(200).send({ message: 'Đăng nhập thành công!' });
        } else {
            res.status(401).send({ message: 'Sai tên đăng nhập hoặc mật khẩu!' });
        }
    } catch (error) {
        res.status(500).send({ message: 'Lỗi kết nối cơ sở dữ liệu!' });
    }
});

app.listen(3000, () => {
    console.log('Server đang chạy tại http://localhost:3000');
});


// Xử lý đăng nhập
document.getElementById('loginBtn').addEventListener('click', () => {
    const username = prompt('Nhập tên đăng nhập:');
    const password = prompt('Nhập mật khẩu:');
    
    fetch('http://localhost:3000/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ username, password })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    })
    .catch(err => alert('Lỗi kết nối!'));
});
*/

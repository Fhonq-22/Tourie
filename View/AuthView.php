<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập/Đăng ký</title>
    <link rel="stylesheet" href="/Tourie/css/Auth.css">
    <script src="/Tourie/js/Auth.js" defer></script>
</head>
<body>
<div class="auth-container">
    <div class="auth-tabs">
        <button class="tab-btn active" data-tab="login">Đăng nhập</button>
        <button class="tab-btn" data-tab="register">Đăng ký</button>
    </div>

    <form id="login" class="tab-form active" method="post">
        <div class="form-group">
            <label id="login-label">Email:</label>
            <input type="text" name="login" required placeholder="VD: vidu@gmail.com...">
        </div>
        <div class="form-group">
            <label>Mật khẩu:</label>
            <input type="password" name="matkhau" required placeholder="Nhập mật khẩu...">
        </div>
        <button type="submit" name="dangnhap">Đăng nhập ngay</button>
        
        <div class="login-alt">
            <span>Hoặc đăng nhập bằng:</span>
            <button type="button" class="btn-login-type" data-type="email">Email</button>
            <button type="button" class="btn-login-type" data-type="sdt">SĐT</button>
            <button type="button" class="btn-login-type" data-type="mand">ID</button>
        </div>
    </form>

    <form id="register" class="tab-form" method="post">
        <div class="form-group">
            <label>Họ tên:</label>
            <input type="text" name="hoten" placeholder="VD: Hoàng Văn A..." required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" placeholder="VD: vidu@gmail.com" required>
        </div>
        <div class="password-group">
            <div class="form-group">
                <label>Mật khẩu:</label>
                <input type="password" name="matkhau" placeholder="Nhập mật khẩu..." required>
            </div>
            <div class="form-group">
                <label>Nhập lại mật khẩu:</label>
                <input type="password" name="matkhau2" placeholder="Nhập lại mật khẩu..." required>
            </div>
        </div>
        <button type="submit" name="dangky">Đăng ký ngay</button>

        <div class="terms">
            Bằng việc đăng ký, bạn đồng ý với 
            <a href="/Tourie/chinh-sach" target="_blank">Chính sách quyền riêng tư</a> và 
            <a href="/Tourie/dieu-khoan" target="_blank">Điều khoản sử dụng</a> của chúng tôi.
        </div>
    </form>


    <div id="toast" class="toast"><?= $error ?? '' ?></div>
</div>


</body>
</html>
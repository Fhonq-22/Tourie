<?php if(isset($error)) echo "<p style='color:red;text-align:center;'>$error</p>"; ?>

<h2>Đăng nhập</h2>
<form method="post">
    <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" required>
    </div>
    <div class="form-group">
        <label>Mật khẩu:</label>
        <input type="password" name="matkhau" required>
    </div>
    <button type="submit" name="dangnhap">Đăng nhập</button>
</form>

<h2>Đăng ký</h2>
<form method="post">
    <div class="form-group">
        <label>Họ tên:</label>
        <input type="text" name="hoten" required>
    </div>
    <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" required>
    </div>
    <div class="form-group">
        <label>Mật khẩu:</label>
        <input type="password" name="matkhau" required>
    </div>
    <button type="submit" name="dangky">Đăng ký</button>
</form>

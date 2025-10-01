<?php
require 'NguoiDungController.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Quản lý người dùng</title>
<link rel="stylesheet" href="css/root.css">
<link rel="stylesheet" href="css/NguoiDung.css">
<script src="js/NguoiDung.js"></script>
</head>
<body>

<button class="btn-add" onclick="openForm()">+ Thêm người dùng</button>

<div class="overlay" id="popupForm" style="display:none;">
    <form method="post">
        <h2>Thêm người dùng <span class="close-btn" onclick="closeForm()">&times;</span></h2>

        <div class="form-group">
            <label>Họ tên:</label>
            <input type="text" name="hoten" placeholder="Hoàng Văn A..." required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" placeholder="hva@gmail.com..." required>
        </div>

        <div class="form-group">
            <label>Mật khẩu:</label>
            <input type="password" name="matkhau" placeholder="123tour...">
        </div>

        <div class="form-group">
            <label>SĐT:</label>
            <input type="tel" name="sdt" placeholder="0123456789...">
        </div>

        <div class="form-group">
            <label>Địa chỉ:</label>
            <div class="form-row">
                <input type="hidden" name="vitrilat" id="vitrilat">
                <input type="hidden" name="vitrilng" id="vitrilng">
                <input type="text" name="diachi" placeholder="Sông Công, Thái Nguyên..." id="diachi">
                <button type="button" class="btn-small" onclick="LayViTri()">Lấy vị trí</button>
            </div>
        </div>

        <div class="form-group">
            <label>Giới tính:</label>
            <select name="gioitinh">
                <option value="" selected disabled>-- Chọn giới tính --</option>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
                <option value="Khác">Khác</option>
            </select>
        </div>

        <div class="form-group">
            <label>Ngày sinh:</label>
            <input type="date" name="ngaysinh">
        </div>

        <button type="submit" name="add">Thêm</button>
    </form>
</div>

<h2>Danh sách người dùng</h2>
<table>
<tr>
<th>ID</th><th>Họ tên</th><th>Email</th><th>SĐT</th><th>Địa chỉ</th><th>Giới tính</th><th>Ngày sinh</th><th>Loại người dùng</th><th>Trạng thái</th><th>Ngày đăng ký</th><th>Hành động</th>
</tr>
<?php foreach($nguoiDungList as $row): ?>
<tr>
<td><?= $row['MaND'] ?></td>
<td><?= htmlspecialchars($row['HoTen']) ?></td>
<td><?= htmlspecialchars($row['Email']) ?></td>
<td><?= htmlspecialchars($row['SDT']) ?></td>
<td><?= htmlspecialchars($row['DiaChi']) ?></td>
<td><?= htmlspecialchars($row['GioiTinh']) ?></td>
<td><?= htmlspecialchars($row['NgaySinh']) ?></td>
<td><?= htmlspecialchars($row['LoaiNguoiDung']) ?></td>
<td><?= htmlspecialchars($row['TrangThai']) ?></td>
<td><?= htmlspecialchars($row['NgayDangKy']) ?></td>
<td><a href="NguoiDungView.php?delete=<?= $row['MaND'] ?>" onclick="return confirm('Xóa người dùng này?')">Xóa</a></td>
</tr>
<?php endforeach; ?>
</table>

</body>
</html>

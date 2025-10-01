<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý người dùng</title>
    <link rel="stylesheet" href="/Tourie/css/NguoiDung.css">
    <script src="/Tourie/js/NguoiDung.js"></script>
</head>
<body>
    <button class="btn-add btn-hanhdong" onclick="moPopupThem()">+ Thêm người dùng</button>

    <!-- Popup thêm người dùng -->
    <div class="overlay" id="popupThem" style="display:none;">
        <form method="post">
            <h2>Thêm người dùng <span class="close-btn" onclick="dongPopupThem()">&times;</span></h2>

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
                    <input type="text" name="diachi" id="diachi" placeholder="Sông Công, Thái Nguyên...">
                    <button type="button" class="btn-small" onclick="LayViTri()">Lấy vị trí</button>
                </div>
            </div>
            <div class="form-group">
                <label>Giới tính:</label>
                <select name="gioitinh">
                    <option value="" disabled selected>-- Chọn giới tính --</option>
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

    <!-- Popup sửa trạng thái -->
    <div class="overlay" id="popupSua" style="display:none;">
        <form method="post" id="formEditStatus">
            <h2>Sửa trạng thái <span class="close-btn" onclick="dongPopupSua()">&times;</span></h2>
            <input type="hidden" name="mand" id="idcansua">

            <div class="form-group">
                <label>Họ tên:</label>
                <input type="text" id="hotencansua" disabled>
            </div>

            <div class="form-group">
                <label>Trạng thái:</label>
                <select name="trangthai" id="trangthaicansua" required>
                    <option value="Hoạt động">Hoạt động</option>
                    <option value="Khoá">Khoá</option>
                </select>
            </div>

            <button type="submit" name="editStatus">Lưu</button>
        </form>
    </div>

    <!-- Popup sửa admin -->
    <div class="overlay" id="popupSuaAdmin" style="display:none;">
        <form method="post" id="formEditAdmin">
            <h2>Sửa thông tin <span class="close-btn" onclick="dongPopupSuaAdmin()">&times;</span></h2>
            <input type="hidden" name="mand" id="idAdmin">

            <div class="form-group">
                <label>Họ tên:</label>
                <input type="text" name="hoten" id="hotenAdmin" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" id="emailAdmin" required>
            </div>

            <div class="form-group">
                <label>Mật khẩu:</label>
                <input type="password" name="matkhau" id="matkhauAdmin" placeholder="Nhập mật khẩu mới...">
            </div>

            <div class="form-group">
                <label>SĐT:</label>
                <input type="tel" name="sdt" id="sdtAdmin">
            </div>

            <div class="form-group">
                <label>Địa chỉ:</label>
                <div class="form-row">
                    <input type="hidden" name="vitrilat" id="vitrilatAdmin">
                    <input type="hidden" name="vitrilng" id="vitrilngAdmin">
                    <input type="text" name="diachi" id="diachiAdmin" placeholder="Sông Công, Thái Nguyên...">
                    <button type="button" class="btn-small" onclick="LayViTriAdmin()">Lấy vị trí</button>
                </div>
            </div>

            <div class="form-group">
                <label>Giới tính:</label>
                <select name="gioitinh" id="gioitinhAdmin">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                    <option value="Khác">Khác</option>
                </select>
            </div>

            <div class="form-group">
                <label>Ngày sinh:</label>
                <input type="date" name="ngaysinh" id="ngaysinhAdmin">
            </div>

            <div class="form-group">
                <label>Trạng thái:</label>
                <select id="trangthaiAdmin" disabled>
                    <option value="Hoạt động">Hoạt động</option>
                    <option value="Khoá">Khoá</option>
                </select>
            </div>

            <button type="submit" name="editAdmin">Lưu</button>
        </form>
    </div>

    <!-- Popup Xóa người dùng -->
    <div class="overlay" id="popupXoa" style="display:none;">
        <div class="popup-inner">
            <h2>Xác nhận xóa</h2>
            <p>Bạn có chắc muốn xóa <span id="tencanxoa"></span> không?</p>
            <div class="popup-buttons">
                <a href="#" id="btn-xacnhanxoa" class="btn-hanhdong">Xác nhận</a>
                <button type="button" class="btn-hanhdong" onclick="dongPopupXoa()">Hủy</button>
            </div>
        </div>
    </div>

    <!-- Danh sách người dùng -->
    <h2>DANH SÁCH NGƯỜI DÙNG</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>SĐT</th>
            <th>Địa chỉ</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Loại người dùng</th>
            <th>Trạng thái</th>
            <th>Ngày đăng ký</th>
            <th>Hành động</th>
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
                <td>
                    <?php if ($row['LoaiNguoiDung'] === 'Quản trị viên'): ?>
                        <button class="btn-hanhdong" onclick="moPopupSuaAdmin(<?= $row['MaND'] ?>)">Sửa</button>
                    <?php else: ?>
                        <button class="btn-hanhdong" onclick="moPopupSua(<?= $row['MaND'] ?>, '<?= $row['HoTen'] ?>', '<?= $row['TrangThai'] ?>')">Sửa</button>
                        <button class="btn-hanhdong" onclick="moPopupXoa(<?= $row['MaND'] ?>, '<?= $row['HoTen'] ?>')">Xóa</button>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

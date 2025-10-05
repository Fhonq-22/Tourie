<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Tourie/css/DiaDiem.css">

    
</head>
<body>
    <div class="admin-container">
        <h2>Quản lý địa điểm</h2>

        <button onclick="moPopupThem()">+ Thêm địa điểm</button>

        <table border="1" cellspacing="0" cellpadding="8">
            <tr>
                <th>ID</th>
                <th>Tên địa điểm</th>
                <th>Địa chỉ</th>
                <th>Ảnh</th>
                <th>Vĩ độ</th>
                <th>Kinh độ</th>
                <th>Thao tác</th>
            </tr>
            <?php while ($row = $list->fetch_assoc()): ?>
            <tr>
                <td><?= $row['MaDD'] ?></td>
                <td><?= htmlspecialchars($row['TenDD']) ?></td>
                <td><?= htmlspecialchars($row['DiaChi']) ?></td>
                <td><img src="<?= $row['AnhDaiDien'] ?>" width="80"></td>
                <td><?= $row['ViTriLat'] ?></td>
                <td><?= $row['ViTriLng'] ?></td>
                <td>
                    <button onclick="moPopupSua(<?= $row['MaDD'] ?>)">Sửa</button>
                    <a href="?delete=<?= $row['MaDD'] ?>" onclick="return confirm('Xóa địa điểm này?')">Xóa</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div id="popupThem" class="popup">
        <form method="POST" action="" class="form">
            <h3>Thêm địa điểm</h3>
            <input type="text" name="TenDD" placeholder="Tên địa điểm" required>
            <input type="text" name="DiaChi" id="diachi" placeholder="Địa chỉ">
            <textarea name="MoTa" placeholder="Mô tả"></textarea>
            <input type="text" name="AnhDaiDien" placeholder="Link ảnh">
            <input type="text" name="LinkMap" placeholder="Link bản đồ (nếu có)">
            <input type="hidden" name="ViTriLat" id="vitrilat">
            <input type="hidden" name="ViTriLng" id="vitrilng">
            <button type="button" onclick="LayViTri()">Lấy vị trí</button>
            <button type="submit" name="add">Lưu</button>
            <button type="button" onclick="dongPopupThem()">Hủy</button>
        </form>
    </div>

    <script src="/Tourie/js/DiaDiem.js"></script>

</body>
</html>
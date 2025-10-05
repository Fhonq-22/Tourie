<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý địa điểm</title>
  <link rel="stylesheet" href="/Tourie/css/DiaDiem.css">
</head>
<body>
  <div class="admin-container">
    <h2>Quản lý địa điểm</h2>

    <button class="btn-add" onclick="moPopupThem()">+ Thêm địa điểm</button>

    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tên địa điểm</th>
          <th>Địa chỉ</th>
          <th>Ảnh</th>
          <th>Vĩ độ</th>
          <th>Kinh độ</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($diadiems as $row): ?>
        <tr>
          <td><?= $row['MaDD'] ?></td>
          <td><?= htmlspecialchars($row['TenDD']) ?></td>
          <td><?= htmlspecialchars($row['DiaChi']) ?></td>
          <td>
            <?php if ($row['AnhDaiDien']): ?>
              <img src="<?= $row['AnhDaiDien'] ?>" alt="Ảnh địa điểm" class="thumb">
            <?php else: ?>
              <span class="no-img">Không có</span>
            <?php endif; ?>
          </td>
          <td><?= $row['ViTriLat'] ?></td>
          <td><?= $row['ViTriLng'] ?></td>
          <td>
            <button class="btn-edit" onclick="moPopupSua(<?= $row['MaDD'] ?>)">Sửa</button>
            <a class="btn-del" href="?delete=<?= $row['MaDD'] ?>" onclick="return confirm('Xóa địa điểm này?')">Xóa</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- popup thêm -->
  <div id="popupThem" class="popup">
    <form method="POST" action="" enctype="multipart/form-data" class="form">
      <h3>Thêm địa điểm</h3>

      <label>Tên địa điểm</label>
      <input type="text" name="TenDD" placeholder="Tên địa điểm" required>

      <label>Địa chỉ</label>
      <input type="text" name="DiaChi" placeholder="Địa chỉ">

      <label>Mô tả</label>
      <textarea name="MoTa" placeholder="Mô tả"></textarea>

      <label>Ảnh đại diện</label>
      <input type="file" name="AnhDaiDien" accept="image/*">
      <small>Hoặc dán link ảnh:</small>
      <input type="text" name="AnhDaiDienLink" placeholder="https://...">

      <label>Vị trí / Link bản đồ</label>
      <input type="text" name="LinkMap" id="linkmap" placeholder="Dán link bản đồ hoặc nhập lat,lng">

      <div class="coords">
        <input type="text" name="ViTriLat" id="vitrilat" placeholder="Vĩ độ (lat)">
        <input type="text" name="ViTriLng" id="vitrilng" placeholder="Kinh độ (lng)">
        <button type="button" onclick="phanTichLink()">↻ Lấy tọa độ</button>
      </div>

      <div class="btn-group">
        <button type="submit" name="add" class="btn-save">💾 Lưu</button>
        <button type="button" onclick="dongPopupThem()" class="btn-cancel">✖ Hủy</button>
      </div>
    </form>
  </div>

  <script src="/Tourie/js/DiaDiem.js"></script>
</body>
</html>
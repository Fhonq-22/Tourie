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
            <button class="btn-edit" data-row='<?= htmlspecialchars(json_encode($row), ENT_QUOTES) ?>'>Sửa</button>
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
            <span type="button" onclick="dongPopupThem()" class="btn-cancel">✖</span>
            <h3>Thêm địa điểm</h3>

            <label class="inline">
              <span>Tên địa điểm:</span>
              <input type="text" name="TenDD" placeholder="Tên địa điểm" required>
            </label>

            <label class="inline">
              <span>Địa chỉ:</span>
              <input type="text" name="DiaChi" placeholder="Địa chỉ">
            </label>

            <label class="inline">
              <span>Mô tả:</span>
              <textarea name="MoTa" placeholder="Mô tả"></textarea>
            </label>

            <label class="inline">
              <span>Ảnh đại diện:</span>
              <input type="file" name="AnhDaiDien" accept="image/*">
            </label>
            <label class="inline">
              <small>Hoặc dán link ảnh:</small>
              <input type="text" name="AnhDaiDienLink" placeholder="https://...">
            </label>

            <label>Vị trí / Link bản đồ</label>
            <div class="link-row">
              <input type="text" name="LinkMap" id="linkmap" placeholder="Dán link bản đồ hoặc nhập lat,lng">
              <button type="button" onclick="phanTichLink()">↻ Lấy tọa độ</button>
            </div>

            <div class="coords">
              <input type="text" name="ViTriLat" id="vitrilat" placeholder="Vĩ độ (lat)">
              <input type="text" name="ViTriLng" id="vitrilng" placeholder="Kinh độ (lng)">
            </div>

            <div class="btn-group">
                <button type="submit" name="add" class="btn-save">💾 Lưu</button>
            </div>
        </form>
    </div>

    <div id="popupSua" class="popup">
        <form method="POST" action="" enctype="multipart/form-data" id="formSua" class="form">
            <span type="button" onclick="dongPopupSua()" class="btn-cancel">✖</span>
            <h3>Sửa địa điểm</h3>
            <input type="hidden" name="MaDD" id="edit_MaDD">
            <label>Tên địa điểm</label>
            <input type="text" name="TenDD" id="edit_TenDD" required>

            <label>Địa chỉ</label>
            <input type="text" name="DiaChi" id="edit_DiaChi">

            <label>Mô tả</label>
            <textarea name="MoTa" id="edit_MoTa"></textarea>

            <label>Ảnh mới (nếu muốn thay)</label>
            <input type="file" name="AnhDaiDien" accept="image/*">
            <input type="text" name="AnhLink" id="edit_AnhLink" placeholder="Hoặc link ảnh">

            <label>Vĩ độ / Kinh độ</label>
            <div class="coords">
                <input type="text" name="ViTriLat" id="edit_ViTriLat" placeholder="Vĩ độ">
                <input type="text" name="ViTriLng" id="edit_ViTriLng" placeholder="Kinh độ">
            </div>

            <label>Link map</label>
            <input type="text" name="LinkMap" id="edit_LinkMap">

            <div class="btn-group">
                <button type="submit" name="update" class="btn-save">💾 Lưu</button>
            </div>
        </form>
    </div>

  <script src="/Tourie/js/DiaDiem.js"></script>
</body>
</html>
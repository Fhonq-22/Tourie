<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý chủ đề tour</title>
  <link rel="stylesheet" href="/Tourie/css/ChuDeTour.css">
</head>
<body>
  <div class="admin-container">
    <h2>Quản lý chủ đề tour</h2>

    <button class="btn-add" onclick="moPopupThem()">+ Thêm chủ đề</button>

    <div class="table-wrapper">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tên chủ đề</th>
            <th>Mô tả</th>
            <th>Ngày tạo</th>
            <th>Ngày cập nhật</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($chuDes as $cd): ?>
          <tr>
            <td><?= $cd->MaChuDe ?></td>
            <td><?= htmlspecialchars($cd->TenChuDe) ?></td>
            <td><?= htmlspecialchars($cd->getMoTaNgan()) ?></td>
            <td><?= htmlspecialchars($cd->NgayTao) ?></td>
            <td><?= htmlspecialchars($cd->NgayCapNhat) ?></td>
            <td>
              <button class="btn-edit"
                data-row='<?= htmlspecialchars(json_encode($cd), ENT_QUOTES, "UTF-8") ?>'>
                Sửa
              </button>
              <a class="btn-del"
                 href="?controller=chudetour&action=delete&id=<?= $cd->MaChuDe ?>"
                 onclick="return confirm('Xóa chủ đề này?')">Xóa</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- popup thêm -->
  <div id="popupThem" class="popup">
    <form method="POST" action="" class="form">
      <span type="button" onclick="dongPopupThem()" class="btn-cancel">✖</span>
      <h3>Thêm chủ đề tour</h3>

      <label class="inline">
        <span>Tên chủ đề:</span>
        <input type="text" name="TenChuDe" placeholder="Tên chủ đề" required>
      </label>

      <label class="inline">
        <span>Mô tả:</span>
        <textarea name="MoTa" placeholder="Mô tả ngắn"></textarea>
      </label>

      <div class="btn-group">
        <button type="submit" name="add" class="btn-save">💾 Lưu</button>
      </div>
    </form>
  </div>

  <!-- popup sửa -->
  <div id="popupSua" class="popup">
    <form method="POST" action="" id="formSua" class="form">
      <span type="button" onclick="dongPopupSua()" class="btn-cancel">✖</span>
      <h3>Sửa chủ đề tour</h3>

      <input type="hidden" name="MaChuDe" id="edit_MaChuDe">

      <label class="inline">
        <span>Tên chủ đề:</span>
        <input type="text" name="TenChuDe" id="edit_TenChuDe" required>
      </label>

      <label class="inline">
        <span>Mô tả:</span>
        <textarea name="MoTa" id="edit_MoTa"></textarea>
      </label>

      <div class="btn-group">
        <button type="submit" name="edit" class="btn-save">💾 Lưu</button>
      </div>
    </form>
  </div>

  <script src="/Tourie/js/ChuDeTour.js"></script>
</body>
</html>
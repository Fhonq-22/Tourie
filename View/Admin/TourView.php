<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý tour</title>
  <link rel="stylesheet" href="/Tourie/css/Tour.css">
</head>
<body>
  <div class="admin-container">
    <h2>Quản lý tour</h2>

    <button class="btn-add" onclick="moPopupThem()">+ Thêm tour</button>

    <div class="table-wrapper">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tên tour</th>
            <th>Mô tả</th>
            <th>Hành trình</th>
            <th>Thời gian</th>
            <th>Giá (VND)</th>
            <th>Số chỗ</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tours as $t): ?>
          <tr>
            <td><?= $t->MaTour ?></td>
            <td><?= htmlspecialchars($t->TenTour) ?></td>
            <td><?= htmlspecialchars($t->getMoTaNgan()) ?></td>
            <td><?= $t->MaDiaDiemDi.' -> '.$t->MaDiaDiemDen ?></td>
            <td><?= 'Từ: '.$t->NgayKhoiHanh.'<br>Đến: '.$t->NgayKetThuc ?></td>
            <td><?=  $t->getDinhDangGia() ?></td>
            <td><?=  $t->SoCho ?></td>
            <td>
              <button class="btn-edit"
                data-row='<?= htmlspecialchars(json_encode($t), ENT_QUOTES, "UTF-8") ?>'>
                Sửa
              </button>
              <a class="btn-del"
                 href="?delete=<?= $t->MaTour ?>"
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
      <h3>Thêm tour</h3>

      <label class="inline">
        <span>Tên tour:</span>
        <input type="text" name="TenTour" placeholder="Tên tour" required>
      </label>

      <label class="inline">
        <span>Mô tả:</span>
        <textarea name="MoTa" placeholder="Mô tả ngắn"></textarea>
      </label>

      <label class="inline">
        <span>Loại tour:</span>
        <select name="LoaiTour" id="">
            <option value="" selected>--Chọn--</option>
            <option value="Cá nhân">Cá nhân</option>
            <option value="Gia đình">Gia đình</option>
            <option value="Theo đoàn">Theo đoàn</option>
        </select>
        <span>Chủ đề:</span>
        <select name="MaChuDe">
          <option value="" selected>--Chọn--</option>
          <?php foreach ($chuDes as $cd): ?>
            <option value="<?= $cd->MaChuDe ?>"><?= htmlspecialchars($cd->TenChuDe) ?></option>
          <?php endforeach; ?>
        </select>

      </label>

      <label class="inline">
        <span>Xuất phát từ:</span>
        <select name="MaDDDi">
          <option value="" selected>--Chọn--</option>
          <?php foreach ($diaDiems as $dd): ?>
            <option value="<?= $dd->MaDD ?>"><?= htmlspecialchars($dd->TenDD) ?></option>
          <?php endforeach; ?>
        </select>

        <span>đến:</span>
        <select name="MaDDDen">
          <option value="" selected>--Chọn--</option>
          <?php foreach ($diaDiems as $dd): ?>
            <option value="<?= $dd->MaDD ?>"><?= htmlspecialchars($dd->TenDD) ?></option>
          <?php endforeach; ?>
        </select>
      </label>

      <label class="inline">
        <span>Khởi hành ngày:</span>
        <input type="date" name="NgayKhoiHanh">
        <span>đến:</span>
        <input type="date" name="NgayKetThuc">
      </label>

      <label class="inline">
        <span>Giá:</span>
        <input type="number" name="Gia">
        <span>Số chỗ:</span>
        <input type="number" name="SoCho">
      </label>

      <label class="inline">
        <span>Ảnh đại diện:</span>
        <input type="file" name="AnhDaiDien">
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
      <h3>Sửa tour</h3>

      <input type="hidden" name="MaChuDe" id="edit_MaTour">

      <label class="inline">
        <span>Tên tour:</span>
        <input type="text" name="TenTour" id="edit_TenTour" required>
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

  <script src="/Tourie/js/Tour.js"></script>
</body>
</html>

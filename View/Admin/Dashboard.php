<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Bảng điều khiển - Quản trị Tourie</title>
  <link rel="stylesheet" href="/Tourie/css/admin.css">

</head>
<body>
  <div class="admin-container">
    <!-- sidebar -->
    <aside class="sidebar">
      <h2 class="logo">Tourie Admin</h2>
      <nav>
        <ul>
          <li><a href="admin.php?url=dashboard" class="active">📊 Dashboard</a></li>
          <li><a href="admin.php?url=nguoi-dung">👤 Người dùng</a></li>
          <li><a href="admin.php?url=dia-diem">📍 Địa điểm</a></li>
          <li><a href="admin.php?url=chu-de-tour">🏷️ Chủ đề tour</a></li>
          <li><a href="admin.php?url=tour">🗺️ Tour</a></li>
          <li><a href="admin.php?url=dat-tour">📝 Đặt tour</a></li>
          <li><a href="admin.php?url=danh-gia">⭐ Đánh giá</a></li>
        </ul>
      </nav>
    </aside>

    <!-- main -->
    <main class="main-content">
      <header class="topbar">
        <h1>Bảng điều khiển</h1>
        <div class="admin-info">
          <span>Xin chào, Quản trị viên</span>
          <button class="logout-btn">Đăng xuất</button>
        </div>
      </header>

      <section class="cards">
        <div class="card">
          <h3>👤 Người dùng</h3>
          <p>120</p>
        </div>
        <div class="card">
          <h3>🗺️ Tour</h3>
          <p>45</p>
        </div>
        <div class="card">
          <h3>📝 Đặt tour</h3>
          <p>230</p>
        </div>
        <div class="card">
          <h3>⭐ Đánh giá</h3>
          <p>560</p>
        </div>
      </section>

      <section class="overview">
        <h2>Tổng quan</h2>
        <p>Chào mừng bạn đến với hệ thống quản trị Tourie. Tại đây bạn có thể quản lý người dùng, tour du lịch, đặt tour và các phản hồi từ khách hàng.</p>
      </section>
    </main>
  </div>
</body>
</html>
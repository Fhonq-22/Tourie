<?php
require 'db.php';

// ===== Proxy API OpenStreetMap =====
if (isset($_GET['lat']) && isset($_GET['lon'])) {
    $lat = $_GET['lat'];
    $lon = $_GET['lon'];
    $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat=$lat&lon=$lon&accept-language=vi";

    $opts = ["http" => ["header" => "User-Agent: TourieApp/1.0\r\n"]];
    $context = stream_context_create($opts);

    header("Content-Type: application/json; charset=UTF-8");
    echo file_get_contents($url, false, $context);
    exit;
}

// ===== Xử lý form thêm =====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $_POST = array_map(fn($v) => ($v === '' || $v === '0000-00-00') ? null : $v, $_POST);

        $hoten    = $_POST['hoten'];
        $email    = $_POST['email'];
        $matkhau  = $_POST['matkhau'] ?? "123tour";
        $sdt      = $_POST['sdt'] ?? null;
        $diachi   = $_POST['diachi'] ?? null;
        $gioitinh = $_POST['gioitinh'] ?? "Khác";
        $ngaysinh = $_POST['ngaysinh'] ?? null;
        $lat      = $_POST['vitrilat'] ?? null;
        $lng      = $_POST['vitrilng'] ?? null;

        $stmt = $conn->prepare("INSERT INTO NguoiDung (HoTen, Email, MatKhau, SDT, DiaChi, GioiTinh, NgaySinh, ViTriLat, ViTriLng) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $hoten, $email, $matkhau, $sdt, $diachi, $gioitinh, $ngaysinh, $lat, $lng);
        $stmt->execute();
        $stmt->close();

        header("Location: NguoiDungView.php"); // reload sau khi thêm
        exit;
    }
}

// ===== Xóa người dùng =====
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM NguoiDung WHERE MaND=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: NguoiDungView.php");
    exit;
}

// ===== Lấy danh sách người dùng =====
$result = $conn->query("SELECT * FROM NguoiDung ORDER BY MaND DESC");
$nguoiDungList = [];
while ($row = $result->fetch_assoc()) {
    $nguoiDungList[] = $row;
}
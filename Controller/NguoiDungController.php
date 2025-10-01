<?php
    if (isset($_GET['lat']) && isset($_GET['lon'])) {
        $lat = $_GET['lat'];
        $lon = $_GET['lon'];
        $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat=$lat&lon=$lon&accept-language=vi";
        $context = stream_context_create(["http" => ["header" => "User-Agent: TourieApp/1.0\r\n"]]);
        header("Content-Type: application/json; charset=UTF-8");
        echo file_get_contents($url, false, $context);
        exit;
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Tourie";
    $tblname = "NguoiDung";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) die("Kết nối thất bại: " . $conn->connect_error);

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add'])) {
        $_POST = array_map(fn($v) => ($v === '' || $v === '0000-00-00') ? null : $v, $_POST);
        $hoten = $_POST['hoten'];
        $email = $_POST['email'];
        $matkhau = $_POST['matkhau'] ?? "123tour";
        $sdt = $_POST['sdt'] ?? null;
        $diachi = $_POST['diachi'] ?? null;
        $gioitinh = $_POST['gioitinh'] ?? "Khác";
        $ngaysinh = $_POST['ngaysinh'] ?? null;
        $vitrilat = $_POST['vitrilat'] ?? null;
        $vitrilng = $_POST['vitrilng'] ?? null;

        $stmt = $conn->prepare("INSERT INTO $tblname (HoTen, Email, MatKhau, SDT, DiaChi, GioiTinh, NgaySinh, ViTriLat, ViTriLng) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $hoten, $email, $matkhau, $sdt, $diachi, $gioitinh, $ngaysinh, $vitrilat, $vitrilng);
        $stmt->execute();
        $stmt->close();

        header("Location: NguoiDungController.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['editStatus'])) {
        $mand = $_POST['mand'];
        $trangthai = $_POST['trangthai'];

        $stmt = $conn->prepare("UPDATE NguoiDung SET TrangThai=? WHERE MaND=?");
        $stmt->bind_param("si", $trangthai, $mand);
        $stmt->execute();
        $stmt->close();

        header("Location: NguoiDungController.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['editAdmin'])) {
        $mand = $_POST['mand'];
        $hoten = $_POST['hoten'];
        $email = $_POST['email'];
        $matkhau = $_POST['matkhau'] ?: null;
        $sdt = $_POST['sdt'] ?: null;
        $diachi = $_POST['diachi'] ?: null;
        $gioitinh = $_POST['gioitinh'] ?: "Khác";
        $ngaysinh = $_POST['ngaysinh'] ?: null;
        $vitrilat = $_POST['vitrilat'] ?? null;
        $vitrilng = $_POST['vitrilng'] ?? null;

        $fields = ['HoTen=?', 'Email=?', 'SDT=?', 'DiaChi=?', 'GioiTinh=?', 'NgaySinh=?'];
        $params = [$hoten, $email, $sdt, $diachi, $gioitinh, $ngaysinh];
        $types = "ssssss";

        if ($matkhau) {
            $fields[] = "MatKhau=?";
            $params[] = $matkhau;
            $types .= "s";
        }
        if ($vitrilat && $vitrilng) {
            $fields[] = "ViTriLat=?";
            $fields[] = "ViTriLng=?";
            $params[] = $vitrilat;
            $params[] = $vitrilng;
            $types .= "dd"; // nếu là float
        }

        $sql = "UPDATE NguoiDung SET " . implode(",", $fields) . " WHERE MaND=?";
        $params[] = $mand;
        $types .= "i";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $stmt->close();

        header("Location: NguoiDungController.php");
        exit;
    }

    if (isset($_GET['delete'])) {
        $mand = $_GET['delete'];
        $stmt = $conn->prepare("DELETE FROM $tblname WHERE MaND=?");
        $stmt->bind_param("i", $mand);
        $stmt->execute();
        $stmt->close();
        header("Location: NguoiDungController.php");
        exit;
    }

    $result = $conn->query("SELECT * FROM $tblname ORDER BY MaND DESC");
    $nguoiDungList = [];
    while ($row = $result->fetch_assoc()) $nguoiDungList[] = $row;
    include "../View/NguoiDungView.php";
    $conn->close();
?>
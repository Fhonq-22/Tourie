<?php
if (isset($_GET['lat']) && isset($_GET['lon'])) {
    header('Content-Type: application/json; charset=utf-8');
    $lat = $_GET['lat'];
    $lon = $_GET['lon'];

    $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat=$lat&lon=$lon&zoom=18&addressdetails=1";

    // dùng file_get_contents an toàn hơn với context
    $opts = [
        "http" => [
            "header" => "User-Agent: TourieApp/1.0\r\n"
        ]
    ];
    $context = stream_context_create($opts);
    $data = @file_get_contents($url, false, $context);

    if ($data === false || trim($data) === "") {
        echo json_encode(["error" => "Không thể lấy dữ liệu từ Nominatim"]);
        exit;
    }

    echo $data;
    exit;
}


require_once __DIR__ . '/../Model/NguoiDungModel.php';

class NguoiDungController {
    private $model;

    public function __construct() {
        $this->model = new NguoiDungModel();
    }

    // 🧭 API lấy địa chỉ từ lat/lon
    public function reverseGeocode() {
        if (isset($_GET['lat']) && isset($_GET['lon'])) {
            $lat = $_GET['lat'];
            $lon = $_GET['lon'];
            $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat=$lat&lon=$lon&accept-language=vi";
            $context = stream_context_create([
                "http" => ["header" => "User-Agent: TourieApp/1.0\r\n"]
            ]);

            header("Content-Type: application/json; charset=UTF-8");
            echo file_get_contents($url, false, $context);
            exit;
        }
    }

    // 📋 hiển thị danh sách
    public function index() {
        $this->reverseGeocode(); // nếu có lat/lon thì xử lý và dừng
        $nguoiDungList = $this->model->getAll();
        include __DIR__ . '/../View/Admin/NguoiDungView.php';
    }

    // ➕ thêm người dùng
    public function add() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add'])) {
            $_POST = array_map(fn($v) => ($v === '' || $v === '0000-00-00') ? null : $v, $_POST);
            $this->model->add([
                'hoten' => $_POST['hoten'],
                'email' => $_POST['email'],
                'matkhau' => $_POST['matkhau'] ?? '123tour',
                'sdt' => $_POST['sdt'] ?? null,
                'diachi' => $_POST['diachi'] ?? null,
                'gioitinh' => $_POST['gioitinh'] ?? 'Khác',
                'ngaysinh' => $_POST['ngaysinh'] ?? null,
                'vitrilat' => $_POST['vitrilat'] ?? null,
                'vitrilng' => $_POST['vitrilng'] ?? null
            ]);
            header("Location: /Tourie/admin/nguoi-dung");
            exit;
        }
    }

    // ✏️ cập nhật thông tin
    public function editAdmin() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['editAdmin'])) {
            $id = $_POST['mand'];
            $data = [
                'hoten' => $_POST['hoten'],
                'email' => $_POST['email'],
                'matkhau' => $_POST['matkhau'] ?: '123tour',
                'sdt' => $_POST['sdt'] ?: null,
                'diachi' => $_POST['diachi'] ?: null,
                'gioitinh' => $_POST['gioitinh'] ?: 'Khác',
                'ngaysinh' => $_POST['ngaysinh'] ?: null,
                'vitrilat' => $_POST['vitrilat'] ?? null,
                'vitrilng' => $_POST['vitrilng'] ?? null
            ];
            $this->model->update($id, $data);
            header("Location: /Tourie/admin/nguoi-dung");
            exit;
        }
    }

    // 🔄 cập nhật trạng thái (kích hoạt / khóa)
    public function editStatus() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['editStatus'])) {
            $id = $_POST['mand'];
            $trangthai = $_POST['trangthai'];
            $db = new Database();
            $stmt = $db->conn->prepare("UPDATE NguoiDung SET TrangThai=? WHERE MaND=?");
            $stmt->bind_param("si", $trangthai, $id);
            $stmt->execute();
            $stmt->close();
            header("Location: /Tourie/admin/nguoi-dung");
            exit;
        }
    }

    // ❌ xóa người dùng
    public function delete() {
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $this->model->delete($id);
            header("Location: /Tourie/admin/nguoi-dung");
            exit;
        }
    }
}
?>
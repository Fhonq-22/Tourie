<?php
require_once __DIR__ . '/../Model/DiaDiemModel.php';

class DiaDiemController {
    private $model;

    public function __construct() {
        $this->model = new DiaDiemModel();
    }

    // Lấy địa chỉ từ lat/lon (reverse geocode)
    public function reverseGeocode() {
        if (isset($_GET['lat']) && isset($_GET['lon'])) {
            $lat = $_GET['lat'];
            $lon = $_GET['lon'];
            $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat=$lat&lon=$lon&accept-language=vi";

            $opts = ["http" => ["header" => "User-Agent: TourieApp/1.0\r\n"]];
            $context = stream_context_create($opts);
            $data = @file_get_contents($url, false, $context);

            header("Content-Type: application/json; charset=utf-8");
            echo $data ?: json_encode(["error" => "Không lấy được dữ liệu"]);
            exit;
        }
    }

    // Lấy tọa độ từ địa chỉ (geocode)
    public function geocode() {
        if (isset($_GET['address'])) {
            $address = urlencode($_GET['address']);
            $url = "https://nominatim.openstreetmap.org/search?q=$address&format=json&limit=1";

            $opts = ["http" => ["header" => "User-Agent: TourieApp/1.0\r\n"]];
            $context = stream_context_create($opts);
            $data = @file_get_contents($url, false, $context);

            header("Content-Type: application/json; charset=utf-8");
            echo $data ?: json_encode(["error" => "Không lấy được tọa độ"]);
            exit;
        }
    }

    public function index() {
        $this->reverseGeocode();
        $this->geocode();
        $list = $this->model->getAll();
        include __DIR__ . '/../View/Admin/DiaDiemView.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
            $data = [
                'TenDD' => $_POST['TenDD'],
                'DiaChi' => $_POST['DiaChi'] ?? null,
                'MoTa' => $_POST['MoTa'] ?? null,
                'AnhDaiDien' => $_POST['AnhDaiDien'] ?? null,
                'ViTriLat' => $_POST['ViTriLat'] ?? null,
                'ViTriLng' => $_POST['ViTriLng'] ?? null,
                'LinkMap' => $_POST['LinkMap'] ?? null
            ];
            $this->model->add($data);
            header("Location: /Tourie/admin/dia-diem");
            exit;
        }
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
            $id = $_POST['MaDD'];
            $data = [
                'TenDD' => $_POST['TenDD'],
                'DiaChi' => $_POST['DiaChi'],
                'MoTa' => $_POST['MoTa'],
                'AnhDaiDien' => $_POST['AnhDaiDien'],
                'ViTriLat' => $_POST['ViTriLat'],
                'ViTriLng' => $_POST['ViTriLng'],
                'LinkMap' => $_POST['LinkMap']
            ];
            $this->model->update($id, $data);
            header("Location: /Tourie/admin/dia-diem");
            exit;
        }
    }

    public function delete() {
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $this->model->delete($id);
            header("Location: /Tourie/admin/dia-diem");
            exit;
        }
    }
}
?>
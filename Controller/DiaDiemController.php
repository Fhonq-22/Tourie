<?php
require_once __DIR__ . '/../Model/DiaDiemModel.php';

class DiaDiemController {
    private $model;

    public function __construct() {
        $this->model = new DiaDiemModel();
    }

    public function index() {
        $diadiems = $this->model->getAll();
        include __DIR__ . '/../View/Admin/DiaDiemView.php';
    }

    public function add() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add'])) {
            $lat = $_POST['ViTriLat'] ?? null;
            $lng = $_POST['ViTriLng'] ?? null;
            $linkMap = $_POST['LinkMap'] ?? '';

            // xử lý upload ảnh
            $anh = '';
            if (!empty($_FILES['AnhDaiDien']['name'])) {
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/Tourie/uploads/diadiem/';
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                $fileName = time() . "_" . basename($_FILES['AnhDaiDien']['name']);
                $targetFile = $targetDir . $fileName;

                if (move_uploaded_file($_FILES['AnhDaiDien']['tmp_name'], $targetFile)) {
                    $anh = '/Tourie/uploads/diadiem/' . $fileName;
                }
            } else {
                $anh = $_POST['AnhLink'] ?? ''; // nếu người dùng nhập link thay vì upload
            }

            // nếu chưa có link map thì tự sinh
            if ((!$linkMap || trim($linkMap) === '') && $lat && $lng) {
                $linkMap = "https://www.google.com/maps?q={$lat},{$lng}";
            }

            $this->model->add([
                'TenDD' => $_POST['TenDD'],
                'DiaChi' => $_POST['DiaChi'] ?? '',
                'MoTa' => $_POST['MoTa'] ?? '',
                'AnhDaiDien' => $anh,
                'ViTriLat' => $lat,
                'ViTriLng' => $lng,
                'LinkMap' => $linkMap
            ]);

            header("Location: /Tourie/admin/dia-diem");
            exit;
        }
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
            $id = $_POST['MaDD'];
            $lat = $_POST['ViTriLat'] ?? null;
            $lng = $_POST['ViTriLng'] ?? null;
            $linkMap = $_POST['LinkMap'] ?? '';

            // xử lý upload ảnh (nếu có)
            $anh = $_POST['AnhCu'] ?? '';
            if (!empty($_FILES['AnhDaiDien']['name'])) {
                $targetDir = __DIR__ . '/../../uploads/diadiem/';
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                $fileName = time() . "_" . basename($_FILES['AnhDaiDien']['name']);
                $targetFile = $targetDir . $fileName;

                if (move_uploaded_file($_FILES['AnhDaiDien']['tmp_name'], $targetFile)) {
                    $anh = '/Tourie/uploads/diadiem/' . $fileName;
                }
            }

            if ((!$linkMap || trim($linkMap) === '') && $lat && $lng) {
                $linkMap = "https://www.google.com/maps?q={$lat},{$lng}";
            }

            $this->model->update($id, [
                'TenDD' => $_POST['TenDD'],
                'DiaChi' => $_POST['DiaChi'] ?? '',
                'MoTa' => $_POST['MoTa'] ?? '',
                'AnhDaiDien' => $anh,
                'ViTriLat' => $lat,
                'ViTriLng' => $lng,
                'LinkMap' => $linkMap
            ]);
            header("Location: /Tourie/admin/dia-diem");
            exit;
        }
    }

    public function delete() {
        if (isset($_GET['delete'])) {
            $this->model->delete($_GET['delete']);
            header("Location: /Tourie/admin/dia-diem");
            exit;
        }
    }
}
?>

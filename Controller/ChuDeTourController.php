<?php
require_once __DIR__ . '/../Model/ChuDeTourModel.php';

class ChuDeTourController {
    private ChuDeTourModel $model;

    public function __construct() {
        $this->model = new ChuDeTourModel();
    }

    public function index() {
        $chuDes = $this->model->getAll();
        require __DIR__ . '/../View/Admin/ChuDeTourView.php';
    }

    public function add() {
        if (isset($_POST['add'])) {
            $data = [
                'TenChuDe' => $_POST['TenChuDe'] ?? '',
                'MoTa' => $_POST['MoTa'] ?? ''
            ];
            $this->model->insert($data);
            header("Location: /Tourie/admin/chu-de-tour");
            exit;
        }
    }

    public function edit() {
        if (isset($_POST['edit'])) {
            $id = $_POST['MaChuDe'] ?? 0;
            $data = [
                'TenChuDe' => $_POST['TenChuDe'] ?? '',
                'MoTa' => $_POST['MoTa'] ?? ''
            ];
            $this->model->update($id, $data);
            header("Location: /Tourie/admin/chu-de-tour");
            exit;
        }
    }

    public function delete() {
        if (isset($_GET['delete'])) {
            $this->model->delete($_GET['delete']);
            header("Location: /Tourie/admin/chu-de-tour");
            exit;
        }
    }
}
?>
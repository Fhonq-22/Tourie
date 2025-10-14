<?php
require_once __DIR__ . '/../Model/TourModel.php';

class TourController {
    private TourModel $model;

    public function __construct() {
        $this->model = new TourModel();
    }

    public function index() {
        $tours = $this->model->getAll();
        require __DIR__ . '/../View/Admin/TourView.php';
    }

    public function add() {
        if (isset($_POST['add'])) {
            $t = new Tour($_POST);
            $this->model->add($t);
            header("Location: /Tourie/admin/tour");
            exit;
        }
    }

    public function edit() {
        if (isset($_POST['edit'])) {
            $t = new Tour($_POST);
            $this->model->edit($t);
            header("Location: /Tourie/admin/tour");
            exit;
        }
    }

    public function delete() {
        if (isset($_GET['delete'])) {
            $this->model->delete($_GET['delete']);
            header("Location: /Tourie/admin/tour");
            exit;
        }
    }
}
?>
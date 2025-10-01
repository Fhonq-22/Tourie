<?php
    session_start();
    require_once __DIR__ . '/../Model/NguoiDungModel.php';

class AuthController {
    private $model;
    public $error = ''; // public để truy cập từ index

    public function __construct() {
        $this->model = new NguoiDungModel();
    }

    public function dangKy() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dangky'])) {
            $hoten = trim($_POST['hoten']);
            $email = trim($_POST['email']);
            $matkhau = $_POST['matkhau'];
            $matkhau2 = $_POST['matkhau2'];

            if ($matkhau !== $matkhau2) {
                $this->error = "Mật khẩu nhập lại không khớp!";
                return;
            }
            if ($this->model->layTheoEmail($email)) {
                $this->error = "Email đã được sử dụng!";
                return;
            }

            $data = [
                'hoten' => $hoten,
                'email' => $email,
                'matkhau' => $matkhau,
                'gioitinh' => 'Khác'
            ];

            $this->model->add($data);
            $_SESSION['user'] = $this->model->layTheoEmail($email);
            header("Location: index.php");
            exit;
        }
    }

    public function dangNhap() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dangnhap'])) {
            $matkhau = $_POST['matkhau'];
            
            if (!empty($_POST['email'])) {
                $nguoiDung = $this->model->dangNhap(trim($_POST['email']), $matkhau, 'email');
            } else if (!empty($_POST['sdt'])) {
                $nguoiDung = $this->model->dangNhap(trim($_POST['sdt']), $matkhau, 'sdt');
            } else {
                $nguoiDung = $this->model->dangNhap(trim($_POST['mand']), $matkhau, 'mand');
            }

            if ($nguoiDung) {
                $_SESSION['user'] = $nguoiDung;
                header("Location: index.php");
                exit;
            } else {
                $this->error = "Thông tin đăng nhập không đúng!";
                return;
            }
        }
    }

    public function hienThiForm() {
        $error = $this->error; // truyền lỗi vào view
        include __DIR__ . '/../View/AuthView.php';
    }
}

// xử lý request
$auth = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['dangky'])) $auth->dangKy();
    else if (isset($_POST['dangnhap'])) $auth->dangNhap();
}

// luôn hiển thị form 1 lần duy nhất
$auth->hienThiForm();
?>
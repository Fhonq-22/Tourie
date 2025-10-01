<?php
    session_start();
    require_once __DIR__ . '/../Model/NguoiDungModel.php';

    class AuthController {
        private $model;

        public function __construct() {
            $this->model = new NguoiDungModel();
        }

        // hiển thị view đăng nhập/đăng ký
        public function hienThiForm() {
            include __DIR__ . '/../View/AuthView.php';
        }

        // xử lý đăng ký
        public function dangKy() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dangky'])) {
                $hoten = trim($_POST['hoten']);
                $email = trim($_POST['email']);
                $matkhau = $_POST['matkhau'];

                // kiểm tra email đã tồn tại chưa
                if ($this->model->layTheoEmail($email)) {
                    $error = "Email đã được sử dụng!";
                    include "../View/AuthView.php";
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
                header("Location: index.php"); // chuyển về trang chính sau khi đăng ký
                exit;
            }
        }

        // xử lý đăng nhập
        public function dangNhap() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dangnhap'])) {
                $email = trim($_POST['email']);
                $matkhau = $_POST['matkhau'];

                $nguoiDung = $this->model->dangNhap($email, $matkhau);

                if ($nguoiDung) {
                    $_SESSION['user'] = $nguoiDung;
                    header("Location: index.php"); // chuyển về trang chính sau khi đăng nhập
                    exit;
                } else {
                    $error = "Email hoặc mật khẩu không đúng!";
                    include __DIR__ . '/../View/AuthView.php';
                }
            }
        }

        // xử lý đăng xuất
        public function dangXuat() {
            session_destroy();
            header("Location: AuthController.php"); // quay lại form đăng nhập/đăng ký
            exit;
        }
    }

    // xử lý request
    $auth = new AuthController();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['dangky'])) $auth->dangKy();
        else if (isset($_POST['dangnhap'])) $auth->dangNhap();
    } else if (isset($_GET['logout'])) {
        $auth->dangXuat();
    } else {
        $auth->hienThiForm();
    }
?>
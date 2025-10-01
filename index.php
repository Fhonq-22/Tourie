<?php
    // Lấy URL từ .htaccess, ví dụ /dang-nhap hoặc /dang-ky
    $url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';

    // định nghĩa route
    switch ($url) {
        case '':
        case 'trang-chu':
            // bạn có thể hiển thị trang danh sách người dùng ở đây
            require_once 'Controller/NguoiDungController.php';
            $controller = new NguoiDungController();
            $controller->index(); // phương thức hiển thị danh sách
            break;

        case 'dang-nhap':
            require_once 'Controller/AuthController.php';
            $controller = new AuthController();
            $controller->dangNhap();
            break;

        case 'dang-ky':
            require_once 'Controller/AuthController.php';
            $controller = new AuthController();
            $controller->dangKy();
            break;

        case 'dang-xuat':
            require_once 'Controller/AuthController.php';
            $controller = new AuthController();
            $controller->dangXuat();
            break;

        case 'chinh-sach':
            include __DIR__ . '/View/ChinhSachQRT.php';
            break;
        case 'dieu-khoan':
            include __DIR__ . '/View/DieuKhoanSD.php';
            break;

        default:
            // nếu URL không khớp, hiển thị 404
            http_response_code(404);
            echo "Trang không tồn tại!";
            break;
    }
?>
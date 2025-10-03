<?php
    $adminUrl = isset($_GET['url']) ? trim($_GET['url'], '/') : '';

    switch ($adminUrl) {
        case '':
        case 'dashboard':
            include __DIR__ . '/View/Admin/Dashboard.php';
            break;

        case 'nguoi-dung':
            require_once 'Controller/NguoiDungController.php';
            $controller = new NguoiDungController();
            $controller->index(); // phương thức hiển thị danh sách
            break;
            include __DIR__ . '/View/Admin/NguoiDung.php';
            break;

        case 'tour':
            include __DIR__ . '/View/Admin/Tour.php';
            break;

        case 'dat-tour':
            include __DIR__ . '/View/Admin/DatTour.php';
            break;

        case 'danh-gia':
            include __DIR__ . '/View/Admin/DanhGia.php';
            break;

        default:
            http_response_code(404);
            include __DIR__ . '/View/404.php';
            break;
    }
?>
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
            if (isset($_POST['add'])) $controller->add();
            elseif (isset($_POST['editAdmin'])) $controller->editAdmin();
            elseif (isset($_POST['editStatus'])) $controller->editStatus();
            elseif (isset($_GET['delete'])) $controller->delete();
            else $controller->index(); // hiển thị danh sách
            break;  
        case 'dia-diem':
            require_once 'Controller/DiaDiemController.php';
            $controller = new DiaDiemController();
            $controller->add();
            $controller->edit();
            $controller->delete();
            $controller->index();
            break;
        case 'chu-de-tour':
            require_once 'Controller/ChuDeTourController.php';
            $controller = new ChuDeTourController();
            $controller->add();
            $controller->edit();
            $controller->delete();
            $controller->index();
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
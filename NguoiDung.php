<?php
// ====== KẾT NỐI MYSQL ======
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "QuanLyTour";
$tblname = "NguoiDung";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// ====== XỬ LÝ FORM ======
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $hoten  = $_POST['hoten'];
        $email = $_POST['email'];
        $matkhau = $_POST['matkhau'];
        $sdt = $_POST['sdt'];
        $diachi = $_POST['diachi'];
        $gioitinh = $_POST['gioitinh'];
        $ngaysinh = $_POST['ngaysinh'];
        $loainguoidung = $_POST['loainguoidung'];
        $trangthai = $_POST['trangthai'];
        $vitrilat = $_POST['vitrilat'];
        $vitrilng = $_POST['vitrilng'];
        $ngaydangky = $_POST['ngaydangky'];
        $ngaycapnhat = $_POST['ngaycapnhat'];


        $stmt = $conn->prepare("INSERT INTO $tblname (name, price) VALUES (?, ?)");
        $stmt->bind_param("sd", $name, $price);
        $stmt->execute();
        $stmt->close();
    }

    // SỬA sản phẩm
    if (isset($_POST['edit'])) {
        $id    = $_POST['id'];
        $name  = $_POST['name'];
        $price = $_POST['price'];

        $stmt = $conn->prepare("UPDATE $tblname SET name=?, price=? WHERE id=?");
        $stmt->bind_param("sdi", $name, $price, $id);
        $stmt->execute();
        $stmt->close();
    }
}

// XÓA sản phẩm
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM $tblname WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// ====== LẤY DANH SÁCH SẢN PHẨM ======
$result = $conn->query("SELECT * FROM $tblname ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>
    <style>
        table { border-collapse: collapse; width: 60%; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: center; }
    </style>
</head>
<body>
    <h2>Thêm sản phẩm</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Tên sản phẩm" required>
        <input type="number" step="0.01" name="price" placeholder="Giá" required>
        <button type="submit" name="add">Thêm</button>
    </form>

    <h2>Danh sách sản phẩm</h2>
    <table>
        <tr>
            <th>ID</th><th>Tên sản phẩm</th><th>Giá</th><th>Hành động</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= number_format($row['price'], 2) ?></td>
                <td>
                    <!-- Nút XÓA -->
                    <a href="$tblname.php?delete=<?= $row['id'] ?>" onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>

                    <!-- Form SỬA -->
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required>
                        <input type="number" step="0.01" name="price" value="<?= $row['price'] ?>" required>
                        <button type="submit" name="edit">Sửa</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
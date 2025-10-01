<?php
require_once "db.php";

class NguoiDungModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // lấy tất cả người dùng (dùng cho admin)
    public function getAll() {
        $result = $this->db->conn->query("SELECT * FROM NguoiDung ORDER BY MaND DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // lấy người dùng theo id
    public function getById($id) {
        $stmt = $this->db->conn->prepare("SELECT * FROM NguoiDung WHERE MaND=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $res;
    }

    // thêm người dùng (dùng cho đăng ký hoặc admin thêm)
    public function add(array $data) {
        extract($data);
        $matkhau = password_hash($matkhau, PASSWORD_DEFAULT);
        $stmt = $this->db->conn->prepare("INSERT INTO NguoiDung (HoTen, Email, MatKhau, SDT, DiaChi, GioiTinh, NgaySinh, ViTriLat, ViTriLng) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $hoten, $email, $matkhau, $sdt, $diachi, $gioitinh, $ngaysinh, $vitrilat, $vitrilng);
        $stmt->execute();
        $stmt->close();
    }

    // xóa người dùng (dùng cho admin)
    public function delete($id) {
        $stmt = $this->db->conn->prepare("DELETE FROM NguoiDung WHERE MaND=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    // cập nhật người dùng (dùng cho admin)
    public function update($id, $data) {
        $stmt = $this->db->conn->prepare(
            "UPDATE NguoiDung 
            SET HoTen=?, Email=?, MatKhau=?, SDT=?, DiaChi=?, GioiTinh=?, NgaySinh=?, ViTriLat=?, ViTriLng=? 
            WHERE MaND=?"
        );
        $stmt->bind_param(
            "sssssssssi",
            $data['hoten'],
            $data['email'],
            password_hash($data['matkhau'], PASSWORD_DEFAULT),
            $data['sdt'] ?? null,
            $data['diachi'] ?? null,
            $data['gioitinh'] ?? null,
            $data['ngaysinh'] ?? null,
            $data['vitrilat'] ?? null,
            $data['vitrilng'] ?? null,
            $id
        );
        $stmt->execute();
        $stmt->close();
    }

    // kiểm tra đăng nhập
    public function dangNhap($value, $matkhau, $type = 'email') {
        if ($type === 'sdt') $col = 'SDT';
        else if ($type === 'mand') $col = 'MaND';
        else $col = 'Email';

        $stmt = $this->db->conn->prepare("SELECT * FROM NguoiDung WHERE $col = ?");
        $stmt->bind_param("s", $value);
        $stmt->execute();
        $result = $stmt->get_result();
        $nguoiDung = $result->fetch_assoc();

        if ($nguoiDung && password_verify($matkhau, $nguoiDung['MatKhau'])) {
            return $nguoiDung; // đăng nhập thành công
        }
        return false; // thất bại
    }
}
?>
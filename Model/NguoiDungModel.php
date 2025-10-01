<?php
    require_once "db.php";

    class NguoiDungModel {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function getAll() {
            $result = $this->db->conn->query("SELECT * FROM NguoiDung ORDER BY MaND DESC");
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getById($id) {
            $stmt = $this->db->conn->prepare("SELECT * FROM NguoiDung WHERE MaND=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $res = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $res;
        }

        public function add($data) {
            $stmt = $this->db->conn->prepare("INSERT INTO NguoiDung (HoTen, Email, MatKhau, SDT, DiaChi, GioiTinh, NgaySinh, ViTriLat, ViTriLng) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param(
                "sssssssss",
                $data['hoten'],
                $data['email'],
                $data['matkhau'],
                $data['sdt'],
                $data['diachi'],
                $data['gioitinh'],
                $data['ngaysinh'],
                $data['vitrilat'],
                $data['vitrilng']
            );
            $stmt->execute();
            $stmt->close();
        }

        public function delete($id) {
            $stmt = $this->db->conn->prepare("DELETE FROM NguoiDung WHERE MaND=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }

        public function update($id, $data) {
            $stmt = $this->db->conn->prepare("UPDATE NguoiDung SET HoTen=?, Email=?, MatKhau=?, SDT=?, DiaChi=?, GioiTinh=?, NgaySinh=?, ViTriLat=?, ViTriLng=? WHERE MaND=?");
            $stmt->bind_param(
                "sssssssssi",
                $data['hoten'],
                $data['email'],
                $data['matkhau'],
                $data['sdt'],
                $data['diachi'],
                $data['gioitinh'],
                $data['ngaysinh'],
                $data['vitrilat'],
                $data['vitrilng'],
                $id
            );
            $stmt->execute();
            $stmt->close();
        }
    }
?>
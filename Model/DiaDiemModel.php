<?php
require_once "db.php";

class DiaDiemModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // lấy toàn bộ danh sách địa điểm
    public function getAll() {
        $result = $this->db->conn->query("SELECT * FROM DiaDiem ORDER BY MaDD DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // lấy 1 địa điểm theo id
    public function getById($id) {
        $stmt = $this->db->conn->prepare("SELECT * FROM DiaDiem WHERE MaDD = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $res;
    }

    // thêm địa điểm mới
    public function add(array $data) {
        extract($data);
        $stmt = $this->db->conn->prepare("
            INSERT INTO DiaDiem (TenDD, DiaChi, MoTa, AnhDaiDien, ViTriLat, ViTriLng, LinkMap)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("ssssdds", $TenDD, $DiaChi, $MoTa, $AnhDaiDien, $ViTriLat, $ViTriLng, $LinkMap);
        $stmt->execute();
        $stmt->close();
    }

    // cập nhật thông tin địa điểm
    public function update($id, array $data) {
        extract($data);
        $stmt = $this->db->conn->prepare("
            UPDATE DiaDiem
            SET TenDD=?, DiaChi=?, MoTa=?, AnhDaiDien=?, ViTriLat=?, ViTriLng=?, LinkMap=?
            WHERE MaDD=?
        ");
        $stmt->bind_param("ssssddsi", $TenDD, $DiaChi, $MoTa, $AnhDaiDien, $ViTriLat, $ViTriLng, $LinkMap, $id);
        $stmt->execute();
        $stmt->close();
    }

    // xóa địa điểm
    public function delete($id) {
        $stmt = $this->db->conn->prepare("DELETE FROM DiaDiem WHERE MaDD = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}
?>
<?php
require_once "db.php";

class DiaDiemModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $sql = "SELECT * FROM DiaDiem ORDER BY NgayCapNhat DESC";
        return $this->db->conn->query($sql);
    }

    public function getById($id) {
        $stmt = $this->db->conn->prepare("SELECT * FROM DiaDiem WHERE MaDD = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function add($data) {
        $stmt = $this->db->conn->prepare("
            INSERT INTO DiaDiem (TenDD, DiaChi, MoTa, AnhDaiDien, ViTriLat, ViTriLng, LinkMap)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("ssssdds", 
            $data['TenDD'], 
            $data['DiaChi'], 
            $data['MoTa'], 
            $data['AnhDaiDien'], 
            $data['ViTriLat'], 
            $data['ViTriLng'], 
            $data['LinkMap']
        );
        return $stmt->execute();
    }

    public function update($id, $data) {
        $stmt = $this->db->conn->prepare("
            UPDATE DiaDiem SET 
                TenDD=?, DiaChi=?, MoTa=?, AnhDaiDien=?, 
                ViTriLat=?, ViTriLng=?, LinkMap=? 
            WHERE MaDD=?
        ");
        $stmt->bind_param("ssssddsi", 
            $data['TenDD'], 
            $data['DiaChi'], 
            $data['MoTa'], 
            $data['AnhDaiDien'], 
            $data['ViTriLat'], 
            $data['ViTriLng'], 
            $data['LinkMap'], 
            $id
        );
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->conn->prepare("DELETE FROM DiaDiem WHERE MaDD=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
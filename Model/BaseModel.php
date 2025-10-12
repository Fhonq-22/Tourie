<?php
require_once "db.php";

class BaseModel {
    protected $db;
    protected $table;
    protected $primaryKey;

    public function __construct($table, $primaryKey = 'id') {
        $this->db = new Database();
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    public function getAll() {
        $sql = "SELECT * FROM {$this->table} ORDER BY {$this->primaryKey} DESC";
        $result = $this->db->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->conn->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $res;
    }

    public function insert($data) {
        // lọc bỏ các giá trị null hoặc chuỗi rỗng
        $data = array_filter($data, fn($v) => $v !== null && $v !== '');

        if (empty($data)) return;

        $columns = implode(",", array_keys($data));
        $placeholders = implode(",", array_fill(0, count($data), "?"));
        $types = $this->detectTypes($data);

        $stmt = $this->db->conn->prepare("INSERT INTO {$this->table} ($columns) VALUES ($placeholders)");
        $stmt->bind_param($types, ...array_values($data));
        $stmt->execute();
        $stmt->close();
    }

    public function update($id, $data) {
        // lọc bỏ các giá trị null hoặc chuỗi rỗng
        $data = array_filter($data, fn($v) => $v !== null && $v !== '');

        if (empty($data)) return;

        $set = implode(",", array_map(fn($col) => "$col = ?", array_keys($data)));
        $types = $this->detectTypes($data) . "i";
        $values = array_merge(array_values($data), [$id]);
        
        $stmt = $this->db->conn->prepare("UPDATE {$this->table} SET $set WHERE {$this->primaryKey} = ?");
        $stmt->bind_param($types, ...$values);
        $stmt->execute();
        $stmt->close();
    }

    public function delete($id) {
        $stmt = $this->db->conn->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    // tự nhận dạng kiểu dữ liệu
    private function detectTypes($data) {
        $types = '';
        foreach ($data as $value) {
            if (is_int($value)) $types .= 'i';
            elseif (is_float($value)) $types .= 'd';
            else $types .= 's';
        }
        return $types;
    }
}
?>
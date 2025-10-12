<?php
require_once "BaseModel.php";

class ChuDeTour {
    public int $MaChuDe;
    public string $TenChuDe;
    public ?string $MoTa = null;
    public ?string $NgayTao = null;
    public ?string $NgayCapNhat = null;

    public function __construct(array $data = []) {
        foreach ($data as $k => $v)
            if (property_exists($this, $k)) $this->$k = $v;
    }

    public function toArray(): array {
        return get_object_vars($this);
    }

    public function getMoTaNgan(): string {
        return mb_substr($this->MoTa ?? '', 0, 22) . '...';
    }
}

class ChuDeTourModel extends BaseModel {
    public function __construct() {
        parent::__construct("ChuDeTour", "MaChuDe");
    }

    public function getAll(): array {
        return array_map(fn($r) => new ChuDeTour($r), parent::getAll());
    }

    public function getById($id): ?ChuDeTour {
        $r = parent::getById($id);
        return $r ? new ChuDeTour($r) : null;
    }

    public function add(ChuDeTour $c): void {
        $data = $c->toArray();
        unset($data['MaChuDe'], $data['NgayTao'], $data['NgayCapNhat']);
        parent::insert($data);
    }

    public function update($id, $data): void {
        if ($data instanceof ChuDeTour) {
            $arr = $data->toArray();
            unset($arr['MaChuDe'], $arr['NgayTao'], $arr['NgayCapNhat']);
            $data = $arr;
        }
        parent::update($id, $data);
    }

    public function delete($id): void {
        parent::delete($id);
    }
}
?>
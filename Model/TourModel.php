<?php
require_once "BaseModel.php";

class Tour {
    public int $MaTour;
    public string $TenTour;
    public ?string $MoTa = null;
    public ?string $LoaiTour = null;
    public ?int $MaChuDe = null;
    public ?int $MaDiaDiemDi = null;
    public ?int $MaDiaDiemDen = null;
    public ?string $NgayKhoiHanh = null;
    public ?string $NgayKetThuc = null;
    public ?float $Gia = null;
    public ?int $SoCho = null;
    public ?string $AnhDaiDien = null;
    public ?string $TrangThai = null;
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
        return mb_substr($this->MoTa ?? '', 0, 12) . '...';
    }

    public function getDinhDangGia(): string {
    if (!isset($this->Gia)) {
        return '';
    }
    return number_format((float)$this->Gia, 0, '.', ',');
}

}

class TourModel extends BaseModel {
    public function __construct() {
        parent::__construct("Tour", "MaTour");
    }

    public function getAll(): array {
        return array_map(fn($r) => new Tour($r), parent::getAll());
    }

    public function getById($id): ?Tour {
        $r = parent::getById($id);
        return $r ? new Tour($r) : null;
    }

    public function add(Tour $t): void {
        $data = $t->toArray();
        unset($data['MaTour'], $data['TrangThai'], $data['NgayTao'], $data['NgayCapNhat']);
        parent::insert($data);
    }

    public function edit(Tour $t): void {
        $data = $t->toArray();
        unset($data['MaTour'], $data['NgayTao'], $data['NgayCapNhat']);
        parent::update($t->MaTour, $data);
    }

    public function delete($id): void {
        parent::delete($id);
    }
}
?>
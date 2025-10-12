function moPopupThem() {
  document.getElementById('popupThem').style.display = 'block';
}

function dongPopupThem() {
  document.getElementById('popupThem').style.display = 'none';
}

function moPopupSua() {
  document.getElementById('popupSua').style.display = 'block';
}

function dongPopupSua() {
  document.getElementById('popupSua').style.display = 'none';
}

document.querySelectorAll('.btn-edit').forEach(btn => {
  btn.addEventListener('click', () => {
    const data = JSON.parse(btn.dataset.row);
    document.getElementById('edit_MaChuDe').value = data.MaChuDe;
    document.getElementById('edit_TenChuDe').value = data.TenChuDe;
    document.getElementById('edit_MoTa').value = data.MoTa;
    document.getElementById('formSua').action = `?controller=chudetour&action=update&id=${data.MaChuDe}`;
    moPopupSua();
  });
});
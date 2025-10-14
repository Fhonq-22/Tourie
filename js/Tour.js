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
    document.getElementById('edit_MaTour').value = data.MaTour;
    document.getElementById('edit_TenTour').value = data.TenTour;
    document.getElementById('edit_MoTa').value = data.MoTa;
    document.getElementById('formSua').action = `?controller=tour&action=update&id=${data.MaTour}`;
    moPopupSua();
  });
});
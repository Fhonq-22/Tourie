function moPopupThem() {
    document.getElementById('popupThem').style.display = 'flex';
}
function dongPopupThem() {
    document.getElementById('popupThem').style.display = 'none';
}

document.querySelectorAll('.btn-edit').forEach(btn => {
  btn.addEventListener('click', () => {
    const data = JSON.parse(btn.getAttribute('data-row'));
    moPopupSua(data);
  });
});
function moPopupSua(data) {
  document.getElementById('popupSua').style.display = 'flex';
  document.getElementById('edit_MaDD').value = data.MaDD;
  document.getElementById('edit_TenDD').value = data.TenDD;
  document.getElementById('edit_DiaChi').value = data.DiaChi;
  document.getElementById('edit_MoTa').value = data.MoTa;
  document.getElementById('edit_AnhLink').value = data.AnhDaiDien ?? '';
  document.getElementById('edit_ViTriLat').value = data.ViTriLat;
  document.getElementById('edit_ViTriLng').value = data.ViTriLng;
  document.getElementById('edit_LinkMap').value = data.LinkMap ?? '';
}
function dongPopupSua() {
    document.getElementById('popupSua').style.display = 'none';
}

function phanTichLink(btn) {
  const form = btn.closest("form");
  const linkInput = form.querySelector("input[name='LinkMap']");
  const latInput = form.querySelector("input[name='ViTriLat']");
  const lngInput = form.querySelector("input[name='ViTriLng']");
  const link = linkInput?.value.trim();

  if (!link) {
    alert("vui lòng nhập link bản đồ trước!");
    return;
  }

  let lat = "", lng = "";

  const match1 = link.match(/[?&]q=(-?\d+(\.\d+)?),(-?\d+(\.\d+)?)/);
  if (match1) [lat, lng] = [match1[1], match1[3]];

  const match2 = link.match(/#map=\d+\/(-?\d+(\.\d+)?)\/(-?\d+(\.\d+)?)/);
  if (!lat && match2) [lat, lng] = [match2[1], match2[3]];

  const match3 = link.match(/(-?\d+(\.\d+)?)[,\s]+(-?\d+(\.\d+)?)/);
  if (!lat && match3) [lat, lng] = [match3[1], match3[3]];

  if (lat && lng) {
    latInput.value = lat;
    lngInput.value = lng;
    alert("đã tách tọa độ thành công!");
  } else {
    alert("không thể phân tích được tọa độ, hãy kiểm tra lại link.");
  }
}
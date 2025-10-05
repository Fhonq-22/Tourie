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

function phanTichLink() {
  const link = document.getElementById('linkmap').value.trim();
  if (!link) {
    alert("Vui lòng nhập link bản đồ trước!");
    return;
  }

  let lat = "", lng = "";

  // 1️⃣ google maps dạng ?q=LAT,LNG
  const match1 = link.match(/[?&]q=(-?\d+(\.\d+)?),(-?\d+(\.\d+)?)/);
  if (match1) {
    lat = match1[1];
    lng = match1[3];
  }

  // 2️⃣ openstreetmap dạng #map=zoom/LAT/LNG
  const match2 = link.match(/#map=\d+\/(-?\d+(\.\d+)?)\/(-?\d+(\.\d+)?)/);
  if (!lat && match2) {
    lat = match2[1];
    lng = match2[3];
  }

  // 3️⃣ nhập trực tiếp lat,lng
  const match3 = link.match(/(-?\d+(\.\d+)?)[,\s]+(-?\d+(\.\d+)?)/);
  if (!lat && match3) {
    lat = match3[1];
    lng = match3[3];
  }

  if (lat && lng) {
    document.getElementById('vitrilat').value = lat;
    document.getElementById('vitrilng').value = lng;
    alert("Đã tách tọa độ thành công!");
  } else {
    alert("Không thể phân tích được tọa độ, hãy kiểm tra lại link.");
  }
}
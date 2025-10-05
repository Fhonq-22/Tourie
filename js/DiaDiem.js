function moPopupThem() {
    document.getElementById('popupThem').style.display = 'flex';
}
function dongPopupThem() {
    document.getElementById('popupThem').style.display = 'none';
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
function moPopupThem() {
    document.getElementById('popupThem').style.display = 'flex';
}
function dongPopupThem() {
    document.getElementById('popupThem').style.display = 'none';
}

async function LayViTri() {
    if (!navigator.geolocation) {
        alert("Trình duyệt không hỗ trợ định vị.");
        return;
    }

    navigator.geolocation.getCurrentPosition(async pos => {
        const lat = pos.coords.latitude;
        const lng = pos.coords.longitude;
        document.getElementById('vitrilat').value = lat;
        document.getElementById('vitrilng').value = lng;

        try {
            const res = await fetch(`/Tourie/Controller/DiaDiemController.php?lat=${lat}&lon=${lng}`);
            if (!res.ok) throw new Error("Không thể lấy địa chỉ");
            const data = await res.json();
            document.getElementById('diachi').value = data.display_name || "";
        } catch (err) {
            console.error(err);
            alert("Lấy địa chỉ thất bại");
        }
    }, err => {
        alert("Không lấy được vị trí: " + err.message);
    });
}
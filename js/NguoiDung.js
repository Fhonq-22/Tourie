function moPopupThem() {
    document.getElementById('popupThem').style.display = 'flex';
}

function dongPopupThem() {
    document.getElementById('popupThem').style.display = 'none';
}

function moPopupSua(maND, hoTen, trangThai) {
    const popup = document.getElementById('popupSua');
    popup.style.display = 'flex';
    document.getElementById('idcansua').value = maND;
    document.getElementById('hotencansua').value = hoTen;
    document.getElementById('trangthaicansua').value = trangThai;
}

function dongPopupSua() {
    document.getElementById('popupSua').style.display = 'none';
}

function moPopupSuaAdmin(maND) {
    const row = Array.from(document.querySelectorAll("table tr")).find(tr => tr.children[0].textContent == maND);
    if (!row) return;

    document.getElementById('idAdmin').value = maND;
    document.getElementById('hotenAdmin').value = row.children[1].textContent;
    document.getElementById('emailAdmin').value = row.children[2].textContent;
    document.getElementById('sdtAdmin').value = row.children[3].textContent;
    document.getElementById('diachiAdmin').value = row.children[4].textContent;
    document.getElementById('gioitinhAdmin').value = row.children[5].textContent;
    document.getElementById('ngaysinhAdmin').value = row.children[6].textContent;
    document.getElementById('trangthaiAdmin').value = row.children[8].textContent;

    document.getElementById('popupSuaAdmin').style.display = 'flex';
}

function dongPopupSuaAdmin() {
    document.getElementById('popupSuaAdmin').style.display = 'none';
}


async function LayViTri() {
    if (!navigator.geolocation) {
        alert("Trình duyệt không hỗ trợ geolocation");
        return;
    }

    navigator.geolocation.getCurrentPosition(async pos => {
        const lat = pos.coords.latitude;
        const lng = pos.coords.longitude;

        document.getElementById('vitrilat').value = lat;
        document.getElementById('vitrilng').value = lng;

        try {
            const url = new URL("../Controller/NguoiDungController.php", window.location.href);
            url.searchParams.set("lat", lat);
            url.searchParams.set("lon", lng);

            const res = await fetch(url);
            if (!res.ok) throw new Error("Không thể lấy địa chỉ");

            const data = await res.json();
            document.getElementById('diachi').value = data.display_name || "";
        } catch (err) {
            console.error(err);
            alert("Lấy địa chỉ thất bại");
        }
    }, err => {
        console.error(err);
        alert("Lấy vị trí thất bại: " + err.message);
    });
}

async function LayViTriAdmin() {
    if (!navigator.geolocation) {
        alert("Trình duyệt không hỗ trợ geolocation");
        return;
    }

    navigator.geolocation.getCurrentPosition(async pos => {
        const lat = pos.coords.latitude;
        const lng = pos.coords.longitude;

        document.getElementById('vitrilatAdmin').value = lat;
        document.getElementById('vitrilngAdmin').value = lng;

        try {
            const url = new URL("../Controller/NguoiDungController.php", window.location.href);
            url.searchParams.set("lat", lat);
            url.searchParams.set("lon", lng);

            const res = await fetch(url);
            if (!res.ok) throw new Error("Không thể lấy địa chỉ");

            const data = await res.json();
            document.getElementById('diachiAdmin').value = data.display_name || "";
        } catch (err) {
            console.error(err);
            alert("Lấy địa chỉ thất bại");
        }
    }, err => {
        console.error(err);
        alert("Lấy vị trí thất bại: " + err.message);
    });
}
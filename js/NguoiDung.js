function openForm(){ document.getElementById('popupForm').style.display='flex'; }
function closeForm(){ document.getElementById('popupForm').style.display='none'; }

async function LayViTri(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(async pos=>{
            let lat = pos.coords.latitude;
            let lng = pos.coords.longitude;

            document.getElementById('vitrilat').value = lat;
            document.getElementById('vitrilng').value = lng;

            let res = await fetch(`NguoiDungController.php?lat=${lat}&lon=${lng}`);
            let data = await res.json();
            document.getElementById('diachi').value = data.display_name;
        });
    }else alert("Trình duyệt không hỗ trợ geolocation");
}

const tabs = document.querySelectorAll('.tab-btn');
const forms = document.querySelectorAll('.tab-form');

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        const target = tab.dataset.tab;
        forms.forEach(f => f.classList.remove('active'));
        document.getElementById(target).classList.add('active');
    });
});

const toast = document.getElementById('toast');
if (toast.textContent.trim() !== "") {
    toast.classList.add('show');
    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}

const loginInput = document.querySelector('input[name="login"]');
const loginLabel = document.getElementById('login-label');
const btns = document.querySelectorAll('.btn-login-type');

let currentType = 'email'; // mặc định

function updateButtons() {
    btns.forEach(btn => {
        btn.style.display = btn.dataset.type === currentType ? 'none' : 'inline-block';
    });
}

btns.forEach(btn => {
    btn.addEventListener('click', () => {
        currentType = btn.dataset.type;

        if (currentType === 'email') {
            loginLabel.textContent = 'Email:';
            loginInput.type = 'text';
            loginInput.name = 'email';
            loginInput.placeholder = 'VD: vidu@gmail.com...';
        } else if (currentType === 'sdt') {
            loginLabel.textContent = 'Số điện thoại:';
            loginInput.type = 'text';
            loginInput.name = 'sdt';
            loginInput.placeholder = 'VD: 0123456789...';
        } else if (currentType === 'mand') {
            loginLabel.textContent = 'Mã người dùng:';
            loginInput.type = 'number';
            loginInput.name = 'mand';
            loginInput.placeholder = 'VD: 1, 22, 333...';
        }

        loginInput.focus();
        updateButtons();
    });
});

// khởi tạo lần đầu
updateButtons();
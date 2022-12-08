document.querySelector('.form').addEventListener('submit', async (event) => {
    event.preventDefault();
    await onSubmit();
})
localStorage.clear();
async function onSubmit() {
    const form = document.forms['loginForm'];
    const inputEmail = document.getElementById('email');
    const inputPassword =  document.getElementById('password');
    try {
        const response = await fetch(
            `http://bookDambinov2:80/backend/user/auth`, {
                method: 'POST',
                body:  JSON.stringify({ email: inputEmail.value, password: inputPassword.value }),
            },
        );
        const result = await response.json();
        const  { data } = await result;
        if(data === 'admin') {
            localStorage.setItem('role', data);
            window.location.href = './admin.php';
        } else {
            localStorage.setItem('role', data.role);
            if(!(data.status === 'allow') )  {
                throw new Error();
            }
            if(!(data.status === 'allow') )  {
                throw new Error('error');
            }
            notify({ msg: 'Успешный вход', className: 'alert-success' });
            localStorage.setItem('login', data.login);
            localStorage.setItem('email', data.email);
            localStorage.setItem('avatar', data.image);
            localStorage.setItem('status', data.status);
            localStorage.setItem('id', data.id);
            window.location.href = './index.php';
        }
    } catch (err) {
        notify({ msg: 'Ошибка авторизации', className: 'alert-danger' });
        document.getElementById('btn_submit').style.border = 'red 3px solid';
    }
}
const notify = (response) => {
    const message_area = document.getElementById("response_message");
    message_area.classList.add(response.className);
    message_area.value = response.msg;
}

 async function registration(email, login, password) {
    try {
        const response = await fetch(
            `http://bookDambinov2:80/backenduser/reg`, {
                method: 'POST',
                body:  JSON.stringify({ email,login ,password }),
            },
        );
        const reslove = await response.json()
        const res = JSON.parse(reslove);
        if(res.data === "admin") {
            localStorage.setItem('status', 'admin')
        } else {
            localStorage.setItem('email', res.data.id);
            localStorage.setItem('email', res.data.email);
            localStorage.setItem('login', res.data.login);
        }
    }
    catch(e) {
        return Promise.reject(e);
    }
}
 async function login(email, password) {
    try {


        return await response.json();
    } catch (err) {
        return Promise.reject(err);
    }
}
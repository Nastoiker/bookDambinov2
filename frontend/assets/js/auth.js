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
            `http://bookservice:88/user/auth`, {
                method: 'POST',
                body:  JSON.stringify({ email: inputEmail.value, password: inputPassword.value }),
            },
        );
        const result = await response.json();
        console.log(result);
        const  { data } = await result;
        if(data === 'admin') {
            localStorage.setItem('role', data);
        }
        if(!(data.status === 'allow') )  {
            throw new Error();
        }
        if(!(data.status === 'allow') )  {
            throw new Error('error');
        }
        notify({ msg: 'Успешный вход', className: 'alert-success' });
        localStorage.setItem('role', data.role);
        localStorage.setItem('login', data.login);
        localStorage.setItem('email', data.email);
        localStorage.setItem('avatar', data.image);
        localStorage.setItem('status', data.status);
        localStorage.setItem('id', data.id);
        console.log(localStorage);
        window.location.href = './index.php';
    } catch (err) {
        console.log(err.message);
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
            `http://bookservice:88/user/reg`, {
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
        console.log(JSON.stringify({ email, password }));


        return await response.json();
    } catch (err) {
        console.log(err);
        return Promise.reject(err);
    }
}
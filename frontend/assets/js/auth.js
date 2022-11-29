async function onSubmit() {
    const inputEmail = document.getElementById('email');
    const inputPassword =  document.getElementById('password');
    const form = document.forms['loginForm'];
    try {
        const response = await login(inputEmail.value, inputPassword.value);
        const result = await response.json();
        const  { data } = await JSON.parse(result);
        if(data === 'admin') {
            localStorage.setItem('role', data);
            window.location.href('index.php');
        }
        if(!(data.status === 'allow') )  {
            throw new Error();
        }
        if(!(data.status === 'allow') )  {
            throw new Error();
        }
        notify({ msg: 'Успешный вход', className: 'alert-success' });
        localStorage.setItem('role', data.role);
        localStorage.setItem('login', data.login);
        localStorage.setItem('email', data.email);
        localStorage.setItem('avatar', data.image);
        form.reset();
    } catch (err) {
        notify({ msg: 'Ошибка авторизации', className: 'alert-danger' });
    }
}
const notify = (response) => {
    const message_area = document.getElementById("response_message");
    message_area.classList.add(response.className);
    message_area.value = response.msg;
}
export async function registration(email, login, password) {
    try {
        const response = await fetch(
            `/auth/login`, {
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
export async function login(email, password) {
    try {
        const response = await fetch(
            `/auth/login`, {
                method: 'POST',
                body:  JSON.stringify({ email, password }),
            },
        );
        console.log(response);

        return response.json();
    } catch (err) {
        console.log(err);
        return Promise.reject(err);
    }
}
async function onSubmit() {
    const isValidForm = inputs.every(el => {
        const isValidInput = validate(el);
        if (!isValidInput) {
            showInputError(el);
        }
        return isValidInput;
    });

    if (!isValidForm) return;

    try {
        await login(inputEmail.value, inputPassword.value);
        await getNews();
        form.reset();
        notify({ msg: 'Login success', className: 'alert-success' });
    } catch (err) {
        notify({ mas: 'Login faild', className: 'alert-danger' });
    }
}
export const components = {
    form: document.forms['loginForm'],
    inputEmail: document.getElementById('email'),
    inputPassword: document.getElementById('password'),
};
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
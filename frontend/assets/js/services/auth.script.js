import axios from '../plugins/axios';


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

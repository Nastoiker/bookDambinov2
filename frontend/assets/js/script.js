async function getBooks() {
    return new Promise(resolve => fetch('http://bookservice:88/books').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
const passport = async () =>
{
    const res = await getBooks();
    let books = JSON.stringify(res);
    const res1 = JSON.parse(books);
    console.log(res1.books);
    showBook(res1.books);
}
const showBook = (arr) => {

    arr.forEach(book => {
        let container_book = document.querySelector('.container_book');
        container_book.innerHTML +=` <div class="card_book">
                <div class="info_book">
                    <div class="header-card">
                        <div>
                            <img src="assets/src/icons/star.svg" alt="star">
                            <span>${book.ratingAvg}</span>
                        </div>
                        <div>
                            <span>${book.ratingCount}</span>
                            <span>отзыв.</span>
                        </div>
                    </div>
                    <div class="img_book">
                        <img  src="../backend/Uploaded/Images/${book.book.img}" style="width:100%; height: 100%" alt="book">
                    </div>
                </div>
                <h4>${book.book.name}</h4>
                <button>Подробнее</button>
            </div>`
    })
}
passport();
class Products {

    render() {
        let htmlCatalog = '';

        CATALOG.forEach(({ id, name, price, img }) => {
            htmlCatalog += `
                <li>
                    <span>${name}</span>
                    <img src="${img}" />
                    <span>${price}</span>
                    <button>Добавить в корзину</button>
                </li>
            `;
        });

        const html = `
            <ul>
                ${htmlCatalog}
            </ul>
        `;

        ROOT_PRODUCTS.innerHTML = html;
    }
}

const productsPage = new Products();
productsPage.render();


import 'bootstrap/dist/css/bootstrap.css';
import '../css/style.css';

import UI from './config/ui.config';
import { validate } from './helpers/validate';
import { showInputError, removeInputError } from './views/form';
import { login } from './services/auth.service';
import { notify } from './views/notifications';
import { getNews } from './services/news.service';

const { form, inputEmail, inputPassword } = UI;
const inputs = [inputEmail, inputPassword];

form.addEventListener('submit', e => {
    e.preventDefault();
    onSubmit();
});
inputs.forEach(el => el.addEventListener('focus', () => removeInputError(el)));

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
export const components = {
    form: document.forms['loginForm'],
    inputEmail: document.getElementById('email'),
    inputPassword: document.getElementById('password'),
};

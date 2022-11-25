async function getBooks() {
    return new Promise(resolve => fetch('http://bookservice:88/books').then(e => e.json()).then(res => setTimeout(3000, resolve(res))));
}
const passport = async () =>
{
    const res = await getBooks();
    console.log(res);

}
console.log(passport());
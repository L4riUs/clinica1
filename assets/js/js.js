const btnCollapse = document.querySelector('#header-collapse');

btnCollapse.addEventListener('click', () => {
    document.querySelector('.header').classList.toggle('collapse');
    document.querySelector('.contenido').classList.toggle('content-uncollapse');
    document.querySelector('#header-collapse').classList.toggle('rotate180');
});
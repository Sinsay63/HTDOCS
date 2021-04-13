const bloc = document.querySelector('.bloc');


document.addEventListener('keydown', (ev) => {
    if (ev.code === 'ArrowUp') {
        console.log(ev);
        bloc.style.margin += `5px`;
    }
});
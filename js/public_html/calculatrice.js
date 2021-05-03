const numeros = document.querySelectorAll('.numero');
const operateurs = document.querySelectorAll('.operateur');
const screen = document.querySelector('.affichage');
let premierNombres = '';
let operateur = '';
let secondNombres = '';

numeros.forEach((elem) => {
    elem.addEventListener('click', () => {
        if (operateur === '') {
            if (premierNombres === '') {
                premierNombres = `${elem.id}`;
            }
            else {
                premierNombres = `${premierNombres}${elem.id}`;
            }
            screen.innerText = premierNombres;
        }
        else {
            secondNombres = `${secondNombres}${elem.id}`;
            screen.innerText = `${operateur}${secondNombres}`;
        }
    });
});

operateurs.forEach((ope) => {
    ope.addEventListener('click', () => {
        if (ope.id != 'egal') {
            if (premierNombres != '') {
                operateur = `${premierNombres}${ope.id}`;
                screen.innerText = `${operateur}`;
            }
        }
        else if (ope.id === 'egal' && premierNombres != '' && operateur != '' & secondNombres != '') {
            let calcul = screen.innerText.split('');
            let pos;
            console.log(calcul);
            calcul.forEach((el, index) => {
                if (el === 'plus' || el === 'moins' || el === 'fois') {
                    pos = index;
                }
            });
            const partie1 = parseInt(calcul.slice(0, pos).join(''));
            const partie2 = parseInt(calcul.slice(pos + 1).join(''));

            const Stringsigne = calcul.slice(pos, pos + 1).join('');
            let resultat;
            if (Stringsigne === 'plus') {
                resultat = partie1 + partie2;
            }
            else if (Stringsigne === 'moins') {
                resultat = partie1 - partie2;
            }
            else if (Stringsigne === 'fois') {
                resultat = partie1*partie2;
            }
            screen.innerText = resultat;
            premierNombres='';
            operateur='';
            secondNombres='';
        }
    });
});

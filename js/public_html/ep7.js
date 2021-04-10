let mysteryWord = prompt('Choisi ton mot mystère').toUpperCase().toString();
let guess = prompt('Donne une lettre').toUpperCase().toString();
let foundWord = "-".repeat(mysteryWord.length);
let test = foundWord.split('');
let test2 = mysteryWord.split('');
let pos = mysteryWord.indexOf(guess);

while (foundWord.indexOf('-') !== -1) {
    if(guess.length>1){
        alert('WESH C\'EST UNE LETTRE à LA FOIS');
    }
    else{
    if (pos !== -1) {
        for (let i = 0; i < mysteryWord.length; i++) {
            console.log(test[i]);
            if (test2[i] === guess) {
                test[i] = guess;
                foundWord = test.toString();
                alert(`Bien joué! : ${foundWord}`);
            }
        }
    } else {
        alert('LETTRE NON TROUVÉE');
    }
    if (foundWord.indexOf('-') !== -1) {
        guess = prompt('Donne une lettre').toUpperCase();
        pos = mysteryWord.indexOf(guess);
    }
    }
}
alert('VOUS AVEZ TROUVÉ LE MOT QUI ÉTAIT: ' + mysteryWord);
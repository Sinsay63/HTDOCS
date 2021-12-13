const request = new XMLHttpRequest();

request.onreadystatechange = () => {
    if (request.readyState === 4) {
        if (request.status === 200) {
            let response = request.responseText;
            console.log(response);
        }
        else {
            console.log("Une erreur est survenue.");
        }
    }
};
let objet = {
    "prenom": "Yanis",
    "nom": "Houdier"
};
request.open("POST", "index.php",true);
request.send(JSON.stringify(objet));


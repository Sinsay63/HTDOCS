window.onload = () => {


    let divEmplacementFiche = document.querySelectorAll(".emplacement-fiche");
    divEmplacementFiche.forEach((el) => {
        el.addEventListener("click", () => {
            const request = new XMLHttpRequest();
            request.onreadystatechange = () => {
                if (request.readyState === 4) {
                    if (request.status === 200) {
                        let response = request.responseText;
                        el.innerHTML = response;
                    }
                    else {
                        el.innerHTML = "<p>Fiche non trouvée</p>";
                    }
                }
            };
            request.open("GET", "fiches/" + el.id + ".html", true);
            request.send();
        });
    }
    );
    let divEmplacementCompetence = document.querySelectorAll(".emplacement-competences");
    divEmplacementCompetence.forEach((el) => {
        idAventurier = el.parentNode.id;
        const request = new XMLHttpRequest();
        request.open("GET", "ajax/ajax.php?id=" + idAventurier, true);
        el.addEventListener("click", () => {

            request.onreadystatechange = () => {
                if (request.readyState === 4) {
                    if (request.status === 200) {
                        let response = JSON.parse(request.responseText);
                        for (let i = 0; i < response.length; i++) {

                            let competence = response[i]["libelleCompetence"];
                            let niveau = response[i]["niveau"];
                            let divComp = document.createElement("div");
                            let pComp = document.createElement("p");
                            pComp.InnerText =
                                    el.innerHTML += "<p>Compétence " + competence + " " + niveau + "</p>";
                        }
                    }
                    else {
                        el.innerHTML = "<p>Pas de compétences trouvées</p>";
                    }
                }
            };
            request.send();
        });
    }
    );
    let inputDate = document.querySelectorAll('#birthDate');
    inputDate.forEach((el) => {
        const request = new XMLHttpRequest();
        request.open("GET", "ajax/dateBirth.php?id=" + el.parentNode.id, true);

        request.onreadystatechange = () => {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    let response = JSON.parse(request.responseText);
                    el.setAttribute("value", response['dateNaissance']);
                }
            }
        };
        request.send();

        el.addEventListener("focusout", () => {
            let newDate = el.value;
            const request = new XMLHttpRequest();
            request.open("POST", "ajax/updateDateBirth.php", true);

            request.onreadystatechange = () => {
                if (request.readyState === 4) {
                    if (request.status === 200) {
                        alert(newDate);
                    }
                }
            };
            let objet = {
                'idAventurier': el.parentNode.id,
                'dateNaissance' : newDate                
            };
            request.send(JSON.stringify(objet));

        });
    });
};
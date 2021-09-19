function TP() {

    let students = [
        {prenom: "Yanis", nom: " HOUDIER"},
        {prenom: "Nathim", nom: "RICHARD"},
        {prenom: "Tom", nom: "LEVEAU"},
        {prenom: "Loris", nom: "Terry"},
        {prenom: "Mathieu", nom: "BESSEYRE"}
    ];

    let body = document.querySelector("body");
    let div = document.createElement("div");
    div.setAttribute("style", "display:flex;");
    body.appendChild(div);
    let display = () => {
        students.forEach((value) => {
            let divS = document.createElement("div");
            let p = document.createElement("p");
            p.innerText = value.prenom + " " + value.nom;
            div.appendChild(divS);
            let image = document.createElement("img");
            image.setAttribute("src", "images/" + value.prenom.toLowerCase() + ".jpg");
            image.setAttribute("style", "height: 150px;");
            p.classList.add("nomOff");
            divS.appendChild(image);
            divS.appendChild(p);
            image.addEventListener("click", () => {
                if (p.classList.contains("nomOff")) {
                    p.classList.replace("nomOff", "nomOn");
                } else {
                    p.classList.replace("nomOn", "nomOff");
                }
            });
        });
    };
    display();
    let hideshow = document.createElement("button");
    hideshow.setAttribute("type", "button");
    hideshow.innerText = "Afficher les noms";
    body.appendChild(hideshow);
    hideshow.addEventListener("click", () => {
        let ps = document.querySelectorAll("p");
        if (hideshow.innerText === "Cacher les noms") {
            ps.forEach((p) => {
                if (p.classList.contains("nomOn")) {
                    p.classList.remove("nomOn");
                }
                p.classList.add("nomOff");
                hideshow.innerText = "Afficher les noms";
            });
        } else {
            ps.forEach((p) => {
                if (p.classList.contains("nomOff")) {
                    p.classList.remove("nomOff");
                }
                p.classList.add("nomOn");
                hideshow.innerText = "Cacher les noms";
            });
        }
    });
    let shuffler = document.createElement("button");
    shuffler.setAttribute("type", "button");
    shuffler.innerText = "Mélanger";
    body.appendChild(shuffler);

    shuffler.addEventListener("click", () => {
         for (var position = students.length - 1; position >= 1; position--) {
                var hasard = Math.floor(Math.random() * (position + 1));
                var sauve = students[position];
                students[position] = students[hasard];
                students[hasard] = sauve;
            }
            div.innerText = "";
        display();
    });
}

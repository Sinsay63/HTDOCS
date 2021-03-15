<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Questionnaire</title>
        <meta charset="UTF-8">
        <link href="pages.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Changa&family=Cinzel+Decorative:wght@700&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php
            $q1 = htmlspecialchars($_POST['q1']);
            $q2 = htmlspecialchars($_POST['q2']);
            $q3 = htmlspecialchars($_POST['q3']);
            $q4 = htmlspecialchars($_POST['q4']);
            $q5 = htmlspecialchars($_POST['q5']);
            $q6 = htmlspecialchars($_POST['q6']);
            $q7 = htmlspecialchars($_POST['q7']);
            $q8 = htmlspecialchars($_POST['q8']);
            $q9 = htmlspecialchars($_POST['q9']);
            $q10 = htmlspecialchars($_POST['q10']);
        ?>
        <div class="page-container">
            <div class="cotes"></div>
            <div class="midquest">
                <img class="banner" src="images/banner.jpg" alt=""/>
                <nav>
                    <ul>
                        <li><a class="btn-grad" href="index.html"><p class="txtnav">Synopsis</p></a></li>
                        <li><a class="btn-grad" href="perso.html" ><p class="txtnav">Personnages</p></a></li>
                        <li><a class="btn-grad" href="lieux.html"><p class="txtnav">Lieux</p></a></li>
                        <li><a class="btn-grad" href="questionnaire.html"><p class="txtnav">Quizz</p></a></li>
                    </ul>
                </nav>
                <div class="separe2">
                    <img class="img1" src="images/cote.png" alt=""/>
                    <img src="images/cote3.png" alt=""/>
                </div>
                <div class="diapo">
                    <div class="elements">
                        <div class="element ">
                            <img class="imageslide" src="images/wpmelio.png" alt="Image 1">
                            <div class="caption">
                                <p>Quel est le nombre de péchés capitaux?</p>
                                <p class="rep">Votre réponse:<br> <?php if (empty($q1)){ echo "Aucune réponse saisie"; } else{ echo $q1; }?> </p>
                                <p class="rep">Réponse attendue:<br> 7 </p>
                                <div class="prevnext">
                                    <button id="nav-gauche" type="button"> Précédent </button>
                                    <button id="nav-droite" type="button"> Suivant </button>
                                </div>
                            </div>
                        </div>
                        <div class="element">
                            <img class="imageslide" src="images/wpdiane.png" alt="Image 2">
                            <div class="caption">
                                <p>Comment s'appelle leur capitaine ?</p>
                                <p class="rep">Votre réponse:<br> <?php if (empty($q2)){ echo "Aucune réponse saisie"; } else{ echo $q2; }?> </p>
                                <p class="rep">Réponse attendue:<br> Meliodas </p>
                                <div class="prevnext">
                                    <button id="nav-gauche2" type="button"> Précédent </button>
                                    <button id="nav-droite2" type="button"> Suivant </button>
                                </div>
                            </div>
                        </div>
                        <div class="element">
                            <img class="imageslide" src="images/wpban.jpg" alt="Image 3">
                            <div class="caption">
                                <p>Dans quel royaume se déroule l'histoire?</p>
                                <p class="rep">Votre réponse:<br> <?php if (empty($q3)){ echo "Aucune réponse saisie"; } else{ echo $q3; }?> </p>
                                <p class="rep">Réponse attendue:<br> Royaume de Britannia</p>
                                <div class="prevnext">
                                    <button id="nav-gauche3" type="button"> Précédent </button>
                                    <button id="nav-droite3" type="button"> Suivant </button>
                                </div>
                            </div>
                        </div>
                        <div class="element">
                            <img class="imageslide" src="images/wpking.png" alt="Image 2">
                            <div class="caption">
                                <p>De quoi est recouvert la fôret des Rêves Blanc ?</p>
                                <p class="rep">Votre réponse:<br> <?php if (empty($q4)){ echo "Aucune réponse saisie"; } else{ echo $q4; }?> </p>
                                <p class="rep">Réponse attendue:<br> Un épais brouillard </p>
                                <div class="prevnext">
                                    <button id="nav-gauche4" type="button"> Précédent </button>
                                    <button id="nav-droite4" type="button"> Suivant </button>
                                </div>
                            </div>
                        </div>
                        <div class="element">
                            <img class="imageslide" src="images/wpgowther.jpg" alt="Image 2">
                            <div class="caption">
                                <p>A quel clan appartient King ?</p>
                                <p class="rep">Votre réponse:<br> <?php if (empty($q5)){ echo "Aucune réponse saisie"; } else{ echo $q5; }?> </p>
                                <p class="rep">Réponse attendue:<br> Le clan des Fées </p>
                                <div class="prevnext">
                                    <button id="nav-gauche5" type="button"> Précédent </button>
                                    <button id="nav-droite5" type="button"> Suivant </button>
                                </div>
                            </div>
                        </div>
                        <div class="element">
                            <img class="imageslide" src="images/wpmerlin.jpg" alt="Image 2">
                            <div class="caption">
                                <p>De qui est amoureux Escanor ?</p>
                                <p class="rep">Votre réponse:<br> <?php if (empty($q6)){ echo "Aucune réponse saisie"; } else{ echo $q6; }?> </p>
                                <p class="rep">Réponse attendue:<br> Merlin  </p>
                                <div class="prevnext">
                                    <button id="nav-gauche6" type="button"> Précédent </button>
                                    <button id="nav-droite6" type="button"> Suivant </button>
                                </div>
                            </div>
                        </div>
                        <div class="element">
                            <img class="imageslide" src="images/wpesca.png" alt="Image 2">
                            <div class="caption">
                                <p>Comment se nomme la taverne de Meliodas ? </p>
                                <p class="rep">Votre réponse:<br> <?php if (empty($q7)){ echo "Aucune réponse saisie"; } else{ echo $q7; }?> </p>
                                <p class="rep">Réponse attendue:<br> Le Boar Hat</p>
                                <div class="prevnext">
                                    <button id="nav-gauche7" type="button"> Précédent </button>
                                    <button id="nav-droite7" type="button"> Suivant </button>
                                </div>
                            </div>
                        </div>
                        <div class="element">
                            <img class="imageslide" src="images/wpelisabeth.png" alt="Image 2">
                            <div class="caption">
                                <p>Quel type d'arme utilise Ban?</p>
                                <p class="rep">Votre réponse:<br> <?php if (empty($q8)){ echo "Aucune réponse saisie"; } else{ echo $q8; }?> </p>
                                <p class="rep">Réponse attendue:<br> Un nunchaku </p>
                                <div class="prevnext">
                                    <button id="nav-gauche8" type="button"> Précédent </button>
                                    <button id="nav-droite8" type="button"> Suivant </button>
                                </div>
                            </div>
                        </div>
                        <div class="element">
                            <img class="imageslide" src="images/wpbanmel.png" alt="Image 2">
                            <div class="caption">
                                <p>Qui est associé au péché de la Luxure?</p>
                                <p class="rep">Votre réponse:<br> <?php if (empty($q9)){ echo "Aucune réponse saisie"; } else{ echo $q9; }?> </p>
                                <p class="rep">Réponse attendue:<br> Gowther </p>
                                <div class="prevnext">
                                    <button id="nav-gauche9" type="button"> Précédent </button>
                                    <button id="nav-droite9" type="button"> Suivant </button>
                                </div>
                            </div>
                        </div>
                        <div class="element">
                            <img class="imageslide" src="images/wp7peches.jpg" alt="Image 2">
                            <div class="caption">
                                <p>Qui est la meilleure amie de Diane ?</p>
                                <p class="rep">Votre réponse:<br> <?php if (empty($q10)){ echo "Aucune réponse saisie"; } else{ echo $q10; }?> </p>
                                <p class="rep">Réponse attendue:<br> Elisabeth </p>
                                <div class="prevnext">
                                    <button id="nav-gauche10" type="button"> Précédent </button>
                                    <form action="index.html" method="post">
                                        <input class="btnacc" type="submit" value="Accueil">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="separe2">
                    <img class="img1" src="images/cote3.png" alt=""/>
                    <img src="images/cote2.png" alt=""/>
                </div>
                <script src="scripts.js">
                </script>
            </div>
            <div class="cotes"></div>
        </div>
    </body>
</html>




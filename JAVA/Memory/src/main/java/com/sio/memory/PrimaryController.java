package com.sio.memory;

import java.net.URL;
import java.util.ArrayList;
import java.util.Collections;
import java.util.ResourceBundle;
import javafx.animation.PauseTransition;
import javafx.event.EventHandler;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.image.Image;
import javafx.scene.input.MouseEvent;
import javafx.scene.layout.GridPane;
import javafx.util.Duration;

public class PrimaryController implements Initializable {

    @FXML
    private Label labCoup;

    @FXML
    private GridPane grilleJeu;

    @FXML
    private int nbCoup;

    private int cpt = 0;

    @FXML
    private Carte SelectedCarte = null;

    @FXML
    private Button resetBtn;

    private boolean turned = false;
    
    private int trouved = 0;

    @FXML
    private void resetGame() {
        EventHandler<MouseEvent> reset = new EventHandler<>() {
            @Override
            public void handle(MouseEvent e) {
                grilleJeu.getChildren().clear();
                cpt = 0;
                addCarte();
                nbCoup=0;
                trouved=0;
                labCoup.setText("Essais : " + nbCoup);
            }
        };
        resetBtn.addEventHandler(MouseEvent.MOUSE_CLICKED, reset);
    }

    @FXML
    private void addCarte() {
        ArrayList<Integer> nbCartes = new ArrayList<>();
        for (int p = 0; p < 2; p++) {
            for (int u = 1; u < 9; u++) {
                nbCartes.add(u);
            }
        }
        Collections.shuffle(nbCartes);
        for (int nb : nbCartes) {
            Carte carte = new Carte(nb, "caché");
            grilleJeu.add(carte, cpt % 4, cpt / 4);
            EventHandler<MouseEvent> monEvent = new EventHandler<>() {
                @Override
                public void handle(MouseEvent e) {
                    game(e);
                }
            };
            carte.addEventHandler(MouseEvent.MOUSE_CLICKED, monEvent);
            if (cpt < 15) {
                cpt++;
            }
        }
    }

    @FXML
    private void game(MouseEvent e) {
        Carte card = (Carte) e.getSource();
        PauseTransition pause = new PauseTransition(Duration.seconds(1));
        if(turned == false) {
            if (!card.getEtatCarte().equals("découvert")) {
                if (this.SelectedCarte == null) {
                    this.SelectedCarte = card;
                    card.ShowCarte();
                } else {
                    card.ShowCarte();
                    if (card != this.SelectedCarte) {
                        if (this.SelectedCarte.getNumCarte() == card.getNumCarte()) {
                            this.SelectedCarte.setEtatCarte("découvert");
                            card.setEtatCarte("découvert");
                            this.SelectedCarte.ShowCarte();
                            this.SelectedCarte = null;
                            this.trouved++;
                        } else {
                            pause.setOnFinished((ev) -> {
                                changeCard(card);
                                turned = false;
                            });
                            pause.play();
                            turned=true;
                        }
                        this.nbCoup += 1;
                        labCoup.setText("Essais : " + this.nbCoup);
                    } else {
                        card.HideCarte();
                        this.SelectedCarte = null;
                        this.nbCoup += 1;
                        labCoup.setText("Essais : " + this.nbCoup);
                    }
                }
            }
        }
        if(trouved == 8){
            labCoup.setText("VOUS AVEZ TROUVÉ TOUTES LES PAIRES EN "+nbCoup+" COUPS! BIEN JOUÉ!!");
        }
    }

    @FXML
    private void changeCard(Carte card) {
        this.SelectedCarte.HideCarte();
        card.HideCarte();
        this.SelectedCarte = null;
    }

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        System.out.println("Lancement du programme...");
        addCarte();
    }
}

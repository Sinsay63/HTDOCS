package com.sio.memory;

import java.net.URL;
import java.util.ArrayList;
import java.util.Collection;
import java.util.Collections;
import java.util.ResourceBundle;
import javafx.event.EventHandler;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Label;
import javafx.scene.image.Image;
import javafx.scene.input.MouseEvent;
import javafx.scene.layout.GridPane;

public class PrimaryController implements Initializable {

    @FXML
    private Label labCoup;

    @FXML
    private GridPane grilleJeu;

    @FXML
    private int nbCoup;

    private int cpt = 0;

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
            EventHandler<MouseEvent> monEvent = new EventHandler<MouseEvent>() {
                @Override
                public void handle(MouseEvent e) {
                    eventClicker(e);
                }
            };
            carte.addEventHandler(MouseEvent.MOUSE_CLICKED, monEvent);
            if (cpt < 15) {
                cpt++;
            }
        }
    }

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        System.out.println("Lancement du programme...");
        addCarte();
    }

    @FXML
    private void eventClicker(MouseEvent e) {
        Carte card = (Carte) e.getSource();
        Image img = new Image(getClass().getResourceAsStream("/images/" + card.getNumCarte() + "+.jpg"));
        card.setImage(img);
        System.out.println("lol");
    }
}

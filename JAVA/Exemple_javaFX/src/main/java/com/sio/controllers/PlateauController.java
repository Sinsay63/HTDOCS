package com.sio.controllers;

import java.net.URL;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.input.MouseEvent;
import javafx.scene.layout.GridPane;

public class PlateauController implements Initializable {

    private int cpt = 0;

    @FXML
    private GridPane grilleJeu;

    @FXML
    private void addButton(ActionEvent event) {
        // on charge une image
        Image image = new Image(getClass().getResourceAsStream("/images/background.png"));
        // on met l'image à l'intérieur d'un container
        ImageView imageView = new ImageView(image);

        // on crée un évènement qui se déclenche au clic de la souris
        EventHandler<MouseEvent> eventHandler = new EventHandler<>() {
            @Override
            public void handle(MouseEvent e) {
                clickOnButton(e);
            }
        };
        // on ajoute l'évènement sur le container d'image
        imageView.addEventHandler(MouseEvent.MOUSE_CLICKED, eventHandler);

        // on ajoute le container d'image à la grille
        grilleJeu.add(imageView, cpt % 3, cpt / 3);

        if (cpt < 8) {
            cpt++;
        }
    }

    @FXML
    private void deleteButton(ActionEvent event) {
        grilleJeu.getChildren().remove(grilleJeu.getChildren().size() - 1);
        this.cpt = 0;
    }

    // cette méthode est appelée lorsqu'on clique sur une image précédemment ajoutée
    @FXML
    private void clickOnButton(MouseEvent event) {
        System.out.println("On me clique dessus !");
    }

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        // le code ici est exécuté lors de la création de la fenêtre JavaFX
        System.out.println("Lancement du programme...");
    }
}

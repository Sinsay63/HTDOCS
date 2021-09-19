package com.sio.testfx;

import java.io.IOException;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.Label;

public class PrimaryController {

    @FXML
    private Label affichage;

    private int result1;
    private String operateur = "";
    private boolean calculer = false;

    @FXML
    private void delete(ActionEvent event) throws IOException {
        affichage.setText("");
        this.result1 = 0;
        this.calculer = false;
    }

    @FXML
    private void chiffres(ActionEvent event) {
        Button btn = (Button) event.getSource();
        if (this.calculer) {
            affichage.setText("");
            affichage.setText(affichage.getText() + btn.getText());
            this.calculer = false;
        } else {
            affichage.setText(affichage.getText() + btn.getText());
        }

    }

    @FXML
    private void signes(ActionEvent event) {
        
        Button btn = (Button) event.getSource();
        String display = affichage.getText();
         this.calculer = false;
        if (!display.isEmpty()) {
            if (this.operateur.isEmpty()) {
                this.operateur = btn.getText();
                this.result1 = display.length();
                affichage.setText(display + btn.getText());
            }
        }
    }

    @FXML
    private void egal() {
        String display = affichage.getText();
        if (!display.isEmpty()) {
            switch (this.operateur) {
                case "+":
                    calcul("+");
                    break;
                case "-":
                    calcul("-");
                    break;
                case "/":
                    calcul("/");
                    break;
                case "*":
                    calcul("*");
                    break;
            }
            this.calculer = true;
        }
    }

    @FXML
    private void calcul(String signe) {
        double resultat2 = Double.parseDouble(affichage.getText().substring(this.result1 + 1));
        double resultat = Double.parseDouble(affichage.getText().substring(0, this.result1));
        double result = 0;
        boolean error = false;
        switch (signe) {
            case "+":
                result = resultat + resultat2;
                break;
            case "-":
                result = resultat - resultat2;
                break;
            case "*":
                result = resultat * resultat2;
                break;
            case "/":
                if (resultat2 == 0) {
                    error = true;
                } else {
                    result = resultat / resultat2;
                }
                break;
        }
        if (!error) {
            affichage.setText("" + result);
        } else {
            affichage.setText("ERROR 404");
        }
    }
}

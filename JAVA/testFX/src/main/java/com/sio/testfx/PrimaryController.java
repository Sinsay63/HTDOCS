package com.sio.testfx;

import java.io.IOException;
import java.util.ArrayList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.Label;

public class PrimaryController {

    @FXML
    private Label resultat;
    @FXML
    private Button zero;
    @FXML
    private Button un;
    @FXML
    private Button deux;
    @FXML
    private Button trois;
    @FXML
    private Button quatre;
    @FXML
    private Button cinq;
    @FXML
    private Button six;
    @FXML
    private Button sept;
    @FXML
    private Button huit;
    @FXML
    private Button neuf;
    @FXML
    private Button plus;
    @FXML
    private Button moins;
    @FXML
    private Button diviser;
    @FXML
    private Button multiplier;
    @FXML
    private Button egal;
    @FXML
    private Button delete;

    @FXML
    private void display(ActionEvent event) throws IOException {
        int result1 = 0;
        int result2 = 0;
        String signe = "";

        if (event.getSource() == plus) {
            if (signe == "") {
                signe = "+";
                result1 = Integer.parseInt(resultat.getText());
                resultat.setText(resultat.getText() + "+");
            }
            else{
                resultat.setText("");
            }
        } else if (event.getSource() == moins) {
            if (signe == "") {
                signe = "-";
                result1 = Integer.parseInt(resultat.getText());
                resultat.setText(resultat.getText() + "-");
            }
        } else if (event.getSource() == multiplier) {
            if (signe == "") {
                signe = "*";
                result1 = Integer.parseInt(resultat.getText());
                resultat.setText(resultat.getText() + "*");

            }
        } else if (event.getSource() == diviser) {
            if (signe == "") {
                signe = "/";
                result1 = Integer.parseInt(resultat.getText());
                resultat.setText(resultat.getText() + "/");
            }
        }

        if (event.getSource() == delete) {
            resultat.setText("");
        } else if (event.getSource() == zero) {
            resultat.setText(resultat.getText() + "0");
        } else if (event.getSource() == un) {
            resultat.setText(resultat.getText() + "1");
        } else if (event.getSource() == deux) {
            resultat.setText(resultat.getText() + "2");
        } else if (event.getSource() == trois) {
            resultat.setText(resultat.getText() + "3");
        } else if (event.getSource() == quatre) {
            resultat.setText(resultat.getText() + "4");
        } else if (event.getSource() == cinq) {
            resultat.setText(resultat.getText() + "5");
        } else if (event.getSource() == six) {
            resultat.setText(resultat.getText() + "6");
        } else if (event.getSource() == sept) {
            resultat.setText(resultat.getText() + "7");
        } else if (event.getSource() == huit) {
            resultat.setText(resultat.getText() + "8");
        } else if (event.getSource() == neuf) {
            resultat.setText(resultat.getText() + "9");
        }

    }
}

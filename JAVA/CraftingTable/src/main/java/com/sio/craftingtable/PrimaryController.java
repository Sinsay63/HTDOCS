package com.sio.craftingtable;

import java.net.URL;
import java.util.ResourceBundle;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.input.DragEvent;
import javafx.scene.input.TransferMode;
import javafx.scene.layout.GridPane;
import javafx.scene.layout.Pane;

public class PrimaryController implements Initializable {

    @FXML
    private GridPane craft;

    @FXML
    private GridPane craftingTable;

    @FXML
    private Pane Panel;


    @FXML
    private void handleDropOver(DragEvent event) {
        if (event.getDragboard().hasFiles()) {
            event.acceptTransferModes(TransferMode.ANY);
        }
    }

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        System.out.println("Lancement du programme...");
    }
}

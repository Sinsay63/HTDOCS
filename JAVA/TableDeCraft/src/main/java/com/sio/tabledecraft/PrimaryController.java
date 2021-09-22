package com.sio.tabledecraft;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.net.URL;
import java.util.List;
import java.util.ResourceBundle;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
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
    private ImageView img1;
    @FXML
    private ImageView img2;

    @FXML
    private ImageView img3;
    @FXML
    private ImageView img4;
    @FXML
    private ImageView img5;
    @FXML
    private ImageView img6;
    @FXML
    private ImageView img7;
    @FXML
    private ImageView img8;
    @FXML
    private ImageView img9;

    @FXML
    private void handleDropOver(DragEvent event) {
        if (event.getDragboard().hasFiles()) {
            event.acceptTransferModes(TransferMode.ANY);
        }
    }

    @FXML
    private void handleDrop(DragEvent event) throws FileNotFoundException {
        List<File> file = event.getDragboard().getFiles();
        Image img = new Image(new FileInputStream(file.get(0)));
        ImageView imageView = (ImageView) event.getSource();
        imageView.setFitHeight(100);
        imageView.setFitWidth(100);
        imageView.setImage(img);
        System.out.println(img);
    }

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        System.out.println("Lancement du programme...");
    }
}

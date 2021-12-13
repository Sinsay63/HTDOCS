package com.sio.seriestv;

import com.sio.seriestv.DAO.SerieDAO;
import com.sio.seriestv.DTO.SerieDTO;
import java.io.File;
import java.io.IOException;
import java.net.URL;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.nio.file.StandardCopyOption;
import java.sql.SQLException;
import java.sql.Date;
import java.util.ArrayList;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.event.EventHandler;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.DatePicker;
import javafx.scene.control.Label;
import javafx.scene.control.ScrollPane;
import javafx.scene.control.TextField;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.input.MouseEvent;
import javafx.scene.layout.VBox;
import javafx.scene.text.Text;
import javafx.scene.text.TextAlignment;
import javafx.stage.FileChooser;
import javafx.stage.Modality;
import javafx.stage.Stage;

public class SerieTV implements Initializable {

    @FXML
    private Button btnAddSerie;

    private File selectedFile = null;

    @FXML
    private ScrollPane scrollPane;

    @FXML
    public void createCatalogue() throws SQLException {
        scrollPane.setContent(null);
        ArrayList<VBox> VboxList = new ArrayList<>();
        VBox vbox = new VBox();
        for (SerieDTO serie : SerieDAO.getAllSeries()) {
            Image img = new Image(getClass().getResourceAsStream(serie.getImgCouverture()));
            ImageView imgView = new ImageView(img);
            imgView.setImage(img);
            imgView.setFitHeight(200);
            imgView.setFitWidth(245);
            Label nomSerie = new Label(serie.getNom());
            nomSerie.setStyle("font-size: 15px;");
            VBox div = new VBox();
            div.getChildren().addAll(imgView, nomSerie);
            nomSerie.setPrefWidth(245);
            nomSerie.setTextAlignment(TextAlignment.CENTER);
            VboxList.add(div);
            EventHandler<MouseEvent> switchDetails = new EventHandler<>() {
                @Override
                public void handle(MouseEvent ev) {
                    try {
                        switchToDetails(ev, serie);
                    }
                    catch (IOException ex) {
                        Logger.getLogger(SerieTV.class.getName()).log(Level.SEVERE, null, ex);
                    }
                    catch (SQLException ex) {
                        Logger.getLogger(SerieTV.class.getName()).log(Level.SEVERE, null, ex);
                    }
                }
            };
            div.addEventHandler(MouseEvent.MOUSE_CLICKED, switchDetails);
        }
        for (VBox box : VboxList) {
            vbox.getChildren().add(box);
        }
        scrollPane.setContent(vbox);
    }

    @FXML
    private void switchToDetails(MouseEvent ev, SerieDTO serie) throws IOException, SQLException {
        Data.Tserie = serie;
        App.setRoot("details serie");
    }

    public void addSerie() {
        popUpAjoutSerie(Data.stage);
    }

    public void popUpAjoutSerie(final Stage primaryStage) {
        Label erreur = new Label("Veuillez remplir tous les champs.");
        final Stage dialog = new Stage();

        dialog.setTitle("Ajout d'une série");
        dialog.initModality(Modality.WINDOW_MODAL);
        dialog.initOwner(primaryStage);
        VBox dialogVbox = new VBox(20);
        Text type = new Text("Ajout d'une série au catalogue");
        TextField nom = new TextField("");
        TextField nbEpisodes = new TextField("");
        FileChooser file = new FileChooser();
        Button btnImg = new Button("Sélectionner une image de couverture");
        DatePicker dateDiff = new DatePicker();
        dateDiff.setPromptText("Choisir la date de diffusion");
        nom.setPromptText("Saisir son nom");
        nbEpisodes.setPromptText("Saisir le nombre d'épisodes");
        btnImg.addEventHandler(MouseEvent.MOUSE_CLICKED, new EventHandler<MouseEvent>() {
            @Override
            public void handle(MouseEvent t) {
                selectedFile = file.showOpenDialog(dialog);
            }
        });
        file.getExtensionFilters().addAll(new FileChooser.ExtensionFilter("JPG", "*.jpg"), new FileChooser.ExtensionFilter("PNG", "*.png"));
        Button addSeriebtn = new Button("Ajouter la série");
        dialogVbox.getChildren().addAll(type, nom, nbEpisodes, btnImg, dateDiff, addSeriebtn);
        addSeriebtn.addEventHandler(MouseEvent.MOUSE_CLICKED, new EventHandler<MouseEvent>() {
            @Override
            public void handle(MouseEvent e) {
                if (!nom.getText().equals("") && selectedFile != null && !selectedFile.getName().equals("") && dateDiff != null && dateDiff.getValue() != null && !nbEpisodes.getText().equals("")) {
                    String nomSerie = nom.getText();
                    Date dateDiffusion = Date.valueOf(dateDiff.getValue());
                    int nombreEpisodes = Integer.parseInt(nbEpisodes.getText());
                    String imgCouverture = selectedFile.getName();
                    try {
                        Path copied = Paths.get("images/" + nomSerie + ".png");
                        Path originalPath = Paths.get(imgCouverture.replace("file:/", ""));
                        Files.copy(originalPath, copied, StandardCopyOption.REPLACE_EXISTING);
                        SerieDTO serie = new SerieDTO(nomSerie, dateDiffusion, nombreEpisodes, "");
                        SerieDAO.createSerie(serie);
                        createCatalogue();
                        dialog.hide();
                    }
                    catch (IOException | SQLException ex) {
                        Logger.getLogger(SerieTV.class.getName()).log(Level.SEVERE, null, ex);
                    }
                    
                }
                else {
                    if (!dialogVbox.getChildren().contains(erreur)) {
                        dialogVbox.getChildren().add(erreur);
                    }
                }
            }
        });
        Scene dialogScene = new Scene(dialogVbox, 400, 400);
        dialog.setScene(dialogScene);
        dialog.show();
    }

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        System.out.println("Lancement du programme...");
        try {
            createCatalogue();
        }
        catch (SQLException ex) {
            Logger.getLogger(SerieTV.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
}

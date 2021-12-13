package com.sio.seriestv;

import com.sio.seriestv.DAO.ActeurDAO;
import com.sio.seriestv.DAO.SerieDAO;
import com.sio.seriestv.DTO.ActeurDTO;
import com.sio.seriestv.DTO.SerieDTO;
import java.io.File;
import java.io.IOException;
import java.net.URL;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.nio.file.StandardCopyOption;
import java.sql.Date;
import java.sql.SQLException;
import java.time.LocalDate;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.event.EventHandler;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.DatePicker;
import javafx.scene.control.Label;
import javafx.scene.control.ScrollPane;
import javafx.scene.control.TextField;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.input.MouseEvent;
import javafx.scene.layout.GridPane;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;
import javafx.scene.text.Text;
import javafx.stage.FileChooser;
import javafx.stage.Modality;
import javafx.stage.Stage;

public class DetailsSerieTV implements Initializable {

    @FXML
    private Label labNomSerie;

    @FXML
    private Label labDateDiffusion;

    @FXML
    private Label labNbEpisodes;

    @FXML
    private Button btnDeleteSerie;

    private GridPane grilleActeurs;

    @FXML
    private ImageView imgSerie;

    @FXML
    private ScrollPane scrollPaneActeurs;

    @FXML
    private Button btnAddActeur;

    @FXML
    private Button btnEditSerie;

    private File selectedFile;

    private int cpt = 0;

    @FXML
    private void switchToCatalogue() throws IOException {
        App.setRoot("series");
        Data.Tserie = null;
    }

    private void displayDetails(SerieDTO serie) throws SQLException {
        labNomSerie.setText(Data.Tserie.getNom());
        grilleActeurs = new GridPane();
        scrollPaneActeurs.setContent(grilleActeurs);
        grilleActeurs.setMinWidth(450);
        grilleActeurs.setMinHeight(150);
        grilleActeurs.setMaxWidth(450);
        grilleActeurs.setMaxHeight(150);
        grilleActeurs.setMaxSize(450, 150);
        labDateDiffusion.setText("Date de diffusion : " + serie.getDateDiffusion());
        labNbEpisodes.setText(serie.getNbEpisodes() + " épisode(s)");
        Image img = new Image(getClass().getResourceAsStream("/images/" + serie.getImgCouverture()));
        imgSerie.setImage(img);
        imgSerie.setFitHeight(200);
        imgSerie.setFitWidth(200);
        displayActeurs(serie);
    }

    private void displayActeurs(SerieDTO serie) throws SQLException {
        grilleActeurs.getChildren().clear();
        int size = serie.getListeActeurs().size();
        for (ActeurDTO acteur : serie.getListeActeurs()) {
            Label infoActeur = new Label(acteur.getNom() + " " + acteur.getPrenom());
            Button btnDelete = new Button("Retirer de la liste");
            HBox div = new HBox();
            div.setAlignment(Pos.CENTER);
            grilleActeurs.add(div, 0, cpt);
            div.getChildren().addAll(infoActeur, btnDelete);
            btnDelete.addEventHandler(MouseEvent.MOUSE_CLICKED, new EventHandler<MouseEvent>() {
                @Override
                public void handle(MouseEvent e) {
                    try {
                        deleteActeurSerie(serie.getId(), acteur.getId());
                    }
                    catch (SQLException ex) {
                        Logger.getLogger(DetailsSerieTV.class.getName()).log(Level.SEVERE, null, ex);
                    }
                }
            });
            if (cpt < size) {
                cpt++;
            }
        }
        cpt = 0;
    }

    public void deleteSerie() throws SQLException, IOException {
        SerieDAO.deleteSerie(Data.Tserie);
        switchToCatalogue();

    }

    private void deleteActeurSerie(int idSerie, int idActeur) throws SQLException {
        SerieDAO.deleteActeurFromSerieById(idSerie, idActeur);
        Data.Tserie = SerieDAO.getSerieById(idSerie);
        displayActeurs(Data.Tserie);

    }

    public void popUpAddActeur(final Stage primaryStage) {

        final Stage dialog = new Stage();
        dialog.setTitle("Création & Ajout d'un acteur à la série " + Data.Tserie.getNom());
        dialog.initModality(Modality.NONE);
        dialog.initOwner(primaryStage);
        VBox dialogVbox = new VBox(20);
        Text type = new Text("Ajout d'un nouvel acteur à la BDD");
        TextField nom = new TextField();
        TextField prenom = new TextField();
        nom.setPromptText("Saisir son nom");
        prenom.setPromptText("Saisir son prénom");
        Button addBtn = new Button("Ajouter l'acteur");
        dialogVbox.getChildren().addAll(type, nom, prenom, addBtn);
        addBtn.addEventHandler(MouseEvent.MOUSE_CLICKED, new EventHandler<MouseEvent>() {
            @Override
            public void handle(MouseEvent e) {
                try {
                    ActeurDAO.createActeurSerie(new ActeurDTO(nom.getText(), prenom.getText()), Data.Tserie.getId());
                    Data.Tserie = SerieDAO.getSerieById(Data.Tserie.getId());
                    displayActeurs(Data.Tserie);
                }
                catch (SQLException ex) {
                    Logger.getLogger(DetailsSerieTV.class.getName()).log(Level.SEVERE, null, ex);
                }
                dialog.hide();
            }
        });
        Scene dialogScene = new Scene(dialogVbox, 300, 200);
        dialog.setScene(dialogScene);

        dialog.show();
    }

    public void add() throws SQLException {
        popUpAddActeur(Data.stage);
    }

    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            displayDetails(Data.Tserie);
        }
        catch (SQLException ex) {
            Logger.getLogger(DetailsSerieTV.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    public void popUpModifSerie(Stage stage) {
        final Stage dialog = new Stage();
        dialog.setTitle("Modification de la série ");
        dialog.initModality(Modality.NONE);
        dialog.initOwner(stage);
        VBox dialogVbox = new VBox(20);
        Text type = new Text("Modification de " + Data.Tserie.getNom());
        TextField nom = new TextField(Data.Tserie.getNom());
        DatePicker dateDiff = new DatePicker();
        dateDiff.setValue(LocalDate.parse(Data.Tserie.getDateDiffusion().toString()));
        TextField nbEpisodes = new TextField(Data.Tserie.getNbEpisodes() + "");
        Button btnImg = new Button("Sélectionner une image de couverture");
        FileChooser file = new FileChooser();

        btnImg.addEventHandler(MouseEvent.MOUSE_CLICKED, new EventHandler<MouseEvent>() {
            @Override
            public void handle(MouseEvent t) {
                selectedFile = file.showOpenDialog(dialog);

            }
        });
        file.getExtensionFilters().addAll(new FileChooser.ExtensionFilter("JPG", "*.jpg"), new FileChooser.ExtensionFilter("PNG", "*.png"));
        Button addBtn = new Button("Modifier");
        dialogVbox.getChildren().addAll(type, nom, nbEpisodes, btnImg, dateDiff, addBtn);
        addBtn.addEventHandler(MouseEvent.MOUSE_CLICKED, new EventHandler<MouseEvent>() {
            @Override
            public void handle(MouseEvent e) {
                String nomSerie = nom.getText();
                String imgCouverture = "";
                int nombreEpisodes = Integer.parseInt(nbEpisodes.getText());
                if (nomSerie.equals("")) {
                    nomSerie = Data.Tserie.getNom();
                }
                if (nombreEpisodes <= 0) {
                    nombreEpisodes = Data.Tserie.getNbEpisodes();
                }
                if (selectedFile == null) {
                    imgCouverture = Data.Tserie.getImgCouverture();
                }
                else {
                    imgCouverture = selectedFile.getName();

                }
                try {
                    Path copied = Paths.get("images/"+nomSerie+".jpg");
                    Path originalPath = Paths.get(imgCouverture.replace("file:/", ""));
                    Files.copy(originalPath, copied, StandardCopyOption.REPLACE_EXISTING);
                }
                catch (IOException ex) {
                    Logger.getLogger(DetailsSerieTV.class.getName()).log(Level.SEVERE, null, ex);
                }
                Date dateDiffusion = Date.valueOf(dateDiff.getValue());
                SerieDTO serie = new SerieDTO(nomSerie, dateDiffusion, nombreEpisodes, imgCouverture);
                serie.setId(Data.Tserie.getId());
                try {
                    SerieDAO.updateSerie(serie);
                    Data.Tserie = serie;
                    displayDetails(serie);
                }
                catch (SQLException ex) {
                    Logger.getLogger(DetailsSerieTV.class.getName()).log(Level.SEVERE, null, ex);
                }

                Data.Tserie = serie;
                dialog.hide();
            }
        });
        Scene dialogScene = new Scene(dialogVbox, 300, 350);
        dialog.setScene(dialogScene);

        dialog.show();
    }

    public void modifSerie() {
        popUpModifSerie(Data.stage);
    }

}

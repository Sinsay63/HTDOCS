package com.sio.seriestv;

import com.sio.seriestv.DAO.ActeurDAO;
import com.sio.seriestv.DAO.SerieDAO;
import com.sio.seriestv.DTO.ActeurDTO;
import com.sio.seriestv.DTO.SerieDTO;
import java.io.IOException;
import java.net.URL;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.animation.PauseTransition;
import javafx.application.Application;
import javafx.event.EventHandler;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.control.Button;
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
import javafx.stage.Modality;
import javafx.stage.Stage;

public class DetailsSerieTV extends Application implements Initializable {

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
        imgSerie.setFitHeight(100);
        imgSerie.setFitWidth(100);
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

    }


    @Override
    public void start(final Stage primaryStage) {

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
        start(Data.stage);
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
}

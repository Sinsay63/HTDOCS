package com.sio.seriestv;

import com.sio.seriestv.DAO.SerieDAO;
import com.sio.seriestv.DTO.SerieDTO;
import java.io.IOException;
import java.net.URL;
import java.sql.SQLException;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.event.EventHandler;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.geometry.HPos;
import javafx.geometry.VPos;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.input.MouseEvent;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.GridPane;
import javafx.scene.layout.HBox;

public class SerieTV implements Initializable {

    private int cpt = 0;

    @FXML
    private Label title;

    @FXML
    private GridPane grilleSeries;
    

    @FXML
    public void createCatalogue() throws SQLException {
        grilleSeries.getChildren().clear();
        grilleSeries.setMinWidth(500);
        grilleSeries.setMinHeight(500);
        grilleSeries.setMaxWidth(500);
        grilleSeries.setMaxHeight(500);
        grilleSeries.setMaxSize(500, 500);

        int size = SerieDAO.getAllSeries().size() - 1;
        if (grilleSeries.getChildren() != null) {
            for (SerieDTO serie : SerieDAO.getAllSeries()) {
                Image img = new Image(getClass().getResourceAsStream("/images/" + serie.getImgCouverture()));
                ImageView imgView = new ImageView(img);
                imgView.setImage(img);
                imgView.setFitHeight(100);
                imgView.setFitWidth(100);
                Label nomSerie = new Label(serie.getNom());
                HBox div = new HBox();
                grilleSeries.add(div, cpt % 2, cpt / 2);
                div.getChildren().addAll(imgView,nomSerie);
                EventHandler<MouseEvent> switchDetails = new EventHandler<>() {
                    @Override
                    public void handle(MouseEvent ev) {
                        try {
                            switchToDetails(ev);
                        }
                        catch (IOException ex) {
                            Logger.getLogger(SerieTV.class.getName()).log(Level.SEVERE, null, ex);
                        }
                        catch (SQLException ex) {
                            Logger.getLogger(SerieTV.class.getName()).log(Level.SEVERE, null, ex);
                        }
                    }
                };
                nomSerie.addEventHandler(MouseEvent.MOUSE_CLICKED, switchDetails);
                if (cpt < size) {
                    cpt++;
                }
            }
        }
        else {
            grilleSeries.getChildren().clear();
        }
    }

    private void deleteSerieOnClick(MouseEvent event) throws SQLException {
        Label nomSerie = (Label) event.getSource();
        SerieDAO.deleteSerie(Data.Tserie);
    }

    @FXML
    private void switchToDetails(MouseEvent ev) throws IOException, SQLException {
        Label nomSerie = (Label) ev.getSource();
        Data.Tserie = SerieDAO.getSerieByNom(nomSerie.getText());
        App.setRoot("details serie");
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
        TextArea txt = new TextArea("TEST REMPLACEMENT");
    }
}

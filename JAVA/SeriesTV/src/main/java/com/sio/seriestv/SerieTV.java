package com.sio.seriestv;

import com.sio.seriestv.DAO.SerieDAO;
import com.sio.seriestv.DTO.SerieDTO;
import java.sql.SQLException;
import javafx.fxml.FXML;
import javafx.scene.control.Label;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.layout.GridPane;

public class SerieTV {
    private int cpt=0;

    @FXML
    private Label title;

    @FXML
    private GridPane grilleSeries;

    public void createCatalogue() throws SQLException {
        int size = SerieDAO.getAllSeries().size();
        for (SerieDTO serie : SerieDAO.getAllSeries()) {
            Image img = new Image(getClass().getResourceAsStream("/images/" + serie.getImgCouverture()));
            ImageView imgView = new ImageView(img);
            imgView.setImage(img);
             grilleSeries.add(imgView, cpt % 2, cpt / 2);
            if (cpt < size ) {
                cpt++;
            }

        }
    }

}

package com.sio.seriestv.DAO;

import com.sio.seriestv.DTO.SerieDTO;
import com.sio.seriestv.tools.DataBaseLinker;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Date;

public class SerieDAO{

    public static ArrayList<SerieDTO> getAllSeries() throws SQLException {
        ArrayList<SerieDTO> listeSeries = new ArrayList<SerieDTO>();
        Connection bdd = DataBaseLinker.getConnexion();

        PreparedStatement state = bdd.prepareStatement("SELECT * FROM Serie");

        ResultSet result = state.executeQuery();

        while (result.next()) {
            int id = result.getInt("idSerie");
            String nom = result.getString("nomSerie");
            String cheminPhoto = result.getString("imgCouverture");
            Date date = result.getDate("dateDiffusion");
            int nbEpisode = result.getInt("nbEpisodes");
            SerieDTO serie = new SerieDTO(id, nom, date, nbEpisode, cheminPhoto);
            listeSeries.add(serie);
        }
        return listeSeries;
    }
}

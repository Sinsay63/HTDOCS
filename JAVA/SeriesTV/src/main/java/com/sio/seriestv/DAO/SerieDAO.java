package com.sio.seriestv.DAO;

import com.sio.seriestv.DTO.ActeurDTO;
import com.sio.seriestv.DTO.SerieDTO;
import com.sio.seriestv.tools.DataBaseLinker;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Date;

public class SerieDAO {

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
            SerieDTO serie = new SerieDTO(nom, date, nbEpisode, cheminPhoto);
            serie.setId(id);
            listeSeries.add(serie);
        }
        return listeSeries;
    }

    public static void deleteSerie(SerieDTO serie) throws SQLException {
        Connection bdd = DataBaseLinker.getConnexion();

        deleteActeurFromSerie(serie);
        PreparedStatement state = bdd.prepareStatement("DELETE FROM Serie WHERE idSerie = ?");
        state.setInt(1, serie.getId());
        state.execute();

    }

    public static SerieDTO getSerieByNom(String nom) throws SQLException {
        SerieDTO serie = null;
        if (!nom.equals("")) {

            Connection bdd = DataBaseLinker.getConnexion();

            PreparedStatement state = bdd.prepareStatement("SELECT * FROM serie WHERE nomSerie = ?");
            state.setString(1, nom);

            ResultSet result = state.executeQuery();
            serie = getAnySerie(result);

        }
        return serie;
    }

    public static SerieDTO getSerieById(int idSerie) throws SQLException {
        SerieDTO serie = null;

        Connection bdd = DataBaseLinker.getConnexion();

        PreparedStatement state = bdd.prepareStatement("SELECT * FROM serie WHERE idSerie = ?");
        state.setInt(1, idSerie);

        ResultSet result = state.executeQuery();
        serie = getAnySerie(result);

        return serie;
    }

    private static SerieDTO getAnySerie(ResultSet result) throws SQLException {
        Connection bdd = DataBaseLinker.getConnexion();
        result.next();
        int id = result.getInt("idSerie");
        String nom = result.getString("nomSerie");
        String cheminPhoto = result.getString("imgCouverture");
        Date date = result.getDate("dateDiffusion");
        int nbEpisode = result.getInt("nbEpisodes");
        SerieDTO serie = new SerieDTO(nom, date, nbEpisode, cheminPhoto);
        serie.setId(id);
        PreparedStatement state2 = bdd.prepareStatement("SELECT idActeur FROM serie_acteur WHERE idSerie = ?");
        state2.setInt(1, id);
        ResultSet result2 = state2.executeQuery();

        while (result2.next()) {

            int idActeur = result2.getInt(1);
            PreparedStatement state3 = bdd.prepareStatement("SELECT * FROM acteur WHERE idActeur = ?");
            state3.setInt(1, idActeur);
            ResultSet result3 = state3.executeQuery();

            while (result3.next()) {
                String nomActeur = result3.getString("nomActeur");
                String prenomActeur = result3.getString("prenomActeur");
                ActeurDTO acteur = new ActeurDTO(nomActeur, prenomActeur);
                acteur.setId(idActeur);
                serie.getListeActeurs().add(acteur);
            }
        }
        return serie;
    }

    public static void deleteActeurFromSerieById(int idSerie, int idActeur) throws SQLException {
        Connection bdd = DataBaseLinker.getConnexion();

        PreparedStatement state = bdd.prepareStatement("DELETE FROM serie_acteur WHERE idSerie = ? and idActeur = ?");
        state.setInt(1, idSerie);
        state.setInt(2, idActeur);

        state.execute();

        PreparedStatement state2 = bdd.prepareStatement("SELECT * FROM serie_acteur WHERE idActeur = ?");
        state2.setInt(1, idActeur);

        ResultSet result2 = state2.executeQuery();

        if (!result2.next()) {
            PreparedStatement state3 = bdd.prepareStatement("DELETE FROM acteur WHERE idActeur = ?");
            state3.setInt(1, idActeur);
            state3.execute();
        }
    }

    public static void deleteActeurFromSerie(SerieDTO serie) throws SQLException {
        Connection bdd = DataBaseLinker.getConnexion();

        PreparedStatement state = bdd.prepareStatement("DELETE FROM serie_acteur WHERE idSerie = ? ");
        state.setInt(1, serie.getId());

        state.execute();
        for (ActeurDTO acteur : serie.getListeActeurs()) {
            PreparedStatement state1 = bdd.prepareStatement("DELETE FROM acteur WHERE idActeur = ?");
            state1.setInt(1, acteur.getId());
            state1.execute();

            PreparedStatement state2 = bdd.prepareStatement("SELECT * FROM serie_acteur WHERE idActeur = ?");
            state2.setInt(1, acteur.getId());

            ResultSet result2 = state2.executeQuery();

            if (!result2.next()) {
                PreparedStatement state3 = bdd.prepareStatement("DELETE FROM acteur WHERE idActeur = ?");
                state3.setInt(1, acteur.getId());
                state3.execute();
            }
        }
    }

    public static void createSerie(SerieDTO serie) throws SQLException {
        Connection bdd = DataBaseLinker.getConnexion();

        PreparedStatement state = bdd.prepareStatement("INSERT INTO serie(nomSerie,imgCouverture,dateDiffusion,nbEpisodes) VALUES(?,?,?,?)");
        state.setString(1, serie.getNom());
        state.setString(2, "file:images/lucifer.png");
        state.setDate(3, (java.sql.Date) serie.getDateDiffusion());
        state.setInt(4, serie.getNbEpisodes());
        state.executeUpdate();
    }

    public static void updateSerie(SerieDTO serie) throws SQLException {
        Connection bdd = DataBaseLinker.getConnexion();

        PreparedStatement state = bdd.prepareStatement("UPDATE serie SET nomSerie = ?,imgCouverture = ?,dateDiffusion = ?,nbEpisodes = ? WHERE idSerie = ?");
        state.setString(1, serie.getNom());
        state.setString(2, serie.getImgCouverture());
        state.setDate(3, (java.sql.Date) serie.getDateDiffusion());
        state.setInt(4, serie.getNbEpisodes());
        state.setInt(5, serie.getId());
        state.executeUpdate();
    }
}

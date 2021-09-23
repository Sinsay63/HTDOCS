package com.sio.seriestv.DAO;

import com.sio.seriestv.DTO.ActeurDTO;
import com.sio.seriestv.tools.DataBaseLinker;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;

public class ActeurDAO {

    public static ArrayList<ActeurDTO> getAllActeurs() throws SQLException {
        ArrayList<ActeurDTO> listeActeur = new ArrayList<ActeurDTO>();
        Connection bdd = DataBaseLinker.getConnexion();

        PreparedStatement state = bdd.prepareStatement("SELECT * FROM Acteur");

        ResultSet result = state.executeQuery();

        while (result.next()) {
            int id = result.getInt("idActeur");
            String nom = result.getString("nomActeur");
            String prenom = result.getString("prenomActeur");
            ActeurDTO acteur = new ActeurDTO(nom, prenom);
            acteur.setId(id);
            listeActeur.add(acteur);
        }
        return listeActeur;
    }

    public static void createActeurSerie(ActeurDTO acteur, int idSerie) throws SQLException {
        Connection bdd = DataBaseLinker.getConnexion();

        PreparedStatement state = bdd.prepareStatement("INSERT INTO acteur(nomActeur,prenomActeur) VALUES(?,?)", Statement.RETURN_GENERATED_KEYS);
        state.setString(1, acteur.getNom());
        state.setString(2, acteur.getPrenom());

        state.executeUpdate();

        ResultSet keys = state.getGeneratedKeys();
        keys.next();
        int idActeur = keys.getInt(1);

        PreparedStatement state2 = bdd.prepareStatement("INSERT INTO serie_acteur(idSerie,idActeur) VALUES(?,?)");
        state2.setInt(1, idSerie);
        state2.setInt(2, idActeur);

        state2.executeUpdate();
    }
}

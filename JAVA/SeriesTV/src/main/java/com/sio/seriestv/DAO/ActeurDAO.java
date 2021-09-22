package com.sio.seriestv.DAO;

import com.sio.seriestv.DTO.ActeurDTO;
import com.sio.seriestv.tools.DataBaseLinker;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

public class ActeurDAO {

    public static ArrayList<ActeurDTO> getAllActeurs() throws SQLException {
        ArrayList<ActeurDTO> listeActeur = new ArrayList<ActeurDTO>();
        Connection bdd = DataBaseLinker.getConnexion();

        PreparedStatement state = bdd.prepareStatement("SELECT * FROM Acteur");

        ResultSet result = state.executeQuery();

        while(result.next()){
            int id= result.getInt("idActeur");
            String nom = result.getString("nomActeur");
            String prenom = result.getString("prenomActeur");
            ActeurDTO acteur = new ActeurDTO(id, nom, prenom);
            listeActeur.add(acteur);
        }
        return listeActeur;
    }

}

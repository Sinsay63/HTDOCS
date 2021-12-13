package com.sio.seriestv.DTO;

import java.util.ArrayList;
import java.util.Date;
import javafx.scene.image.ImageView;

public class SerieDTO {

    private int id;
    private String nom;
    private Date dateDiffusion;
    private int nbEpisodes;
    private String imgCouverture;
    private ArrayList<ActeurDTO> listeActeurs;

    public SerieDTO(String nom, Date dateDiffusion, int nbEpisodes, String imgCouverture) {
        this.nom = nom;
        this.dateDiffusion = dateDiffusion;
        this.nbEpisodes = nbEpisodes;
        this.imgCouverture = imgCouverture;
        this.listeActeurs = new ArrayList<ActeurDTO>();
    }

    public int getId() {
        return id;
    }

    public String getNom() {
        return nom;
    }

    public Date getDateDiffusion() {
        return dateDiffusion;
    }

    public int getNbEpisodes() {
        return nbEpisodes;
    }

    public String getImgCouverture() {
        return imgCouverture;
    }

    public ArrayList<ActeurDTO> getListeActeurs() {
        return listeActeurs;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public void setDateDiffusion(Date dateDiffusion) {
        this.dateDiffusion = dateDiffusion;
    }

    public void setNbEpisodes(int nbEpisodes) {
        this.nbEpisodes = nbEpisodes;
    }

    public void setImgCouverture(String imgCouverture) {
        this.imgCouverture = imgCouverture;
    }

    public void setListeActeurs(ArrayList<ActeurDTO> listeActeurs) {
        this.listeActeurs = listeActeurs;
    }

}

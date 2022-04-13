package com.example.dossierclient.dao;

import com.j256.ormlite.field.DatabaseField;
import com.j256.ormlite.table.DatabaseTable;

import java.util.Objects;

@DatabaseTable(tableName = "Client")
public class Client {

    @DatabaseField( columnName = "idClient", generatedId = true )
    private int idClient;

    @DatabaseField( columnName="nom",canBeNull = false)
    private String nom;

    @DatabaseField( columnName="prenom",canBeNull = false)
    private String prenom;

    @DatabaseField( columnName="telephone",canBeNull = false)
    private String telephone;

    @DatabaseField( columnName="adresse",canBeNull = false)
    private String adresse;

    @DatabaseField (
            foreign = true,
            foreignAutoRefresh = true,
            canBeNull = false,
            index = true,
            columnDefinition = "INTEGER CONSTRAINT client_ville REFERENCES parent(idVille) ON DELETE CASCADE"
    )
    private Ville ville;

    public Client (){

    }

    public Client(String nom, String prenom, String telephone, String adresse, Ville ville) {
        this.nom = nom;
        this.prenom = prenom;
        this.telephone = telephone;
        this.adresse = adresse;
        this.ville = ville;
    }

    public int getIdClient() {
        return idClient;
    }

    public void setIdClient(int idClient) {
        this.idClient = idClient;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getPrenom() {
        return prenom;
    }

    public void setPrenom(String prenom) {
        this.prenom = prenom;
    }

    public String getTelephone() {
        return telephone;
    }

    public void setTelephone(String telephone) {
        this.telephone = telephone;
    }

    public String getAdresse() {
        return adresse;
    }

    public void setAdresse(String adresse) {
        this.adresse = adresse;
    }

    public Ville getVille() {
        return ville;
    }

    public void setVille(Ville ville) {
        this.ville = ville;
    }

}


package com.example.dossierclient.dao;


import com.j256.ormlite.field.DatabaseField;
import com.j256.ormlite.table.DatabaseTable;

import java.util.Objects;

@DatabaseTable(tableName = "Ville")
public class Ville {
    @DatabaseField( columnName = "idVille", generatedId = true )
    private int idVille;

    @DatabaseField( columnName="nomVille",canBeNull = false)
    private String nomVille;

    public Ville(){

    }

    public Ville(String nomVille) {
        this.nomVille = nomVille;
    }

    public int getIdVille() {
        return idVille;
    }

    public void setIdVille(int idVille) {
        this.idVille = idVille;
    }

    public String getNomVille() {
        return nomVille;
    }

    public void setNomVille(String nomVille) {
        this.nomVille = nomVille;
    }


    @Override
    public String toString() {
        return this.nomVille;
    }

    @Override
    public boolean equals(Object o) {
        boolean equal = false;
        Ville ville = (Ville) o;
        if(this.idVille == ville.getIdVille()){
            equal = true;
        }
        return equal;
    }
}


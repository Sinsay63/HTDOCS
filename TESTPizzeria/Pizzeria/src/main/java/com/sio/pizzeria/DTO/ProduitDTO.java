package com.sio.pizzeria.DTO;

public class ProduitDTO {

    private int idProduit;
    private String nomProduit;
    private double prix;
    private int idTypeProduit;

    public ProduitDTO(String nomProduit, double prix, int idTypeProduit) {
        this.nomProduit = nomProduit;
        this.prix = prix;
        this.idTypeProduit = idTypeProduit;
    }

    public int getIdProduit() {
        return idProduit;
    }

    public String getNomProduit() {
        return nomProduit;
    }

    public double getPrix() {
        return prix;
    }

    public int getIdTypeProduit() {
        return idTypeProduit;
    }

    public void setIdProduit(int idProduit) {
        this.idProduit = idProduit;
    }

    public void setNomProduit(String nomProduit) {
        this.nomProduit = nomProduit;
    }

    public void setPrix(double prix) {
        this.prix = prix;
    }

    public void setIdTypeProduit(int idTypeProduit) {
        this.idTypeProduit = idTypeProduit;
    }

}

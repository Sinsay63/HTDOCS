package turboprint;

public class Cartouche {

    private String reference;

    private String libelle;

    private double prix;

    public Cartouche(String reference, String libelle, double prix) {
        this.reference = reference;
        this.libelle = libelle;
        this.prix = prix;
    }

    public String getReference() {
        return reference;
    }

    public String getLibelle() {
        return libelle;
    }

    public double getPrix() {
        return prix;
    }

    public void setReference(String reference) {
        this.reference = reference;
    }

    public void setLibelle(String libelle) {
        this.libelle = libelle;
    }

    public void setPrix(double prix) {
        this.prix = prix;
    }
    
    @Override
    public String toString(){
        return "Cartouche "+this.reference+" - "+this.libelle;
    }
}

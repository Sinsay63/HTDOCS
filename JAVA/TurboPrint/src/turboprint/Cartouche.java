package turboprint;

public class Cartouche {

    private String _reference;
    private String _libelle;
    private double _prix;

    public Cartouche(String reference, String libelle, double prix) {
        this._reference = reference;
        this._libelle = libelle;
        this._prix = prix;
    }

    public double getPrix() {
        return _prix;
    }

    @Override
    public String toString() {
        return "Cartouche "+this._reference + " - " + this._libelle;
    }
}

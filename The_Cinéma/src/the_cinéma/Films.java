package the_cinéma;
public class Films {
    
    private String _nom;
    private String _realisateur;
    private String _theme;
    private float _prix;

    public String getNom() {
        return _nom;
    }

    public String getRealisateur() {
        return _realisateur;
    }

    public String getTheme() {
        return _theme;
    }

    public float getPrix() {
        return _prix;
    }

    public void setNom(String nom) {
        this._nom = nom;
    }

    public void setRealisateur(String realisateur) {
        this._realisateur = realisateur;
    }

    public void setTheme(String theme) {
        this._theme = theme;
    }

    public void setPrix(float prix) {
        this._prix = prix;
    }
}

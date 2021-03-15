package the_cinéma;

public class Spectateur {
    private String _nom;
    private String _prénom;
    private int _culturePoints=0;
    
    public Spectateur(String nom,String prénom){
        this._nom=nom;
        this._prénom=prénom;
    }

    public String getNom() {
        return _nom;
    }

    public String getPrénom() {
        return _prénom;
    }

    public int getCulturePoints() {
        return _culturePoints;
    }
    
    public void regardeFilm(Cinéma ciné,String movie_name){
        if(ciné.getFilm(movie_name).getNom().equals(movie_name)){
            float coût = ciné.getTrésorerie()+4.5f;
            ciné.setTrésorerie(coût);
            this._culturePoints++;
            System.out.println("Le prix de la séance est de 4.5 € et la trésorerie du cinéma est de "+ciné.getTrésorerie()+" €.");
        }
        else{
            System.out.println("Le film que vous recherchez n'est pas disponible dans notre établissement. Veuillez-nous excuser.");
        }
    }
}

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
        Films film = ciné.getFilm(movie_name);
            if(film!=null){
                float coût = ciné.getTrésorerie()+film.getPrix();
                ciné.setTrésorerie(coût);
                this._culturePoints++;
                System.out.println("Le prix de la séance est de "+film.getPrix()+" € et la trésorerie du cinéma est de "+ciné.getTrésorerie()+" €.");
                System.out.println(this.getPrénom()+" "+this.getNom()+" a "+this.getCulturePoints()+" point(s) de culture.");
            }
        else{
            System.out.println("Le film que vous recherchez n'est pas disponible dans notre établissement. Veuillez-nous excuser.");
        } 
    }
}
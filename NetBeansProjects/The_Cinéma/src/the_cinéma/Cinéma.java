package the_cinéma;
import java.util.ArrayList;
public class Cinéma {
    

    private String _nom;
    private String _adresse;
    private float _trésorerie;
    private ArrayList<Films> _listFilms = new ArrayList<Films>() ;

    public String getNom() {
        return _nom;
    }

    public String getAdresse() {
        return _adresse;
    }

    public float getTrésorerie() {
        return _trésorerie;
    }

    public void setNom(String nom) {
        this._nom = nom;
    }

    public void setAdresse(String adresse) {
        this._adresse = adresse;
    }

    public void setTrésorerie(float trésorerie) {
        this._trésorerie = trésorerie;
    }

   public Films getFilm(String movie_name){
       for (Films movie: _listFilms){
           if(movie.getNom().equals(movie_name)){
                return movie;
            }
        }
       return null;
    }
   
   public void addFilm(Films movie){
       int présent =0;
       for(Films film : _listFilms){
           if(film.getNom().equals(movie.getNom())){
               présent++;
            }
       }
       if(présent==0){
           _listFilms.add(movie);
       }
   }
   
   public void removeFilm(String movie_name){
       for(Films film : _listFilms){
            if(film.getNom().equals(movie_name)){
                _listFilms.remove(film);
            }
       }
   }
}

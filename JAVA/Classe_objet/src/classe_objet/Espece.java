package classe_objet;

public class Espece {
    public String _NomEspece;
    public static String _NomDerniereEspece;
    
    public void enregistreEspece(){
        this._NomDerniereEspece= _NomEspece;
    }
}

package les_escargours;
public class Carapaces {
    
    private String _format;
    private String _couleur;

    
    public Carapaces(String couleur,String format){
        this._couleur=couleur;
        if(format.equals("S") || format.equals("M") || format.equals("L") || format.equals("XL")){
            this._format=format;
        }
        else{
            this._format="S";
        }
    }
    
    
    public String getFormat() {
        return _format;
    }

    public String getCouleur() {
        return _couleur;
    }

    public void setFormat(String _format) {
        this._format = _format;
    }

    public void setCouleur(String _couleur) {
        this._couleur = _couleur;
    }
}

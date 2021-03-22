package les_escargours;
import java.util.ArrayList;
public class Escargours {
    private String _nom;
    private ArrayList<Carapaces> _listCarapaces = new ArrayList<Carapaces>();

    public Escargours(String nom){
        this._nom=nom;
    }
    public int NbCarapaces(){
        return this._listCarapaces.size();
    }
    
    public void displayInformations(){
        System.out.println(this._nom+" l'escargours possède "+this._listCarapaces.size()+" carapaces.");
    }    
     public void addCarapace(String couleur,String format){
        Carapaces carapace = new Carapaces(couleur,format);
        _listCarapaces.add(carapace);
    }
     
    public void displayCaracteristiques(Carapaces carapace){
        System.out.println("La carapace est "+carapace.getCouleur()+" et de taille "+carapace.getFormat()+" ."); 
    }
    
    public void displayCarapaces(){
        for( Carapaces carapace : _listCarapaces){
            displayCaracteristiques(carapace);
        }
    }
    

    public void setNom(String _nom) {
        this._nom = _nom;
    }

    public String getNom() {
        return _nom;
    }
}

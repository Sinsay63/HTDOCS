package les_escargours;
import java.util.ArrayList;
public class Colonie {
    private String _nom;
    private ArrayList<Escargours> _listEscargours = new ArrayList<Escargours>();

    public Colonie(String nom){
        this._nom=nom;
    }
    
    public Escargours findEscargoursByName(String nom){
        for(Escargours esca : _listEscargours){
            if(esca.getNom().equals(nom)){
                return esca;
            }
        }
        return null;
    }
    
    public boolean containsEscargours(Escargours esca){
        for(int i=0;i<_listEscargours.size();i++){
            if(_listEscargours.get(i)==esca){
                return true;
            }
        }
        return false;
    }
    public void addEscargours(Escargours esca){
        if(this._listEscargours.size()<=14){
            boolean in= containsEscargours(esca);
            if(in==false){
                this._listEscargours.add(esca);
            }
            else{
                System.out.println(esca.getNom()+" l'escargours est déjà dans cette colonie.");
            }
        }
        else{
            System.out.println("Le nombre maximal d'escargours a été atteint dans cette colonie.");
        }
    }
    
    public String getNom() {
        return _nom;
    }


    public void setNom(String _nom) {
        this._nom = _nom;
    }

    public void banEscargours(Escargours esca){
         boolean in= containsEscargours(esca);
        if(in==true){
            this._listEscargours.remove(esca);
            System.out.println(esca.getNom()+" l'escargours a bien été banni de la colonie.");
        }
        else{
            System.out.println("Cet escargours n'est pas dans cette colonie");
        }
    }

    public int getTotalNbCarapaces(Colonie colo){
        int nbtotcata=0;
        for (Escargours esca :colo._listEscargours){
            nbtotcata+=esca.NbCarapaces();
        }
        return nbtotcata;
    }
}

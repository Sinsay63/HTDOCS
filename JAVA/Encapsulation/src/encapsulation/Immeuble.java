package encapsulation;
public class Immeuble {
    private float _hauteur=12;
    
    public float getHauteur(){
        return this._hauteur;
    }
    
    public void setHauteur(float hauteur){
        if (hauteur >=10 && hauteur<=50){
            this._hauteur=hauteur;
        }
    }
}

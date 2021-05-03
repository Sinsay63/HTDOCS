package heritage;

public class Rectangle extends Forme {

    private float largeur;
    
    public Rectangle(float largeur, float longueur){
        this.largeur=largeur;
        this.longueur=longueur;
    }
    @Override
    public float getAire() {
        return longueur * largeur;
    }
}

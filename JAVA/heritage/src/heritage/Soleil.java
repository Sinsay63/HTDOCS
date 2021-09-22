package heritage;

public class Soleil extends Etoile {

    public Soleil(float intensite){
        super.setIntensiteLumineuse(intensite);
    }
    
    public void allumer(float brightness) {
        super.setIntensiteLumineuse(super.getIntensiteLumineuse() + brightness);
    }
}

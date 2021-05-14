package heritage;

public class Soleil extends Etoile {

    public void allumer(float brightness) {
        float inten = this.getIntensiteLumineuse() + brightness;
        this.allumer(inten);

    }
}

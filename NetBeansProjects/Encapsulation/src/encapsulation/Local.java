package encapsulation;

public class Local {
    private float loyerHT=500;
    
    public float getLoyerTTC(){
        float loyerTTC= this.loyerHT* 1.2f;
        return loyerTTC;
    }
}

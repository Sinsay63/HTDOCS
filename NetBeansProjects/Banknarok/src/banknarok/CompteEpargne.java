package banknarok;

public class CompteEpargne extends Compte {

    private float taux;

    public CompteEpargne(int numero, float solde, float plafond,float taux) {
        super(numero, solde, plafond);
        this.taux=taux;
    }

    public float getTaux() {
        return taux;
    }

    public void setTaux(float taux) {
        this.taux = taux;
    }
    
    public float getIntêretsAnnuel(){
        float interet =super.getSolde();
        interet=interet * (1+taux/100);
        return interet;
    }
    
    
    @Override
    public String toString(){
        return "Compte épargne n°" + getNumero();
    }
}

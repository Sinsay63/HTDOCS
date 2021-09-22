package banknarok;

public class CompteEpargne extends Compte {

    private float interet;

    public CompteEpargne(int numero, float solde, float plafond, float interet) {
        super(numero, solde, plafond);
        this.interet = interet;
    }

    public float getInteret() {
        return this.interet;
    }

    public float getInteretsAnnuel() {
        return super.getSolde() * (1 + interet / 100);
    }

    @Override
    public String toString() {
        return "Compte épargne n°" + super.getNumero();
    }
}

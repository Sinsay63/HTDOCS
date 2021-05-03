package banknarok;

import java.util.ArrayList;

public class CompteCourant extends Compte {

    private ArrayList<Operation> listOperation;
    private float découvertMax;

    public CompteCourant(int numero, float solde, float plafond,float découvertMax) {
        super(numero, solde, plafond);
        this.découvertMax= découvertMax;
        listOperation = new ArrayList<>();
    }

    public float getDécouvertMax() {
        return découvertMax;
    }

    public void setDécouvertMax(float découvertMax) {
        this.découvertMax = découvertMax;
    }

    @Override
    public boolean debiter(float montant) {
        float debite = getSolde() - montant;
        if (debite > découvertMax) {
            this.setSolde(debite);
            return true;
        }
        return false;
    }

    @Override
    public String toString() {
        return "Compte courant n°" + getNumero();
    }
}

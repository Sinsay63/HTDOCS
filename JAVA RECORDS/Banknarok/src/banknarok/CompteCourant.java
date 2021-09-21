package banknarok;

import java.util.Date;

public class CompteCourant extends Compte {

    private float decouvert;

    public CompteCourant(int numero, float solde, float plafond, float decouvert) {
        super(numero, solde, plafond);
        this.decouvert = decouvert;
    }

    public float getDecouvert() {
        return decouvert;
    }

    public void setDecouvert(float decouvert) {
        this.decouvert = decouvert;
    }

    @Override
    public boolean debiter(float montant) {
        boolean success = false;
        if (montant > 0) {
            super.setSolde(super.getSolde() - montant);
            Opération operation = new Opération(-montant, new Date());
            super.getListeOperation().add(operation);
            success = true;
        }
        return success;
    }

    @Override
    public String toString() {
        return "Compte courant n°" + super.getNumero();
    }

}

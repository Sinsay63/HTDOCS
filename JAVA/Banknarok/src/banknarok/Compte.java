package banknarok;

import ezbanking.EzAccount;
import java.util.ArrayList;
import java.util.Date;

public class Compte extends ezbanking.EzAccount {

    private ArrayList<Operation> listOperation;

    public Compte(int numero, float solde, float plafond) {
        super(numero, solde, plafond);
        this.listOperation = new ArrayList<>();
    }

    public ArrayList<Operation> getListOperations() {
        return this.listOperation;
    }

    @Override
    public boolean crediter(float montant) {
        boolean success = super.crediter(montant);
        if (success) {
            Operation op = new Operation(montant, new Date());
            this.listOperation.add(op);
        }

        return success;
    }

    @Override
    public boolean debiter(float montant) {
        boolean success = super.debiter(montant);
        if (success) {
            Operation op = new Operation(-montant, new Date());
            this.listOperation.add(op);
        }
        return success;
    }

    @Override
    public String toString() {
        return "Compte n°" + getNumero();
    }

    @Override
    public boolean transferer(EzAccount compteDestination, float montant) {
        boolean success = false;
        if (this.debiter(montant)) {
            if (compteDestination.crediter(montant)) {
                success = true;
            } else {
                this.crediter(montant);
            }
        }
        return success;
    }
}

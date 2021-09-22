package banknarok;

import ezbanking.EzAccount;
import java.util.ArrayList;
import java.util.Date;

public class Compte extends ezbanking.EzAccount {

    private ArrayList<Opération> listeOperation;

    public Compte(int numero, float solde, float plafond) {
        super(numero, solde, plafond);
        this.listeOperation = new ArrayList<Opération>();
    }

    public ArrayList<Opération> getListeOperation(){
        return this.listeOperation;
    }
    
    
    @Override
    public boolean debiter(float montant) {
        boolean success = false;
        if (montant > 0 && super.getSolde() >= montant) {
            super.setSolde(super.getSolde() - montant);
            Opération operation = new Opération(-montant, new Date());
            this.listeOperation.add(operation);
            success = true;
        }
        return success;
    }

    @Override
    public boolean crediter(float montant) {
        boolean success = false;
        if (montant > 0 && super.getPlafond() > montant) {
            super.setSolde(super.getSolde() + montant);
            Opération operation = new Opération(montant, new Date());
            this.listeOperation.add(operation);
            success = true;
        }
        return success;
    }

    @Override
    public boolean transferer(EzAccount compte, float montant) {
        boolean success = false;
        if (this.debiter(montant)) {
            if (!compte.crediter(montant)) {
                this.crediter(montant);
            }
            else{
                success = true;
            }
        }
        return success;
    }
    
    @Override
    public String toString(){
        return "Compte n°"+super.getNumero();
    }
}

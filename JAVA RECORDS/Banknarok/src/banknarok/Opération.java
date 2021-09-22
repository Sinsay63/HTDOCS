package banknarok;

import java.text.SimpleDateFormat;
import java.util.Date;

public class Opération extends ezbanking.EzOperation {

    public Opération(float montant, Date dateOperation) {
        super(montant, dateOperation);
    }

    @Override
    public String toString() {
        String simpleDateFormat = new SimpleDateFormat("dd/MM/yyyy ").format(getDateOperation());
        String simpleHeureFormat = new SimpleDateFormat("hh:mm").format(getDateOperation());
        String chaine = "";
        if (getMontant() > 0) {
            chaine = "Opération du " + simpleDateFormat + "à " + simpleHeureFormat + " -> +" + getMontant() + "€.";
        }
        else {
            chaine = "Opération du " + simpleDateFormat + "à " + simpleHeureFormat + " -> " + getMontant() + "€.";
        }
        return chaine;
    }
}

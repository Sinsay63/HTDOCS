package banknarok;
import ezbanking.EzOperation;
import java.text.SimpleDateFormat;
import java.util.Date;

public class Operation extends ezbanking.EzOperation {

    public Operation(float montant, Date dateOperation) {
        super(montant, dateOperation);
    }

    @Override
    public String toString() {
        String simpleDateFormat = new SimpleDateFormat("dd/MM/yyyy ").format(getDateOperation());
        String simpleHeureFormat = new SimpleDateFormat("hh:mm").format(getDateOperation());
        return "Opération du " + simpleDateFormat + " à " + simpleHeureFormat + " -> " + getMontant() + "€.";
    }
}

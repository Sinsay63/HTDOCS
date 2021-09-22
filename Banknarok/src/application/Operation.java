package application;

import java.text.SimpleDateFormat;
import java.util.Date;

public class Operation extends ezbanking.EzOperation{
	
	public Operation(float montant, Date dateOperation) {
		super(montant, dateOperation);
	}
	
	@Override
	public String toString()
	{
		String dateFormatee = new SimpleDateFormat("dd/MM/yyyy").format(getDateOperation());
		String heureFormatee = new SimpleDateFormat("HH:mm").format(getDateOperation());
		return "Opération du " + dateFormatee + " à " + heureFormatee + " -> " + getMontant() + "€";
	}
}

package application;

import java.util.Date;

public class CompteCourant extends Compte
{
	private float decouvertAutorise;
	
	public float getDecouvertAutorise() {
		return decouvertAutorise;
	}

	public void setDecouvertAutorise(float decouvertAutorise) {
		this.decouvertAutorise = decouvertAutorise;
	}

	public CompteCourant(int numero, float solde, float plafond, float decouvertAutorise) {
		super(numero, solde, plafond);
		this.decouvertAutorise = decouvertAutorise;
	}
	
	@Override
	public boolean debiter(float montant)
	{
		boolean success = false;
		
		float argentRestant = getSolde() - montant;
		
		if (argentRestant >= -decouvertAutorise)
		{
			Operation op = new Operation(-montant, new Date());
			getListOperations().add(op);
			
			setSolde(argentRestant);
			success = true;
		}
		
		return success;
	}
	
	@Override
	public String toString()
	{
		return "Compte courant n°" + getNumero();
	}
}

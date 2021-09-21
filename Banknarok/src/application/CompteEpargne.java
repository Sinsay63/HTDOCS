package application;

public class CompteEpargne extends Compte
{
	private float tauxInteret;
	
	public CompteEpargne(int numero, float solde, float plafond, float tauxInteret) {
		super(numero, solde, plafond);
		this.tauxInteret = tauxInteret;
	}

	public float getTauxInteret() {
		return tauxInteret;
	}

	public void setTauxInteret(float tauxInteret) {
		this.tauxInteret = tauxInteret;
	}
	
	public float getMontantInterets()
	{
		return getSolde() * this.tauxInteret;
	}
	
	@Override
	public String toString()
	{
		return "Compte épargne n°" + getNumero();
	}
}

package application;

import java.util.ArrayList;

public class Client
{	
	private String prenom;
	private String nom;
	private ArrayList<Compte> listeComptes;

	public String getNom() {
		return nom;
	}

	public void setNom(String nom) {
		this.nom = nom;
	}

	public String getPrenom() {
		return prenom;
	}

	public void setPrenom(String prenom) {
		this.prenom = prenom;
	}

	public void addAccount(Compte compte)
	{
		listeComptes.add(compte);
	}
	
	public void removeAccount(int numCompte)
	{
		for(Compte compte : listeComptes)
		{
			if (compte.getNumero() == numCompte)
			{
				listeComptes.remove(compte);
				break;
			}
		}
	}

	public ArrayList<Compte> getListeComptes()
	{
		return listeComptes;
	}
	
	public Client(String prenom, String nom) {
		this.prenom = prenom;
		this.nom = nom;
		this.listeComptes = new ArrayList<>();
	}
	
	public float getSoldeTotal()
	{
		float solde = 0;
		
		for(int cpt = 0 ; cpt < listeComptes.size(); cpt++)
		{
			Compte compte = listeComptes.get(cpt);
			solde += compte.getSolde();
		}
		
		return solde;
	}
	
	public Compte getCompteWithNumero(int numeroCompte)
	{
		Compte compte = null;
				
		for(int cpt = 0 ; cpt < listeComptes.size(); cpt++)
		{
			Compte currentCompte = listeComptes.get(cpt);
			
			if (currentCompte.getNumero() == numeroCompte)
			{
				compte = currentCompte;
			}
		}
		
		return compte;
	}
}

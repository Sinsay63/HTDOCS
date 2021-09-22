package application;

public class MainApplication 
{
	public static void main(String[] args)
	{
		
		Client clientCharlie = new Client("Charlie", "Toral");
		clientCharlie.addAccount(new Compte(45844, 600, 23000));
		
		Client clientAlbert = new Client("Albert", "Muda");
		clientAlbert.addAccount(new CompteCourant(25498, 200, 12000, 300));
		clientAlbert.addAccount(new CompteEpargne(12710, 800, 83500, 0.02f));
		
		clientCharlie.getCompteWithNumero(45844).transferer(clientAlbert.getCompteWithNumero(25498), 500);
		
		System.out.println("Solde du compte d'Albert : " + clientAlbert.getCompteWithNumero(25498).getSolde());
		
		clientCharlie.getCompteWithNumero(45844).crediter(1500);
		System.out.println("Solde du compte de Charlie : " + clientCharlie.getCompteWithNumero(45844).getSolde());
		System.out.println(clientCharlie.getCompteWithNumero(45844).getListOperations());
		
		System.out.println("Solde total des comptes d'Albert : " + clientAlbert.getSoldeTotal());
		CompteEpargne compteEp = (CompteEpargne) clientAlbert.getCompteWithNumero(12710);
		System.out.println("Intérêts du compte épargne d'Albert : " + compteEp.getMontantInterets());
		
		CompteCourant compteCourant = (CompteCourant) clientAlbert.getCompteWithNumero(25498);
		System.out.println("Découvert max du compte courant d'Albert : " + compteCourant.getDecouvertAutorise());
	}
}

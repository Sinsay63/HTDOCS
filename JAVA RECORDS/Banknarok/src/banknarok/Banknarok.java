package banknarok;

public class Banknarok {

    public static void main(String[] args) {
        
        Client client1 = new Client("TORAL", "Charlie");
        Compte Compte1 = new Compte(1, 600, 23000);
        
        Client client2 = new Client("MUDA", "Albert");
        CompteCourant Compte2 = new CompteCourant(2, 200, 12000, 300);
        CompteEpargne Compte3 = new CompteEpargne(3, 800, 83500, 2);
        
        client1.addCompte(Compte1);
        client2.addCompte(Compte2);
        client2.addCompte(Compte3);
        
        Compte1.transferer(Compte2,500);
        System.out.println("Le solde du compte courant d'Albert est de "+Compte2.getSolde());
        Compte1.crediter(1500);
        System.out.println("Le solde du compte de Charlie est de "+Compte1.getSolde());
        for (Opération opération : Compte1.getListeOperation()){
            System.out.println(opération.toString());
        }
        System.out.println("Le solde total des comptes d'Albert est de "+client2.getSoldeAllComptes()+"€.");
        System.out.println("Les intêrets du compte épargne n°"+Compte3.getNumero()+" d'Albert sont de "+Compte3.getInteret()+"% et le découvert maximal de son compte courant n°"+Compte2.getNumero()+" est de "+Compte2.getDecouvert()+"€.");
    }
}

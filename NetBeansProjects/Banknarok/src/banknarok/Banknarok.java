package banknarok;

public class Banknarok {

    public static void main(String[] args) {
        Compte Compte1 = new Compte(1, 600, 23000);
        CompteCourant Compte2 = new CompteCourant(2, 200, 12000, 300);
        CompteEpargne Compte3 = new CompteEpargne(3, 800, 83500, 2);
        Clients client1 = new Clients("TORAL", "Charlie");
        Clients client2 = new Clients("MUDA", "Albert");
        client1.addAccount(Compte1);
        client2.addAccount(Compte2);
        client2.addAccount(Compte3);
        
        Compte1.transferer(Compte2,500);
        System.out.println("Le solde du compte courant d'Albert est de "+Compte2.getSolde());
        Compte1.crediter(1500);
        System.out.println("Le solde du compte de Charlie est de "+Compte1.getSolde());
        for (Operation op : Compte1.getListOperations()){
            System.out.println(op.toString());
        }
        System.out.println("Le solde total des comptes d'Albert est de "+client2.getSoldeTotalComptes()+"€.");
        System.out.println("Les intêrets du compte épargne d'Albert sont de "+Compte3.getTaux()+"% et le découvert maximal de son compte courant est de "+Compte2.getDécouvertMax()+"€.");
    }
}

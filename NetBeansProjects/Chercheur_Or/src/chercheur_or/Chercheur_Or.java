
package chercheur_or;
import java.util.Scanner;
public class Chercheur_Or {
    public static void main(String[] args) {
        
        int taille_terrain=3;
        int terrain[][] = new int[taille_terrain][taille_terrain]; 
        int pepite=0;
        int pep =0;
        boolean jouer =false;
        int tour=1;
        while(!jouer){
            if(tour==1){
                for (int y=0;y<terrain.length;y++){
                    pep =0 + (int)(Math.random() * ((taille_terrain-1 - 0) + 1));
                    terrain[y][pep]=1;
                    pepite++;
                }
            }
        for (int y=0;y<terrain.length;y++){
            for (int i=0;i<terrain.length;i++){
                if(terrain[y][i]==0){
                    System.out.print(" - ");
                    int pepi=0;
                }
                else{
                    System.out.print(" - ");
                    int peps=1;
                }
            }
            System.out.println();
       }
       int pepit=0;
       while(pepit<taille_terrain){
            System.out.println();
            System.out.println("Tour "+tour+":");
            System.out.println("Entrez le numéro de la ligne: ");
            Scanner sais1 = new Scanner(System.in);
            int  ligne= sais1.nextInt();
        
            while(ligne<0 || ligne>(taille_terrain-1)){
                System.out.println("Erreur saisie valeur ligne: Saisissez une valeur entre 0 et "+(taille_terrain-1));
                ligne= sais1.nextInt();
            }
        
            System.out.println("Entrez le numéro de la colonne: ");
            Scanner sais2 = new Scanner(System.in);
            int colon= sais2.nextInt();

            while(colon<0 || colon>(taille_terrain-1)){
                System.out.println("Erreur saisie valeur colonne: Saisissez une valeur entre 0 et "+(taille_terrain-1));
                colon= sais2.nextInt();
            }
                while(terrain[ligne][colon]==2 || terrain[ligne][colon]==3){
                    System.out.println("Valeur déjà saisie. Veuillez en saisir une nouvelle.");
                    System.out.println("Entrez le numéro de la ligne: ");
                    ligne= sais1.nextInt();
                    System.out.println("Entrez le numéro de la colonne: ");
                    colon= sais2.nextInt();
                 }

            if (terrain[ligne][colon]==0){
                terrain[ligne][colon]=3;
            }
            else if(terrain[ligne][colon]==1){
                terrain[ligne][colon]=2;
                pepit+=1;
            }

            for (int y=0;y<terrain.length;y++){
                for (int i=0;i<terrain.length;i++){
                    if(terrain[y][i]==0){
                        System.out.print(" - ");
                    }
                    else if(terrain[y][i]==1){
                        System.out.print(" - ");
                    }
                    else if(terrain[y][i]==2){
                        System.out.print(" X ");
                    }
                    else if(terrain[y][i]==3){
                        System.out.print(" O ");
                    }
                }
                System.out.println();
           }
            if(pepit>=taille_terrain){
                break;
            }
            tour++;
           }
            System.out.println("Vous avez trouvé toutes les pépites en "+tour+" tours.");
            System.out.println("Souhaitez-vous rejouer? (1 /Oui | 0 /Non");
            Scanner replay = new Scanner(System.in);
            int rejouer= replay.nextInt();
            while(rejouer<0 || rejouer>1){
                System.out.println("Valeur erronée, saisissez une valeur entre 0 et 1.");
                rejouer= replay.nextInt();
            }
            if (rejouer==1){
                tour=1;
                pepite=0;
            }
            else {
                break;
            }
        }
        System.out.println("Merci d'avoir joué!");
    }
}

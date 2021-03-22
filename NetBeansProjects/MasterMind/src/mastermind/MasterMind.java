

package mastermind;
import java.util.Scanner;
public class MasterMind {

    public static void main(String[] args) {
        int jeu=1;
        while (jeu==1){
        int tour=1;
            System.out.println("Tour "+tour);
        int Min = 1;
        int Max = 3;
        int nb=3;
        int[] Tab1 = new int [nb];
        for (int i=0; i< Tab1.length ; i++){
            int nb1 =Min + (int)(Math.random() * ((Max - Min) + 1));
            Tab1[i]=nb1;
            System.out.println(Tab1[i]);
        }
        int compteur=0;
        while (compteur!=3){
            System.out.println("Veuillez choisir 3 chiffres compris entre 1 et 3.");
            int[] Tab2 = new int [3];
            for (int i=0; i< Tab2.length ; i++){
                int i2=i+1;
                System.out.println("chiffre "+ i2+":");
                Scanner sais1 = new Scanner(System.in);
                int  saisie= sais1.nextInt(); 
                while(saisie <1 || saisie>3){
                    System.out.println("Valeur non comprise entre 1 et 3. Entrez à nouveau la "+i2+" valeur");
                    saisie= sais1.nextInt(); 
                }
                Tab2[i]=saisie;
            }
            for (int i=0; i<Tab1.length;i++){
                for (int y=0;y<Tab1.length;y++){
                    if (Tab1[i]== Tab2[i]){
                        compteur++;
                        break;
                    }
                }
            }
            if(compteur==3){
                System.out.println("Vous avez trouvé tous les nombres.");
            }
            else{
                System.out.println("Vous n'avez pas trouvé.");
                System.out.println("Vous avez "+compteur+ " correspondances.");
                compteur=0;
                tour++;
            break;
            }
        }
        }
    }
}

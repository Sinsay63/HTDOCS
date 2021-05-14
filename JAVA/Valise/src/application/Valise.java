package application;
import java.util.Scanner;
public class Valise {

  
    public static void main(String[] args) {
        
        
        Voiture Peugeot = new Voiture();
        System.out.println("Voiture de couleur "+Peugeot._couleur);
        
        
        
        Vaisseau Nimbus2000 = new Vaisseau();
        Nimbus2000._vitesse = 25.2f;
        Nimbus2000._blindage = 500;
        System.out.println("Vaisseau ayant un blindage de "+Nimbus2000._blindage+" et une vitesse de "+Nimbus2000._vitesse+".");
        
        
        
        OperatingSystem OS = new OperatingSystem();
        System.out.println("Entrez un nombre entre 1 et 3 :");
        Scanner sais1 = new Scanner(System.in);
        int  nb= sais1.nextInt();
        while (nb <1 && nb> 3){
            nb= sais1.nextInt();
        }
        switch (nb){
            case 1:
                OS._nom="Windows";
                break;
            case 2:
                OS._nom="Linux";
                break;
            case 3:
                OS._nom="MacOS";
                break;
            default:
                OS._nom="Android";
                break;
        }
        System.out.println("Vous avec choisi "+OS._nom+" comme Système d'Exploitation.");
        
        
        
        Ours Winnie = new Ours();
        Winnie.DisplayOursCouleur();
        
        
        
        Ornythorinque Penny = new Ornythorinque();
        boolean angoisse = Penny.testAngoisse();
        if(angoisse==true){
            System.out.println("Penny l'ornythorinque est angoissé.");
        }
        else{
            System.out.println("Penny l'ornythorinque pète la forme!");
        }
        
        
        
        if(MillesPattes._nbPattes>100){
            MillesPattes._nbPattes=100;
        }
        System.out.println("Le Milles-Pattes a "+MillesPattes._nbPattes+" pattes.");
        
        
        
        String mot = "kayak";
        
        boolean palin = Palindrome.isPalindrome(mot);
        if( palin== true){
           System.out.println("Le mot "+mot+" est un palindrome"); 
        }
        else{
            System.out.println("Le mot "+mot+" n'est pas un palindrome."); 
        }
        
    }
    
}

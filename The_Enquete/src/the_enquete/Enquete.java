package the_enquete;
import java.util.ArrayList;
public class Enquete {
    public static void displaySuspect(ArrayList<Suspect> liste){
        if (liste.isEmpty()){
            System.out.println("Erreur: la liste est vide.");
        }
        else{
            for (Suspect sus : liste){
                sus.displaySus();
            }
        }
    }
    
    public static void rmvSuspect(String nom, String prénom,ArrayList<Suspect> liste){
        for (Suspect rmvsus : liste){
            if(rmvsus._nom.equals(nom) && rmvsus._prénom.equals(prénom)){
                liste.remove(rmvsus);
                break;
            }
        }
    }
    public static void InverseSuspect(int pos_now,int to_pos,ArrayList<Suspect> liste) {
        Suspect actuel= liste.get(to_pos);
        liste.set(to_pos, liste.get(pos_now));
        liste.set(pos_now, actuel);
    }
    
    public static void rmvSus(String profession,ArrayList<Suspect> liste){
        for (Suspect rmvsus : liste){
            if(rmvsus._profession.equals(profession)){
                liste.remove(rmvsus);
                break;
            }
        }
    }
    public static void displayEnd(Suspect suspectfinal){
            System.out.println("L'enquête est terminée, le coupable est "+suspectfinal._prénom+" "+suspectfinal._nom+" le "+suspectfinal._profession+".");
    }
}
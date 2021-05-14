package interfaces;

import java.util.ArrayList;

public class Interfaces {

    public static void main(String[] args) {
//        RestaurationPotion pot1 = new RestaurationPotion(150, 100);
//        
//        System.out.println("Le montant de heal de la potion est de " +pot1.getHeal()+" points de vie");
//        System.out.println("Le montant de mana de la potion est de " +pot1.getMana()+" points de mana");
        
        ArrayList<Object> liste = new ArrayList<>();
        liste.add(new RegenEffect());
        liste.add(new PoisonEffect());
        liste.add(new ResistanceEffect());
        
        for(Object obj : liste){
            if(obj instanceof BonusEffect){
                System.out.println("La classe " +obj.getClass().getName()+" vous obtroit un effect bénéfique.");
            }
        }
    }
}

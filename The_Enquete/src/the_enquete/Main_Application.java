package the_enquete;

import java.util.ArrayList;

public class Main_Application {

    public static void main(String[] args) {
        ArrayList<Suspect> suspect = new ArrayList<>();
        Suspect suspect_1 = new Suspect();
        Suspect suspect_2 = new Suspect();
        Suspect suspect_3 = new Suspect();
        
        suspect_1._nom="Hongrois";
        suspect_1._prénom="Stéphane";
        suspect_1._profession="serveur";
        suspect_1._mobile="argent";
        suspect_1._alibi="camarade";
        
        suspect_2._nom="Parchardon";
        suspect_2._prénom="Léa";
        suspect_2._profession="cuisinière";
        suspect_2._mobile="argent";
        suspect_2._alibi="sa famille";
        
        suspect_3._nom="Riconet";
        suspect_3._prénom="Albert";
        suspect_3._profession="homme d'entretien";
        suspect_3._mobile="aucun";
        suspect_3._alibi="";
        
        suspect.add(suspect_1);
        suspect.add(suspect_2);
        suspect.add(suspect_3);
        
        Enquete.rmvSuspect("Hongrois", "Stéphane", suspect);
        suspect_3._mobile="vengeange personnelle";
        Enquete.InverseSuspect(1, 0, suspect);
        Enquete.rmvSus("homme d'entretien", suspect);
        suspect_2._mobile="apprendre la recette";
        Enquete.rmvSus("cuisinière", suspect);
        
        Suspect suspect_4 = new Suspect();
        suspect_4._nom="Patate";
        suspect_4._prénom="Gustave";
        suspect_4._profession="Chef du restaurant";
        suspect_4._mobile="argent";
        suspect_4._alibi="";
        suspect.add(suspect_4);
        Enquete.displaySuspect(suspect);
        System.out.println("");
        Enquete.displayEnd(suspect_4);
        suspect.clear();
    
    }
}

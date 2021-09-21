package escargours;

import java.util.ArrayList;

public class Escargours {

    private String nom;

    private ArrayList<Carapace> listeCarapace = new ArrayList<Carapace>();

    public Escargours(String nom) {
        this.nom = nom;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }
    
    public void displayInformations(){
        System.out.println("L'escargours se nommant "+this.nom+" possède "+ this.listeCarapace.size()+" carapace(s).");
    }
    
    public void addCarapace(String couleur, String taille){
        Carapace carapace = new Carapace(couleur,taille);
        this.listeCarapace.add(carapace);
    }
    
    public void displayCarapaces(){
        for(Carapace carapace : this.listeCarapace){
            System.out.println("Cette carapace est "+ carapace.getCouleur()+" et a une taille "+carapace.getTaille());
        }
    }
    
}

package escargours;

public class Carapace {

    private String couleur;

    private String taille;

    public Carapace(String couleur, String taille) {
        this.couleur = couleur;
        this.taille = taille;
    }

    public String getCouleur() {
        return this.couleur;
    }

    public String getTaille() {
        return this.taille;
    }

    public void setCouleur(String couleur) {
        this.couleur = couleur;
    }

    public void setTaille(String taille) {
        this.taille = taille;
    }
    
    public void displayCaractéristiques(){
        System.out.println("Cette carapace est "+ this.couleur+" et a une taille "+this.taille);
    }

}

package escargours;

import java.util.ArrayList;

public class Colonie {

    private String nom;

    private ArrayList<Escargours> listeEscargours = new ArrayList<Escargours>();

    public Colonie(String nom) {
        this.nom = nom;
    }

    public String getNom() {
        return this.nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public Escargours findEscargourByName(String nomEscargours) {
        for (Escargours escargours : this.listeEscargours) {
            if (escargours.getNom() == nomEscargours) {
                return escargours;
            }
        }
        return null;
    }

    public boolean containsEscargours(Escargours esca) {
        boolean exist = false;
        for (Escargours escargours : this.listeEscargours) {
            if (escargours == esca) {
                exist = true;
            }
        }
        return exist;
    }

    public void addEscargours(Escargours escargours) {
        if (!this.listeEscargours.contains(escargours)) {
            this.listeEscargours.add(escargours);
        }
    }

    public void getBannedEscargours(Escargours escargours) {
        if (this.listeEscargours.contains(escargours)) {
            this.listeEscargours.remove(escargours);
        }
    }

    public int getTotalNbCarapaces() {
        return this.listeEscargours.size();
    }

}

package banknarok;

import java.util.ArrayList;

public class Client {

    private String nom;
    private String prenom;
    private ArrayList<Compte> listeComptes;

    public Client(String nom, String prenom) {
        this.nom = nom;
        this.prenom = nom;
        this.listeComptes = new ArrayList<Compte>();
    }

    public String getNom() {
        return nom;
    }

    public String getPrenom() {
        return prenom;
    }

    public ArrayList<Compte> getListeComptes() {
        return listeComptes;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public void setPrenom(String prenom) {
        this.prenom = prenom;
    }

    public void setListeComptes(ArrayList<Compte> listeComptes) {
        this.listeComptes = listeComptes;
    }

    public boolean addCompte(Compte compte) {
        boolean success = false;
        if (!this.listeComptes.contains(compte)) {
            this.listeComptes.add(compte);
            success = true;
        }
        return success;
    }

    public boolean deleteCompte(float numCompte) {
        boolean success = false;
        for (Compte compte : this.listeComptes) {
            if (compte.getNumero() == numCompte) {
                this.listeComptes.remove(compte);
                success = true;
            }
        }
        return success;
    }

    public Compte getCompteByNum(float numCompte) {
        for (Compte compte : this.listeComptes) {
            if (compte.getNumero() == numCompte) {
                return compte;
            }
        }
        return null;
    }

    public float getSoldeAllComptes() {
        float soldeTotal=0;
        for (Compte compte : this.listeComptes) {
            soldeTotal += compte.getSolde();
        }
        return soldeTotal;
    }
}

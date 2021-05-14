package banknarok;

import java.util.ArrayList;

public class Clients {

    private String nom;
    private String prénom;
    private ArrayList<Compte> listeComptes = new ArrayList<Compte>();

    public Clients(String nom, String prénom) {
        this.nom = nom;
        this.prénom = prénom;
    }

    public String getNom() {
        return nom;
    }

    public String getPrénom() {
        return prénom;
    }

    public ArrayList<Compte> getListeComptes() {
        return listeComptes;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public void setPrénom(String prénom) {
        this.prénom = prénom;
    }

    public boolean addAccount(Compte account) {
        boolean success = false;
        if (!listeComptes.contains(account)) {
            this.listeComptes.add(account);
            success = true;

        }
        return success;
    }

    public boolean removeAccount(Compte compte) {
        boolean success = false;
        if (!listeComptes.contains(compte)) {
            this.listeComptes.remove(compte);
            success = true;
        }
        return success;
    }
    public Compte getAccountByNuméro(int numéro){
        for(Compte account : this.listeComptes){
            if(account.getNumero()== numéro){
                return account;
            }
        }
        return null;
    }
    
    public float getSoldeTotalComptes(){
        float total = 0;
        for (Compte account : this.listeComptes){
            total+= account.getSolde();
        }
        return total;
    }
}

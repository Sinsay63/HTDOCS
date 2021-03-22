
package classe_objet;


public class Classe_objet {

    public static void main(String[] args) {
        Espece Reptile = new Espece();
        Reptile._NomEspece="Calamar";
        Reptile.enregistreEspece();
        System.out.println(Reptile._NomDerniereEspece);
    }
    
    
}

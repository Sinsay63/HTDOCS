package escargours;

public class LES_Escargours {

    public static void main(String[] args) {

        Escargours esca1 = new Escargours("Hugo");
        Escargours esca2 = new Escargours("Sylvain");
        Escargours esca3 = new Escargours("Yanis");

        Colonie colo1 = new Colonie("Les Indestructibles");
        Colonie colo2 = new Colonie("Les Inséparables");

        colo1.addEscargours(esca1);
        colo1.addEscargours(esca2);
        colo2.addEscargours(esca3);
        colo2.addEscargours(esca1);
        
        esca1.addCarapace("bleue", "XXL");
        esca1.addCarapace("verte", "M");
        esca2.addCarapace("grise", "XL");
        esca3.addCarapace("noire", "XS");
    
        esca1.displayInformations();
        esca1.displayCarapaces();
        colo1.findEscargourByName("Hugo").displayInformations();
        colo1.getTotalNbCarapaces();
        colo2.getBannedEscargours(esca3);
        if(colo2.containsEscargours(esca3)){
            esca3.displayCarapaces();
        }
        else{
            System.out.println("L'escargours " + esca3.getNom()+ " ne se trouve pas dans la colonie " + colo2.getNom());
        }

    }

}

package les_escargours;

public class Les_EscargOurs {
    public static void main(String[] args) {
        
        Colonie Colo1 = new Colonie("Godefroy");
        
        
        Escargours esca1 = new Escargours("Yanis");
        Escargours esca2 = new Escargours("Maxime");   
        Escargours esca3 = new Escargours("Tom");
        Escargours esca4 = new Escargours("Nathim");
        
        esca1.addCarapace("noire", "XS");
        esca1.addCarapace("bleue", "L");
        esca3.addCarapace("rouge", "M");
        esca3.addCarapace("noire", "M");
        esca2.addCarapace("verte", "XL");
        esca4.addCarapace("verte", "M");
        esca4.addCarapace("jaune", "L");
        esca2.addCarapace("grise", "S");
        
        
        
        Colo1.addEscargours(esca1);
        Colo1.addEscargours(esca2);
        Colo1.addEscargours(esca3);
        Colo1.addEscargours(esca4);
        
        
        //Colo1.banEscargours(esca3);
        System.out.println("Le nombre total de carapaces dans la colonie "+Colo1.getNom()+" est de "+Colo1.getTotalNbCarapaces(Colo1));
        
        esca1.displayCarapaces();
        Escargours esc =Colo1.findEscargoursByName("Yanis");
        if(esc==null){
            System.out.println("Aucun Escargours n'a été trouvé à ce nom.");
        }
        else {
            System.out.println(esc.getNom()+" se trouve bien dans la colonie.");
        }
    }
}

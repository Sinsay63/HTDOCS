package the_cinéma;
public class The_Cinéma {

    public static void main(String[] args) {
        
        Films Movie1 = new Films("Harry Potter","J.K Rowling"," Low Fantasy",6);
        
        Films Movie2 = new Films("Jurassic Park","Spielberg","Dinosaures",5.5f);
        
        Films Movie3 = new Films("The Hobbit","Peter Jackson","Fantasy",4.5f);
        
        Films Movie4 = new Films("Scream","Wes Craven","Horreur",3.5f);
        
        Cinéma Ciné1 = new Cinéma("Cinédôme","Avenue Lavoisier, 63170 Aubière");
        
        Ciné1.addFilm(Movie1);
        Ciné1.addFilm(Movie2);
        Ciné1.addFilm(Movie3);
        Ciné1.addFilm(Movie4);
        
        //Ciné1.removeFilm("Harry Potter");
        Spectateur viewer1 = new Spectateur("Houdier", "Yanis");
        Spectateur viewer2 = new Spectateur("Rayssiguier", "Clément");

        viewer1.regardeFilm(Ciné1,"Harry Potter");
        System.out.println("");
        viewer2.regardeFilm(Ciné1,"Scream");
       
        
    }
}
    

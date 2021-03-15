package the_cinéma;
public class The_Cinéma {

    public static void main(String[] args) {
        
        Films Movie1 = new Films();
        Movie1.setNom("Harry Potter");
        
        Films Movie2 = new Films();
        Movie2.setNom("Jurassic Park");
        
        Films Movie3 = new Films();
        Movie3.setNom("The Hobbit");
        
        Cinéma CinéDôme = new Cinéma();
        
        
        CinéDôme.addFilm(Movie1);
        CinéDôme.addFilm(Movie2);
        CinéDôme.addFilm(Movie3);
        
        System.out.println(CinéDôme.getFilm("Harry Potter").getNom());
        
    }
    
}

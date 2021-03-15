package the_cinéma;
public class The_Cinéma {

    public static void main(String[] args) {
        
        Films Movie1 = new Films("Harry","J.K Rowling"," Low Fantasy",35000541);
        
        Films Movie2 = new Films("Jurassic Park","Spielberg","Dinosaures",29003541);
        
        Films Movie3 = new Films("The Hobbit","Peter Jackson","Fantasy",25050541);
        
        Films Movie4 = new Films("Scream","Wes Craven","Horreur",19035054);
        
        Cinéma Ciné1 = new Cinéma("Cinédôme","Avenue Lavoisier, 63170 Aubière");
        
        Ciné1.addFilm(Movie1);
        Ciné1.addFilm(Movie2);
        Ciné1.addFilm(Movie3);
        Ciné1.addFilm(Movie4);
        
        //Ciné1.removeFilm("Harry Potter");
        Spectateur viewer1 = new Spectateur("Houdier", "Yanis");
        Spectateur viewer2 = new Spectateur("Rayssiguier", "Clément");

        viewer1.regardeFilm(Ciné1,"Harry");
        System.out.println(viewer1.getPrénom()+" "+viewer1.getNom()+" a "+viewer1.getCulturePoints()+" point(s) de culture.");
        viewer1.regardeFilm(Ciné1,"Harry");
        System.out.println(viewer2.getPrénom()+" "+viewer2.getNom()+" a "+viewer2.getCulturePoints()+" point(s) de culture.");
        
    }
}
    

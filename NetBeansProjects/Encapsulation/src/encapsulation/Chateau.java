package encapsulation;

public class Chateau {
    private int _nbTours=0;
    
    public int getNbTours(){
        return this._nbTours;
    }
    public Chateau(int tours){
            this._nbTours=tours;
    }
    public Chateau(){
        this._nbTours=1 + (int)(Math.random() * ((4 - 1) + 1));
        }
    }

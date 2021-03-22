package application;

public class Ornythorinque {
    public boolean _angoisse;
    
    public boolean testAngoisse(){
        this._angoisse=false;
    int angoisse =  1 + (int)(Math.random() * ((3 - 1) + 1));
    if(angoisse==1){
        this._angoisse=true;
    }
    return this._angoisse;
    }
}

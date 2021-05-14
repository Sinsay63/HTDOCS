package classe_objet;

public class Piment {
    
    public Integer _force;
    
    public void randomizeForce(int Min,int Max){
         _force=Min + (int)(Math.random() * ((Max - Min) + 1));
    }
    
}

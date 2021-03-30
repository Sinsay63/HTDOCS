package heritage;
import java.util.Random;
public class CustomRandom extends Random{
    
    public static int getIntBetweenValues(int nb1,int nb2){
        int nb3=0;
        if(nb1<nb2){
            nb3= nb1 + (int)(Math.random() * ((nb2 - nb1) + 1));
        }
        return nb3;
    }
}

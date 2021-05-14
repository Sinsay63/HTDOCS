package functions;
import java.util.Scanner;
public class Functions {

    public static void main(String[] args) {
        int nb1=1;
        int nb2=1;
        int nb3=1;
        boolean res=multiply(nb1,nb2,nb3);
        if(res){
            System.out.println("Oui");
        }
        else{
            System.out.println("Non");
        }
}
    
   public static boolean multiply(int nb1, int nb2,int nb3){
       
        int fois= nb1*nb2*nb3;
        int somme= nb1+nb2+nb3;
        if (fois>somme){
            return (true);
        }
        else{
            return (false);
        }
    }
}

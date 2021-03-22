package application;

import javafx.beans.binding.StringBinding;

public class Palindrome {
    
    public static String inverseString(String mot){
        String[] tab = mot.split("");
        StringBuilder strb = new StringBuilder(mot);
        mot= strb.reverse().toString();
        return mot;
    }
    
    public static boolean isPalindrome(String mot){
        int cpt = 0;
        boolean palin = false;
            if(mot.equals(Palindrome.inverseString(mot))){
                cpt++;
            }
        if(cpt>0){
            palin=true;
        }
        return palin;
    }
}

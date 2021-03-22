package morpions;
public class Morpions {

    public static void main(String[] args) {
        int[][] plateau=createEmptyPlateau(3, 3);
        displayPlateau(plateau);
        System.out.println(checkCase(plateau, 1, 1));
    }
    
    
    public static int[][] createEmptyPlateau(int nbRows, int nbColumns){
        int[][] plateau = new int[nbRows][nbColumns];
        return plateau;
    }
    
    public static void displayPlateau(int[][] plateau){
        System.out.print("  ");
        for (int col=0;col<plateau.length;col++){
            System.out.print(" "+col+" ");
        }
        System.out.println("");
        for (int i=0;i<plateau.length;i++){
            System.out.print(i+"  ");
            for (int y=0;y<plateau.length;y++){
                if (plateau[i][y]==0){
                    System.out.print("-  ");
                }
                else if(plateau[i][y]==1){
                    System.out.print("x  ");
                }
                else if (plateau[i][y]==2){
                    System.out.print("o  ");
                }
            }
            
            System.out.println("");
        }
        
    }
    public static boolean isPlateauFull(int[][] plateau){
        boolean result=false;
        for (int i=0;i<plateau.length;i++){
            for (int y=0;y<plateau.length;y++){
                if (plateau[i][y]==0){
                    result=false;
                }
                else{
                     result=true;
                }
            }
        }
        return result;
    }
    public static boolean checkCase(int[][] plateau,int ligne, int colonne){
        boolean result= false;
        for (int i=0;i<plateau.length;i++){
            for (int y=0;y<plateau.length;y++){
                if (plateau[i][y]==0 && plateau.length<ligne && plateau[i].length < colonne && plateau.length >=0){
                    result=true;
                }
                else{
                    result=false;
                }
            }
        }
        return result;
    }
    
    
    public static void fillCase(int[][] plateau,int ligne, int colonne,int joueur){
            plateau[ligne][colonne]=joueur;
    }
    
    public static boolean areEquals(int nb1, int nb2, int nb3, int nb4){
        boolean equals= false;
        if (nb1 == nb2 && nb2==nb3 && nb3==nb4 ){
            equals=true;
        }
        else{
            equals=false;
        }
        return equals;
    }
    
    public static boolean hasWon(int[][] plateau, int joueur){
       boolean result = false;
       for (int i =0; i<plateau.length;i++){
           for (int y =0; y<plateau.length;y++){
       }
       
    }
       return result;
}
}

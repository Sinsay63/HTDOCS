package encapsulation;

public class Quartier {
    private String _nom;
    private float _superficie;
    
    public Quartier(String nom, float superficie)
	{
            if (superficie<0){
                this._superficie=0;
            }
            else{
                 this._superficie=superficie;
            }
            this._nom=nom;
               
	}
    public void displayAttributs(){
        System.out.println("Le quartier s'appelle "+this._nom+" et sa superficie est de "+this._superficie+" m².");
    }
    
}

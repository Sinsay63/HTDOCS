package the_enquete;
public class Suspect {
    public String _nom;
    public String _prénom;
    public String _profession;
    public String _mobile;
    public String _alibi;

    public void displaySus(){
        System.out.println(this._nom+" "+this._prénom);
        System.out.println("Profession: "+this._profession);
        System.out.println("Mobile: "+this._mobile);
        System.out.println("Alibi: "+this._alibi);
        System.out.println("");
    }
}

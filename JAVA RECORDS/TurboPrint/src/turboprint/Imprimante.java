package turboprint;

public class Imprimante {

    private String imprimanteRef;

    private String libelle;
    
    private TypeImprimante typeImprimante;
    
    private CartouchesCollection cartouchesCompatibles;

    public Imprimante(String imprimanteRef,TypeImprimante typeImprimante, String libelle, CartouchesArray cartouchesCompatibles) {
        this.imprimanteRef = imprimanteRef;
        this.typeImprimante = typeImprimante;
        this.libelle = libelle;
        this.cartouchesCompatibles = cartouchesCompatibles;
    }

    public CartouchesCollection getCartouchesCompatibles(){
        return this.cartouchesCompatibles;
    }
    public void setCartouchesCompatibles(CartouchesCollection cartoucheCompatible){
        if(cartoucheCompatible.getNbCartouche()!=0){
            this.cartouchesCompatibles = cartoucheCompatible;
        }
    }
    
    public int getNbCartouchesCompatibles(){
        return this.cartouchesCompatibles.getNbCartouche();
    }
    
    
    @Override
    public String toString(){
        return "Imprimante "+this.imprimanteRef+" - "+this.libelle+" : "+getNbCartouchesCompatibles()+" cartouche(s) compatible(s)";
    }
}

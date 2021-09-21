package turboprint;

public class Imprimante {

    private String _imprimanteRef;
    private String _libelle;
    private TypeImprimante type;
    private CartouchesArray CartouchesCompatibles;

    public Imprimante(String imprimanteRef, TypeImprimante type, String libelle, CartouchesArray listeCartouches) {
        this._imprimanteRef = imprimanteRef;
        this._libelle = libelle;
        this.type = type;
        this.CartouchesCompatibles = listeCartouches;
    }

    public void setCartouchesCompatibles(CartouchesCollection cartouche){
        
    }
    
    
    
}

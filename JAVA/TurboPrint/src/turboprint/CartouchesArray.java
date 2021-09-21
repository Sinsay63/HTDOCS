package turboprint;


public class CartouchesArray implements CartouchesCollection {

    private Cartouche[] _listeCartouches;

    public CartouchesArray(Cartouche cart1, Cartouche cart2, Cartouche cart3, Cartouche cart4) {
        this._listeCartouches = new Cartouche[]{cart1,cart2,cart3,cart4};

    }

    @Override
    public void addCartouche(Cartouche cartouche) {
        this._listeCartouches[this._listeCartouches.length]=cartouche;
    }

    @Override
    public int getNbCartouches() {
        return this._listeCartouches.length;
    }

    @Override
    public Cartouche getCartoucheByIndex(int index) {
        return this._listeCartouches[index];
    }
    
    private int getIndexLastCartouche(){
        int taille = this._listeCartouches.length;
        
        if(taille>0){
            return taille-1;
        }
        else{
            return -1;
        }
    }

}

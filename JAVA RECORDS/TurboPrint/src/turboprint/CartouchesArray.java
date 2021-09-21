package turboprint;

public class CartouchesArray implements CartouchesCollection {

    private Cartouche[] tabCartouches;

    public CartouchesArray() {
        this.tabCartouches = new Cartouche[4];
    }

    @Override
    public void addCartouche(Cartouche cartouche) {
        int size = this.tabCartouches.length;
        boolean found = false;
        for (int i = 0; i < size; i++) {
            if (this.tabCartouches[i] == cartouche) {
                found=true;
            }
        }
        if(!found){
            this.tabCartouches[getIndexLastCartouche()+1]= cartouche;
        }
    }

    public Cartouche[] getTabCartouches() {
        return tabCartouches;
    }

    @Override
    public int getNbCartouche() {
        return getIndexLastCartouche()+1;
    }

    @Override
    public Cartouche getCartoucheByIndex(int index) {
        Cartouche cart=null;
        if(this.tabCartouches[index]!=null){
            return this.tabCartouches[index];
        }
        return cart;
    }

    public int getIndexLastCartouche() {
        int size = this.tabCartouches.length;
        int index = -1;
        for (int i = 0; i < size; i++) {
            if (this.tabCartouches[i] != null) {
                index++;
            }
            else {
                break;
            }
        }
        return index;
    }

    @Override
    public Cartouche getCheapestCartouche() {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }

}

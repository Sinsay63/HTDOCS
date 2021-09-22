package turboprint;


public interface CartouchesCollection {

    public void addCartouche(Cartouche cartouche);

    public int getNbCartouches();

    public Cartouche getCartoucheByIndex(int index);
}

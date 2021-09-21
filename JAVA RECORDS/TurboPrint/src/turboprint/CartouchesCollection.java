package turboprint;

public interface CartouchesCollection {

    public void addCartouche(Cartouche cartouche);

    public int getNbCartouche();

    public Cartouche getCartoucheByIndex(int index);
    
    public Cartouche getCheapestCartouche();

}

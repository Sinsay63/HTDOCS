package turboprint;

public class TurboPrint {

    public static void main(String[] args) {
        TypeImprimante type1 = new TypeImprimante("A4", "Laser");
        Cartouche cartouche1 = new Cartouche("T2S-FT-G22", "Cartouche turbo", 16.4);
        Cartouche cartouche2 = new Cartouche("WT-HT44-62", "Cartouche à double encoche", 10.8);
        Cartouche cartouche3 = new Cartouche("RT-2002-500X", "Cartouche laser à piston", 22.1);
        CartouchesArray cart = new CartouchesArray();
        cart.addCartouche(cartouche3);
        cart.addCartouche(cartouche2);
        Imprimante impress1 = new Imprimante("TPL-251", type1, "Turbo Printer Laserjet 251", new CartouchesArray());
        Imprimante impress2 = new Imprimante("HR-845", type1, "Ultra Printer 845", new CartouchesArray());
        
    }
}

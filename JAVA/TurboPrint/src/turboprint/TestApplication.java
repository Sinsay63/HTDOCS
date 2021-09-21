package turboprint;

public class TestApplication {

    public static void main(String[] args) {
        
        TypeImprimante type1 = new TypeImprimante("A4", "Laser");
        Cartouche cartouche1 = new Cartouche("T2S-FT-G22", "Cartouche turbo", 16.4);
        Cartouche cartouche2 = new Cartouche("WT-HT44-62", "Cartouche à double encoche", 10.8);
        Cartouche cartouche3 = new Cartouche("RT-2002-500X", "Cartouche laser à piston", 22.1);
    }

}

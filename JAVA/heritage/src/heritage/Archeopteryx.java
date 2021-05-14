package heritage;

public class Archeopteryx implements Dinosaure,Oiseau{

    @Override
    public void rugir() {
        System.out.println("Waouf!");
    }

    @Override
    public void voler() {
        System.out.println("Mes chers parents je vole!");
    }
}

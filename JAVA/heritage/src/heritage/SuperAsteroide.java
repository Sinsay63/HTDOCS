package heritage;

public class SuperAsteroide extends Asteroide {

    @Override
    public double getMasseMinerais() {
        double masseTotale = super.getMasseMinerais() * 100/3;
        return masseTotale * 8/100;
    }
}

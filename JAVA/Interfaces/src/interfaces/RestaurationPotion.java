package interfaces;

public class RestaurationPotion implements HealItem, ManaItem {

    private float _healQuantity;
    private float _manaQuantity;

    public RestaurationPotion(float healQuantity, float manaQuantity) {
        this._healQuantity = healQuantity;
        this._manaQuantity = manaQuantity;
    }

    @Override
    public float getHeal() {
        return this._healQuantity;
    }

    @Override
    public float getMana() {
        return this._manaQuantity;
    }

}

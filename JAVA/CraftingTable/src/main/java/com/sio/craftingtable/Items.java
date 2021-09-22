package com.sio.craftingtable;

import javafx.scene.image.Image;
import javafx.scene.image.ImageView;

public class Items extends ImageView {

    private String nomItem;
    
    private String imageUrl;
    
    private int quantité;
    
    public Items(String nomItem, String imageUrl, int quantité) {
        this.nomItem = nomItem;
        this.imageUrl = imageUrl;
        this.quantité= quantité;
        Image img = new Image(getClass().getResourceAsStream("/images/"+imageUrl));
        this.setImage(img);
    }

    public String getnomItem() {
        return nomItem;
    }
    
    public String getImageUrl() {
        return imageUrl;
    }

    public int getQuantité() {
        return quantité;
    }

    public void setNomItem(String nomItem) {
        this.nomItem = nomItem;
    }

    public void setImageUrl(String imageUrl) {
        this.imageUrl = imageUrl;
    }

    public void setQuantité(int quantité) {
        this.quantité = quantité;
    }
}
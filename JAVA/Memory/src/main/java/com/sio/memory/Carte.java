package com.sio.memory;

import javafx.scene.image.Image;
import javafx.scene.image.ImageView;

public class Carte extends ImageView {
    
    private int numCarte;
    
    private String etatCarte;
    
    public Carte(int numCarte, String etatCarte) {
        this.numCarte = numCarte;
        this.etatCarte = etatCarte;
        Image image = new Image(getClass().getResourceAsStream("/images/background.png"));
        this.setImage(image);
    }

    public int getNumCarte() {
        return numCarte;
    }

    public String getEtatCarte() {
        return etatCarte;
    }
    
    
}

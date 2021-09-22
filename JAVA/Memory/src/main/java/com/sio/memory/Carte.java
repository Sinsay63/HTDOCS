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
        this.setFitHeight(100);
        this.setFitWidth(100);
        this.setImage(image);
    }
    
    public void ShowCarte(){
        Image img = new Image(getClass().getResourceAsStream("/images/" + this.getNumCarte() + ".jpg"));
        this.setImage(img);
    }
    
    public void HideCarte(){
         Image img = new Image(getClass().getResourceAsStream("/images/background.png"));
        this.setImage(img);
    }
    
    
    public int getNumCarte() {
        return numCarte;
    }

    public String getEtatCarte() {
        return etatCarte;
    }

    public void setNumCarte(int numCarte) {
        this.numCarte = numCarte;
    }

    public void setEtatCarte(String etatCarte) {
        this.etatCarte = etatCarte;
    }
    
    
    
}

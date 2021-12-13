package com.sio.pizzeria;

import jakarta.ws.rs.client.Client;
import jakarta.ws.rs.client.ClientBuilder;
import jakarta.ws.rs.client.Invocation;
import jakarta.ws.rs.client.WebTarget;
import jakarta.ws.rs.core.MediaType;
import jakarta.ws.rs.core.Response;
import java.io.IOException;
import java.net.URL;
import java.util.ResourceBundle;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Label;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;
import org.json.*;

public class PrimaryController implements Initializable {

    @FXML
    private Label titre;

    @FXML
    private VBox vbox;

    @FXML
    private void switchToSecondary() throws IOException {
        App.setRoot("secondary");

    }

    @FXML
    private void getProduit() {
        Client client = ClientBuilder.newClient();
        WebTarget webTarget = client.target("http://localhost/TESTPizzeria/Pizzeria/src/main/java/com/sio/pizzeria/server/produit");

        Invocation.Builder invocationBuilder = webTarget.request(MediaType.APPLICATION_JSON);
        Response response = invocationBuilder.get();

        JSONArray jsonArray = new JSONArray(response.readEntity(String.class));
        for (int i = 0; i < jsonArray.length(); i++) {
            JSONObject json = new JSONObject(jsonArray.get(i).toString());
            HBox hbox = new HBox();
            String nomProduit = (String) json.get("nomProduit");
            String prixProduit = (String) json.get("prix");
            Label nom = new Label("nom : " + nomProduit);
            Label prix = new Label("prix : " + prixProduit);
           
            hbox.getChildren().addAll(nom,prix);
            vbox.getChildren().add(hbox);
        }

    }

    @Override
    public void initialize(URL url, ResourceBundle rb) {
        getProduit();
    }
}

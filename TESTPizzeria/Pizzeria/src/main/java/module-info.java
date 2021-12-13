module com.sio.pizzeria {
    requires javafx.controls;
    requires javafx.fxml;
    requires jakarta.ws.rs;
    requires org.json;
    
    opens com.sio.pizzeria to javafx.fxml;
    exports com.sio.pizzeria;
}

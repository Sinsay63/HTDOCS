module com.sio {
    requires javafx.controls;
    requires javafx.fxml;

    opens com.sio to javafx.fxml;
	opens com.sio.controllers to javafx.fxml;
	
    exports com.sio;
}

module com.sio.tabledecraft {
    requires javafx.controls;
    requires javafx.fxml;

    opens com.sio.tabledecraft to javafx.fxml;
    exports com.sio.tabledecraft;
}

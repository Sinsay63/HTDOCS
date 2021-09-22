module com.sio.craftingtable {
    requires javafx.controls;
    requires javafx.fxml;

    opens com.sio.craftingtable to javafx.fxml;
    exports com.sio.craftingtable;
}

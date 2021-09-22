module com.sio.seriestv {
    requires javafx.controls;
    requires javafx.fxml;
    requires java.sql;
    opens com.sio.seriestv to javafx.fxml;
    exports com.sio.seriestv;
}

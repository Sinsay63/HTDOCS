module com.sio.testfx {
    requires javafx.controls;
    requires javafx.fxml;

    opens com.sio.testfx to javafx.fxml;
    exports com.sio.testfx;
}

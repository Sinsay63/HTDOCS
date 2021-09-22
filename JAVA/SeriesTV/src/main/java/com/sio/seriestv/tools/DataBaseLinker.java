package com.sio.seriestv.tools;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class DataBaseLinker {

    private static String url = "jdbc:mysql://localhost:3306/serieacteur?useSSL=false&serverTimezone=UTC";

    private static String user = "root";
    private static String password = "root";

    private static Connection conn = null;

    public static Connection getConnexion() {
        if (conn == null) {
            try {
                conn = DriverManager.getConnection(url, user, password);
            }
            catch (SQLException e) {
                e.printStackTrace();
            }
        }

        return conn;
    }
}

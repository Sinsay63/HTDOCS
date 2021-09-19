package tools;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class DatabaseLinker 
{
	private static String url = "jdbc:mysql://localhost:3306/qcm_java?useSSL=false&serverTimezone=UTC";
	
	private static String user = "root";
	private static String password = "root";

	private static Connection conn = null;

	public static Connection getConnexion()
	{
		if (conn == null)
		{
			try 
			{
				conn = DriverManager.getConnection(url, user, password);
			}
			catch (SQLException e) 
			{
				e.printStackTrace();
			}
		}
		
		return conn;
	}	
}

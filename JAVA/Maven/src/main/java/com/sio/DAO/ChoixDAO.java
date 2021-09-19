package com.sio.DAO;

import com.sio.tools.DatabaseLinker;
import com.sio.DTO.ChoixDTO;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class ChoixDAO 
{
	public static void insertChoix(ChoixDTO choix)
	{			
		try 
		{
			Connection co = DatabaseLinker.getConnexion();
			
			PreparedStatement state = co.prepareStatement("INSERT INTO Choix (enonce, correct, idQuestion) VALUES(?, ?, ?)", Statement.RETURN_GENERATED_KEYS);
			state.setString(1, choix.getEnonce());
			state.setBoolean(2, choix.isCorrect());
			state.setInt(3, choix.getIdQuestion());
			state.executeUpdate();
			
			// met à jour l'id de l'objet avec l'id généré en BDD
			ResultSet keys = state.getGeneratedKeys();
			keys.next();
			choix.setIdChoix(keys.getInt(1));
		} 
		catch (SQLException e)
		{
			e.printStackTrace();
		}	
	}
	
	public static void updateChoix(ChoixDTO choix)
	{			
		try 
		{
			Connection co = DatabaseLinker.getConnexion();
			
			PreparedStatement state = co.prepareStatement("UPDATE Choix SET enonce=?, correct=?, idQuestion=? WHERE idChoix=?");
			state.setString(1, choix.getEnonce());
			state.setBoolean(2, choix.isCorrect());
			state.setInt(3, choix.getIdQuestion());
			state.setInt(4, choix.getIdChoix());
			state.executeUpdate();
		} 
		catch (SQLException e)
		{
			e.printStackTrace();
		}	
	}
	
	public static void deleteChoix(int idChoix)
	{			
		try 
		{
			Connection co = DatabaseLinker.getConnexion();
			
			PreparedStatement state = co.prepareStatement("DELETE FROM Choix WHERE idChoix=?");
			state.setInt(1, idChoix);
			state.executeUpdate();
		} 
		catch (SQLException e)
		{
			e.printStackTrace();
		}	
	}
	
	public static ChoixDTO getChoixById(int idChoix)
	{
		ChoixDTO choix = null;
				
		try 
		{
			Connection co = DatabaseLinker.getConnexion();
			
			PreparedStatement state = co.prepareStatement("SELECT * FROM Choix WHERE Choix.idChoix=?");
			state.setInt(1, idChoix); 
			
			ResultSet result = state.executeQuery();
			
			if(result.next())
			{
				choix = new ChoixDTO(idChoix, result.getString("enonce"), result.getBoolean("correct"), result.getInt("idQuestion"));
			}
		} 
		catch (SQLException e)
		{
			e.printStackTrace();
		}	
		
		return choix;
	}
}

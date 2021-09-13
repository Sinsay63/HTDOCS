package DAO;

import tools.DatabaseLinker;
import DTO.ChoixDTO;
import DTO.QuestionDTO;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;

public class QuestionDAO 
{
	public static void insertQuestion(QuestionDTO question)
	{			
		try 
		{
			Connection co = DatabaseLinker.getConnexion();
			
			PreparedStatement state = co.prepareStatement("INSERT INTO Question (enonce) VALUES(?)", Statement.RETURN_GENERATED_KEYS);
			state.setString(1, question.getEnonce());
			state.executeUpdate();
			
			// met à jour l'id de l'objet avec l'id généré en BDD
			ResultSet keys = state.getGeneratedKeys();
			keys.next();
			question.setIdQuestion(keys.getInt(1));
		} 
		catch (SQLException e)
		{
			e.printStackTrace();
		}	
	}
	
	public static void updateQuestion(QuestionDTO question)
	{			
		try 
		{
			Connection co = DatabaseLinker.getConnexion();
			
			PreparedStatement state = co.prepareStatement("UPDATE Question SET enonce=? WHERE idQuestion=?");
			state.setString(1, question.getEnonce());
			state.setInt(2, question.getIdQuestion());
			state.executeUpdate();
		} 
		catch (SQLException e)
		{
			e.printStackTrace();
		}	
	}
	
	public static void deleteQuestion(int idQuestion)
	{			
		try 
		{
			Connection co = DatabaseLinker.getConnexion();
			
			PreparedStatement state = co.prepareStatement("DELETE FROM Question WHERE idQuestion=?");
			state.setInt(1, idQuestion);
			state.executeUpdate();
		} 
		catch (SQLException e)
		{
			e.printStackTrace();
		}	
	}
	
	public static QuestionDTO getQuestionById(int idQuestion)
	{
		QuestionDTO quest = null;
				
		try 
		{
			Connection co = DatabaseLinker.getConnexion();
			
			PreparedStatement state = co.prepareStatement("SELECT * FROM Question WHERE Question.idQuestion=?");
			state.setInt(1, idQuestion); 
			
			ResultSet result = state.executeQuery();
			
			if(result.next())
			{
				quest = new QuestionDTO(idQuestion, result.getString("enonce"));
			}
		} 
		catch (SQLException e)
		{
			e.printStackTrace();
		}	
		
		return quest;
	}
	
	public static ArrayList<QuestionDTO> getQuestions()
	{
		ArrayList<QuestionDTO> listeQuestions = new ArrayList<QuestionDTO>();
				
		try 
		{
			Connection co = DatabaseLinker.getConnexion();
			
			PreparedStatement state = co.prepareStatement("SELECT * FROM Question ORDER BY idQuestion");
			
			ResultSet result = state.executeQuery();
			
			while (result.next())
			{
				QuestionDTO question = getQuestionById(result.getInt("idQuestion"));
				
				listeQuestions.add(question);
			}
		} 
		catch (SQLException e)
		{
			e.printStackTrace();
		}	
		
		return listeQuestions;
	}
	
	public static ArrayList<ChoixDTO> getListChoix(int idQuestion)
	{
		ArrayList<ChoixDTO> listeChoix = new ArrayList<>();
				
		try 
		{
			Connection co = DatabaseLinker.getConnexion();
			
			PreparedStatement state = co.prepareStatement("SELECT idChoix FROM Choix WHERE idQuestion=? ORDER BY idChoix");
			state.setInt(1, idQuestion); 
			
			ResultSet result = state.executeQuery();
			
			while (result.next())
			{
				ChoixDTO choix = ChoixDAO.getChoixById(result.getInt("idChoix"));
				
				listeChoix.add(choix);
			}
		} 
		catch (SQLException e)
		{
			e.printStackTrace();
		}	
		
		return listeChoix;
	}
	
	public static ChoixDTO getChoixByIndex(int idQuestion, int indexChoix)
	{
		 ArrayList<ChoixDTO> listeChoix = getListChoix(idQuestion);
		ChoixDTO choix = null;
		
		if (indexChoix >= 0 && indexChoix < listeChoix.size())
		{
			choix = listeChoix.get(indexChoix);
		}
		
		return choix;
	}
}

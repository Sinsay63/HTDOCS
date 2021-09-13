package com.sio.application;

import com.sio.DAO.ChoixDAO;
import com.sio.DAO.QuestionDAO;
import com.sio.DTO.ChoixDTO;
import com.sio.DTO.QuestionDTO;
import java.util.ArrayList;

public class FillDatabase 
{
	public static void main(String[] args)
	{
		ArrayList<QuestionDTO> listeQuestions = QuestionDAO.getQuestions();
		
		for (QuestionDTO quest : listeQuestions)
		{
			int idQuestion = quest.getIdQuestion();
			
			ArrayList<ChoixDTO> listeChoix = QuestionDAO.getListChoix(idQuestion);
			for (ChoixDTO choix : listeChoix)
			{
				ChoixDAO.deleteChoix(choix.getIdChoix());
			}
			
			QuestionDAO.deleteQuestion(quest.getIdQuestion());
		}
			
		QuestionDTO questionInsert1 = new QuestionDTO(-1, "Lequel de ces langages sert à faire des applications bureautiques ?");
		QuestionDAO.insertQuestion(questionInsert1);
		
		ChoixDTO choixInsert1 = new ChoixDTO(-1, "PHP", false, questionInsert1.getIdQuestion());
		ChoixDAO.insertChoix(choixInsert1);
		
		ChoixDTO choixInsert2 = new ChoixDTO(-1, "Klingon", false, questionInsert1.getIdQuestion());
		ChoixDAO.insertChoix(choixInsert2);
		
		ChoixDTO choixInsert3 = new ChoixDTO(-1, "Java", true, questionInsert1.getIdQuestion());
		ChoixDAO.insertChoix(choixInsert3);
		
		ChoixDTO choixInsert4 = new ChoixDTO(-1, "Français", false, questionInsert1.getIdQuestion());
		ChoixDAO.insertChoix(choixInsert4);
		
		
		QuestionDTO questionInsert2 = new QuestionDTO(-1, "Le Java est-il ?");
		QuestionDAO.insertQuestion(questionInsert2);
		
		ChoixDTO choixInsert5 = new ChoixDTO(-1, "Une île des caraïbes", false, questionInsert2.getIdQuestion());
		ChoixDAO.insertChoix(choixInsert5);
		
		ChoixDTO choixInsert6 = new ChoixDTO(-1, "Un langage de programmation", true, questionInsert2.getIdQuestion());
		ChoixDAO.insertChoix(choixInsert6);
		
		ChoixDTO choixInsert7 = new ChoixDTO(-1, "Une langue étrangère", false, questionInsert2.getIdQuestion());
		ChoixDAO.insertChoix(choixInsert7);
		
		ChoixDTO choixInsert8 = new ChoixDTO(-1, "Un Hutt dans Star Wars", false, questionInsert2.getIdQuestion());
		ChoixDAO.insertChoix(choixInsert8);
	}
}

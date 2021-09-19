package application;

import DTO.ChoixDTO;
import DTO.QuestionDTO;
import DAO.QuestionDAO;

import java.util.ArrayList;
import java.util.Scanner;

public class MainApplication 
{
	public static void main(String[] args)
	{	
		Scanner scan = new Scanner(System.in);
		int score = 0;
		
		// parcours des questions
		ArrayList<QuestionDTO> listQuestions = QuestionDAO.getQuestions();
		
		for (int cpt = 0 ; cpt < listQuestions.size(); cpt++)
		{
			QuestionDTO question = listQuestions.get(cpt);
					
			System.out.println("Question numéro " + (cpt+1) + " : " + question.getEnonce());
		
			ArrayList<ChoixDTO> listChoix = QuestionDAO.getListChoix(question.getIdQuestion());

			for (int cptChoix = 0 ; cptChoix < listChoix.size(); cptChoix++)
			{
				ChoixDTO choix = listChoix.get(cptChoix);
				System.out.println( (cptChoix+1) + ". " + choix.getEnonce());
			}

			System.out.print("Tapez un chiffre de 1 à 4 pour choisir une réponse : ");
			int numeroChoixUser = scan.nextInt();
			ChoixDTO selectedChoix = QuestionDAO.getChoixByIndex(question.getIdQuestion(), numeroChoixUser - 1);
			
			while(selectedChoix == null)
			{
				System.out.print("Tapez un chiffre de 1 à 4 pour choisir une réponse : ");
				numeroChoixUser = scan.nextInt();
				selectedChoix = QuestionDAO.getChoixByIndex(question.getIdQuestion(), numeroChoixUser - 1);
			}	
			System.out.println();
			
			if (selectedChoix.isCorrect())
			{
				score++;
			}
		}

		System.out.println("Le QCM est terminé, votre score est de " + score + " point(s)");
	}	
}

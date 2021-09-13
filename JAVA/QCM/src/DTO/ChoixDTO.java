package DTO;

public class ChoixDTO
{
	private int idChoix;
	private String enonce;
	private boolean correct;
	private int idQuestion;
	
	public int getIdChoix() {
		return idChoix;
	}

	public void setIdChoix(int idChoix) {
		this.idChoix = idChoix;
	}

	public String getEnonce() {
		return enonce;
	}

	public void setEnonce(String enonce) {
		this.enonce = enonce;
	}

	public boolean isCorrect() {
		return correct;
	}

	public void setCorrect(boolean correct) {
		this.correct = correct;
	}

	public int getIdQuestion() {
		return idQuestion;
	}

	public void setIdQuestion(int idQuestion) {
		this.idQuestion = idQuestion;
	}

	public ChoixDTO(int idChoix, String enonce, boolean correct, int idQuestion) {
		this.idChoix = idChoix;
		this.enonce = enonce;
		this.correct = correct;
		this.idQuestion = idQuestion;
	}
}

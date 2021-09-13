package DTO;


public class QuestionDTO
{
	private int idQuestion;
	private String enonce;

	public int getIdQuestion() {
		return idQuestion;
	}

	public void setIdQuestion(int idQuestion) {
		this.idQuestion = idQuestion;
	}

	public String getEnonce() {
		return enonce;
	}

	public void setEnonce(String enonce) {
		this.enonce = enonce;
	}

	public QuestionDTO(int idQuestion, String enonce) {
		this.idQuestion = idQuestion;
		this.enonce = enonce;
	}
}

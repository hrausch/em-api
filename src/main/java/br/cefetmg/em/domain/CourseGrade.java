package br.cefetmg.em.domain;

import java.io.Serializable;
import java.util.ArrayList;

public class CourseGrade implements Serializable {
	
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	private Student aluno;
	private Bimestre bimestre;
	
	private ArrayList<Rendimento> rendimentos = new ArrayList<Rendimento>();
	
	private long idFatosNotas;
	private int alertaSinal;
	private float notaAluno; //nota acumulada
	private int faltaAluno;
	private int ano;
	private float notaMediaSala;
	private float desvioMediaSala;
	private Course course;
	
	
	
	public int getAlertaSinal() {
		return alertaSinal;
	}
	
	public void setAlertaSinal() {
		
		this.alertaSinal = 1;
	}

	
	public Course getCourse() {
		return course;
	}

	public void setCourse(Course course) {
		this.course = course;
	}

	public void setAlertaSinal(int alertaSinal) {
		this.alertaSinal = alertaSinal;
	}

	public void addRendimento(int nota, int falta, Bimestre bim){
		Rendimento r = new Rendimento(nota, falta, bim);
		rendimentos.add(r);
	}
	
	public int getRendimentoNotaBimestre(int bimestre){
		return rendimentos.get(bimestre).getNota();
	}
	
	public int getRendimentoFaltaBimestre(int bimestre){
		return rendimentos.get(bimestre).getFalta();
	}
	
	
	
	public ArrayList<Rendimento> getRendimentos() {
		return rendimentos;
	}

	public void setRendimentos(ArrayList<Rendimento> rendimento) {
		this.rendimentos = rendimento;
	}

	public int getAno() {
		return ano;
	}

	public void setAno(int ano) {
		this.ano = ano;
	}

	public long getIdFatosNotas() {
		return idFatosNotas;
	}

	public void setIdFatosNotas(long idFatosNotas) {
		this.idFatosNotas = idFatosNotas;
	}

	public Student getAluno() {
		return aluno;
	}

	public void setAluno(Student aluno) {
		this.aluno = aluno;
	}

	public float getDesvioMediaSala() {
		return desvioMediaSala;
	}
	public void setDesvioMediaSala(float desvioMediaSala) {
		this.desvioMediaSala = desvioMediaSala;
	}
	public Bimestre getBimestre() {
		return bimestre;
	}
	public void setBimestre(Bimestre bimestre) {
		this.bimestre = bimestre;
	}
//	public Disciplina getDisciplina() {
//		return disciplina;
//	}
//	public void setDisciplina(Disciplina disciplina) {
//		this.disciplina = disciplina;
//	}
	public float getNotaAluno() {
		return notaAluno;
	}
	public void setNotaAluno(float notaAluno) {
		this.notaAluno = notaAluno;
	}
	public int getFaltaAluno() {
		return faltaAluno;
	}
	public void setFaltaAluno(int faltaAluno) {
		this.faltaAluno = faltaAluno;
	}
	public float getNotaMediaSala() {
		return notaMediaSala;
	}
	public void setNotaMediaSala(float notaMediaSala) {
		this.notaMediaSala = notaMediaSala;
	}

}

class Rendimento implements Serializable {
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	private int nota;
	private int falta;
	private Bimestre bim;
	
	public Rendimento(){
			
	}
	
	public Rendimento(int nota, int falta, Bimestre bim){
		this.nota = nota;
		this.falta = falta;
		this.bim = bim;		
		
	}
	
	public int getNota() {
		return nota;
	}
	public void setNota(int nota) {
		this.nota = nota;
	}
	public int getFalta() {
		return falta;
	}
	public void setFalta(int falta) {
		this.falta = falta;
	}
	public Bimestre getBim() {
		return bim;
	}
	public void setBim(Bimestre bim) {
		this.bim = bim;
	}
	
}



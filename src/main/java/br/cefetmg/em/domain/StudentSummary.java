package br.cefetmg.em.domain;

import java.io.Serializable;

import br.cefetmg.em.util.GeralUtil;


/**
 * The persistent class for the disciplina database table.
 * 
 */

public class StudentSummary implements Serializable {
	private static final long serialVersionUID = 1L;

	/**
	 * 
	 */
	private static final long serialVersionUID1 = 1L;
	

	private Student student;
	
	/**
	 * 0 - abaixo da media
	 * 1 - na media ou acima somente com 1 ponto
	 * 2 - acima da media mais de 1 ponto
	 */
	private int alertaSinal;
	private int numeroMediasPerdida;
	private float menorNotaBimestre;
	private float mediaNotaBimestre;
	private float desvioNotaBimestre;
	private int numeroComentarios;
	
	
	
	
	
	public Student getStudent() {
		return student;
	}
	public void setStudent(Student aluno) {
		this.student = aluno;
	}
	public int getNumeroComentarios() {
		return numeroComentarios;
	}
	public void setNumeroComentarios(int numeroComentarios) {
		this.numeroComentarios = numeroComentarios;
	}
	public int getNumeroMediasPerdida() {
		return numeroMediasPerdida;
	}
	public void setNumeroMediasPerdida(int numeroMediasPerdida) {
		this.numeroMediasPerdida = numeroMediasPerdida;
	}
	public int getAlertaSinal() {
		return alertaSinal;
	}
	
	public void setAlertaSinal(boolean sumario, int bimestre) {
		
		this.alertaSinal = GeralUtil.verificarSinalAlerta(this.menorNotaBimestre, this.numeroMediasPerdida, bimestre);
			
	}
	
	
	public float getMenorNotaBimestre() {
		return menorNotaBimestre;
	}
	public void setMenorNotaBimestre(float menorNotaBimestre) {
		this.menorNotaBimestre = menorNotaBimestre;
	}
	public float getMediaNotaBimestre() {
		return mediaNotaBimestre;
	}
	public void setMediaNotaBimestre(float mediaNotaBimestre) {
		this.mediaNotaBimestre = mediaNotaBimestre;
	}
	public float getDesvioNotaBimestre() {
		return desvioNotaBimestre;
	}
	public void setDesvioNotaBimestre(float desvioNotaBimestre) {
		this.desvioNotaBimestre = desvioNotaBimestre;
	}

}
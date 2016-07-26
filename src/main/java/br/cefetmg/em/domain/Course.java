package br.cefetmg.em.domain;

import java.io.Serializable;
import javax.persistence.*;


/**
 * The persistent class for the disciplina database table.
 * 
 */

public class Course implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	@Column(name="id_disciplina")
	private int idDisciplina;

	private String departamento;

	private String disciplina;

	@Column(name="nome_disciplina")
	private String nomeDisciplina;

	public Course() {
	}

	public int getIdDisciplina() {
		return this.idDisciplina;
	}

	public void setIdDisciplina(int idDisciplina) {
		this.idDisciplina = idDisciplina;
	}

	public String getDepartamento() {
		return this.departamento;
	}

	public void setDepartamento(String departamento) {
		this.departamento = departamento;
	}

	public String getDisciplina() {
		return this.disciplina;
	}

	public void setDisciplina(String disciplina) {
		this.disciplina = disciplina;
	}

	public String getNomeDisciplina() {
		return this.nomeDisciplina;
	}

	public void setNomeDisciplina(String nomeDisciplina) {
		this.nomeDisciplina = nomeDisciplina;
	}

}
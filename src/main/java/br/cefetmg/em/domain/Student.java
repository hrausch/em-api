package br.cefetmg.em.domain;

import java.io.Serializable;

import javax.persistence.Column;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.NamedQuery;


/**
 * The persistent class for the aluno database table.
 * 
 */
//@NamedQuery(name="Aluno.findAll", query="SELECT a FROM Aluno a")
public class Student implements Serializable {
	private static final long serialVersionUID = 1L;

//	@Id
//	@GeneratedValue(strategy=GenerationType.IDENTITY)
//	@Column(name="id_aluno")
	private int idAluno;

	private String foto;

//	@ManyToOne
//	@JoinColumn(name="id_turma")
//	private Turma turma;

	private String matricula;

	private String nome;

//	//uni-directional many-to-one association to Turma
//	@ManyToOne
//	@JoinColumn(name="id_curso")
//	private Curso curso;

	public Student() {
	}

	public int getIdAluno() {
		return this.idAluno;
	}

	public void setIdAluno(int idAluno) {
		this.idAluno = idAluno;
	}

	public String getFoto() {
		return this.foto;
	}

	public void setFoto(String foto) {
		this.foto = foto;
	}
//
//	public Curso getCurso() {
//		return this.curso;
//	}
//
//	public void setCurso(Curso curso) {
//		this.curso = curso;
//	}

	public String getMatricula() {
		return this.matricula;
	}

	public void setMatricula(String matricula) {
		this.matricula = matricula;
	}

	public String getNome() {
		return this.nome;
	}

	public void setNome(String nome) {
		this.nome = nome;
	}

//	public Turma getTurma() {
//		return this.turma;
//	}
//
//	public void setTurma(Turma turma) {
//		this.turma = turma;
//	}

}
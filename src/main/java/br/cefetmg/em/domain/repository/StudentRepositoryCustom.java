package br.cefetmg.em.domain.repository;

import java.util.List;

import org.springframework.stereotype.Repository;

import br.cefetmg.em.domain.StudentSummary;

@Repository
public interface StudentRepositoryCustom {
	
	
	public List<StudentSummary> findStudentSummary(long idCurso, long idTurma, int bimestre, int ano);
		

}

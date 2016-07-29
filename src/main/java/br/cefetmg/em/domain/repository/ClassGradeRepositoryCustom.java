package br.cefetmg.em.domain.repository;

import java.util.ArrayList;
import java.util.List;

import org.springframework.stereotype.Repository;

import br.cefetmg.em.domain.Bimestre;
import br.cefetmg.em.domain.ClassGrade;

@Repository
public interface ClassGradeRepositoryCustom {
	
	
	public List<ClassGrade> findClassGrades(long idCurso, long idTurma, int ano);
		
	public int findLostGradesByClass(long idDisciplina, long idTurma, int ano, long idCurso, ArrayList<Bimestre> bimestres, int limiteMedia);

}

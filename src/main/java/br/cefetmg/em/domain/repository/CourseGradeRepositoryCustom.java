package br.cefetmg.em.domain.repository;

import java.util.List;

import org.springframework.stereotype.Repository;

import br.cefetmg.em.domain.CourseGrade;

@Repository
public interface CourseGradeRepositoryCustom {
	
	
	public List<CourseGrade> findCoursesGrades(long idCurso, long idTurma, int ano);

}

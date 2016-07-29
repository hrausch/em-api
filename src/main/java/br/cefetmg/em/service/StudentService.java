package br.cefetmg.em.service;

import java.util.ArrayList;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import br.cefetmg.em.domain.StudentSummary;
import br.cefetmg.em.domain.repository.StudentRepositoryCustom;

@Service
public class StudentService {
	
	
	
	@Autowired
	private StudentRepositoryCustom repo;
	
	
	public ArrayList<StudentSummary> findStudentSummary(long idCurso, long idTurma, int bimestre, int ano){
		
		return (ArrayList<StudentSummary>) repo.findStudentSummary(idCurso, idTurma, bimestre, ano);
		
	}
	
	
	


}

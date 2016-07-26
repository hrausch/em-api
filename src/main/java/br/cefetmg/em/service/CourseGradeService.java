package br.cefetmg.em.service;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import br.cefetmg.em.domain.Course;
import br.cefetmg.em.domain.CourseGrade;
import br.cefetmg.em.domain.repository.CourseGradeRepositoryCustom;

@Service
public class CourseGradeService {
	
	
	
	@Autowired
	private CourseGradeRepositoryCustom courseGradeRepo;
	
	public List<CourseGrade> findCoursesGrades(long idCurso, long idTurma, int ano){
		
		return courseGradeRepo.findCoursesGrades(idCurso, idTurma, ano);
		
	}
	
	
	
	public ArrayList<Map<String,String>> findNumberLostGradesPerCourse(long idCurso, long idTurma, int ano){
		
	
		//get the grades of each course
		List<CourseGrade> averagesGradesByCourse = this.findCoursesGrades(idCurso, idTurma, ano);
		
		ArrayList<Map<String,String>> mapLostAverages = new ArrayList<Map<String,String>>();
		
		int lostAverages;
//		BimestreUtil bu = new BimestreUtil();
//		
////		ArrayList<Bimestre> arrBimestresAtual = bu.getBimestresAteAtual(3);
////		int mediaTotal = bu.getMediaNotaDistribuido(3);

		Course aux = new Course();
		
		//for each course, calculate the number of lost grades
		for(CourseGrade cg: averagesGradesByCourse){
			
			Course c = cg.getCourse();
			
			//this if doesn't allow to get duplicate course
			if(c.getIdDisciplina() != aux.getIdDisciplina()){
				
				aux.setIdDisciplina(c.getIdDisciplina());
				
				//Calculate the number and add it in a map.
				Map<String, String> map = new HashMap<String,String>();
				
				lostAverages = 12; //DisciplinaDao.getMediasPerdidasDisciplina(d.getIdDisciplina(), turma, ano, curso, arrBimestresAtual , mediaTotal);
				map.put("category", c.getDisciplina());
				map.put("categoryTitle", c.getNomeDisciplina());
				map.put("lostAverages",String.valueOf(lostAverages));
				
				mapLostAverages.add(map);
				
			}
		}
		
		return mapLostAverages;
	}
	


}

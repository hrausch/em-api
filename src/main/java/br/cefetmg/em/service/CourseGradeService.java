package br.cefetmg.em.service;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import br.cefetmg.em.domain.Bimestre;
import br.cefetmg.em.domain.ClassGrade;
import br.cefetmg.em.domain.Classs;
import br.cefetmg.em.domain.repository.ClassGradeRepositoryCustom;
import br.cefetmg.em.util.BimestreUtil;

@Service
public class CourseGradeService {
	
	
	
	@Autowired
	private ClassGradeRepositoryCustom classGradeRepo;
	
	@Autowired
	private BimestreUtil bu;
	
	public ArrayList<Map<String,String>> findClassAveragesGrades(long idCurso, long idTurma, int ano){
		
		ArrayList<ClassGrade> averagesGradesByCourse = (ArrayList<ClassGrade>) classGradeRepo.findClassGrades(idCurso, idTurma, ano);
		
		ArrayList<Map<String,String>> mapCoursesByBim = this.notaDisciplinaApater(averagesGradesByCourse);
		
		return mapCoursesByBim;
		
	}
	
	
	
	public ArrayList<Map<String,String>> findNumberLostGradesPerClass(long idCurso, long idTurma, int bimestre, int ano){
		
	
		//TODO Change to look distinct courses from a class.
		//get the grades of each course
		List<ClassGrade> averagesGradesByCourse = classGradeRepo.findClassGrades(idCurso, idTurma, ano);
		
		ArrayList<Map<String,String>> mapLostAverages = new ArrayList<Map<String,String>>();
		
		ArrayList<Bimestre> bimestres = BimestreUtil.getBimestres();
		int limiteMedia = bu.getMediaNotaDistribuido(bimestre);
		
		int lostAverages;

		Classs aux = new Classs();
		
		//for each course, calculate the number of lost grades
		for(ClassGrade cg: averagesGradesByCourse){
			
			Classs c = cg.getClasss();
			
			//this if doesn't allow to get duplicate course
			if(c.getIdDisciplina() != aux.getIdDisciplina()){
				
				aux.setIdDisciplina(c.getIdDisciplina());
				
				//Calculate the number and add it in a map.
				Map<String, String> map = new HashMap<String,String>();
				
				lostAverages = classGradeRepo.findLostGradesByClass(c.getIdDisciplina(), idTurma, ano, idCurso, bimestres, limiteMedia);
				map.put("category", c.getDisciplina());
				map.put("categoryTitle", c.getNomeDisciplina());
				map.put("lostAverages",String.valueOf(lostAverages));
				
				mapLostAverages.add(map);
				
			}
		}
		
		return mapLostAverages;
	}





	private ArrayList<Map<String, String>> notaDisciplinaApater(ArrayList<ClassGrade> listNd){
		
		ArrayList<Map<String, String>> resultado = new ArrayList<Map<String,String>>();
		
		int tam = listNd.size();
		
		for(int i =0; i < tam; i++){
			ClassGrade nd = listNd.get(i);
			
			Classs d = nd.getClasss();
			
			i = mergeElements(listNd, i, resultado, d) - 1;
			
		}
		
		return resultado;
		
	}
	
	private int mergeElements(ArrayList<ClassGrade> listNd, int indice, ArrayList<Map<String, String>> resultado, Classs disciplina){
		
		HashMap<String, String> map = new HashMap<String, String>();
		map.put("category", disciplina.getDisciplina());
		map.put("categoryTitle", disciplina.getNomeDisciplina());
		
		int tam = listNd.size();
		int i = 0;
		for(i = indice; i < tam; i++){
			
			ClassGrade nd = listNd.get(i);
			Classs d = nd.getClasss();
			
			if(d.getDisciplina().equals(disciplina.getDisciplina())){
				
				float notaMedia =  nd.getNotaMediaSala()/nd.getBimestre().getTotal()*100;
				map.put(nd.getBimestre().getTexto(), String.valueOf(notaMedia));
				
			}
			else{
				resultado.add(map);
				return i;
			}
			
		}
		return i;
		
	}
	


}

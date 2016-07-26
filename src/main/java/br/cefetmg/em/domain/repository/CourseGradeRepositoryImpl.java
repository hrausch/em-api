package br.cefetmg.em.domain.repository;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.jdbc.core.RowMapper;
import org.springframework.stereotype.Component;

import br.cefetmg.em.domain.Bimestre;
import br.cefetmg.em.domain.Course;
import br.cefetmg.em.domain.CourseGrade;
import br.cefetmg.em.util.BimestreUtil;

@Component
public class CourseGradeRepositoryImpl implements CourseGradeRepositoryCustom {
	
	@Autowired
    JdbcTemplate jdbcTemplate;
	
	public List<CourseGrade> findCoursesGrades(long idCurso, long idTurma, int ano){
		
		
		String sql = "SELECT"
				+ ""
				+ " DISTINCT(fn.id_disciplina),d.disciplina, d.nome_disciplina, fn.bimestre,"
				+ "	AVG(fn.nota) AS nota,"
				+ "	STDDEV(fn.nota) AS desvio"
				+ "	FROM fato_notas fn"
				+ ""
				+ "	JOIN disciplina d ON d.id_disciplina = fn.id_disciplina"
				+ ""
				+ "	WHERE 	fn.id_turma= ? AND fn.id_curso= ? and fn.ano = ? "
				+ " GROUP BY fn.id_disciplina, fn.bimestre, d.nome_disciplina" ;

		List<CourseGrade> list = this.jdbcTemplate.query(
				sql, new Object[]{idTurma, idCurso, ano},
		        
				new RowMapper<CourseGrade>() {
		            
					@Override
					public CourseGrade mapRow(ResultSet rs, int rowNum) throws SQLException {
						
						CourseGrade obj = new CourseGrade();
						Course course = new Course();
						
						Bimestre bimestre = BimestreUtil.getBimestres().get(rs.getInt("bimestre"));
						
						obj.setNotaMediaSala(rs.getFloat("nota"));
						obj.setDesvioMediaSala(rs.getFloat("desvio"));
						
						course.setDisciplina(rs.getString("disciplina"));
						course.setNomeDisciplina(rs.getString("nome_disciplina"));
						course.setIdDisciplina(rs.getInt("id_disciplina"));
						
						obj.setCourse(course);
						obj.setBimestre(bimestre);
						obj.setAlertaSinal();
						
		                return obj;
		            }

		        });
		
		return list;
	}

}

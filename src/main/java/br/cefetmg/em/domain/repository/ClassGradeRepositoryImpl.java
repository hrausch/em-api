package br.cefetmg.em.domain.repository;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.jdbc.core.RowMapper;
import org.springframework.stereotype.Component;

import br.cefetmg.em.domain.Bimestre;
import br.cefetmg.em.domain.Classs;
import br.cefetmg.em.domain.ClassGrade;
import br.cefetmg.em.util.BimestreUtil;

@Component
public class ClassGradeRepositoryImpl implements ClassGradeRepositoryCustom {
	
	@Autowired
    JdbcTemplate jdbcTemplate;
	
	public List<ClassGrade> findClassGrades(long idCurso, long idTurma, int ano){
		
		
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

		List<ClassGrade> list = this.jdbcTemplate.query(
				sql, new Object[]{idTurma, idCurso, ano},
		        
				new RowMapper<ClassGrade>() {
		            
					@Override
					public ClassGrade mapRow(ResultSet rs, int rowNum) throws SQLException {
						
						ClassGrade obj = new ClassGrade();
						Classs classs = new Classs();
						
						Bimestre bimestre = BimestreUtil.getBimestres().get(rs.getInt("bimestre"));
						
						obj.setNotaMediaSala(rs.getFloat("nota"));
						obj.setDesvioMediaSala(rs.getFloat("desvio"));
						
						classs.setDisciplina(rs.getString("disciplina"));
						classs.setNomeDisciplina(rs.getString("nome_disciplina"));
						classs.setIdDisciplina(rs.getInt("id_disciplina"));
						
						obj.setClasss(classs);
						obj.setBimestre(bimestre);
						obj.setAlertaSinal();
						
		                return obj;
		            }

		        });
		
		return list;
	}

	
	public int findLostGradesByClass(long idDisciplina, long idTurma, int ano, long idCurso, ArrayList<Bimestre> bimestres, int limiteMedia){
		
		int medias = 0;
			
			String strBimestres = "(";
			int numBim = bimestres.size();
			
			for(int i = 0; i < numBim; i++){
				Bimestre b = bimestres.get(i);
				
				if(i != 0)
					strBimestres += " , ";
				
				strBimestres += " "+ b.getIdBimestre() +" ";
			}
				
			strBimestres += " ) ";
			
			String sql = "SELECT COUNT(cont) as medias_perdidas from ("+
					" SELECT count( distinct(id_aluno) ) as cont FROM fato_notas fn2 " + 
						" WHERE fn2.bimestre IN "+strBimestres+" AND fn2.id_curso=? AND fn2.id_turma=? AND fn2.ano=? AND fn2.id_disciplina=? group by id_aluno"+
							" having sum(nota) < ? "+
							") as temp";
			
			medias = this.jdbcTemplate.queryForObject(
					sql,  Integer.class, new Object[]{idCurso, idTurma, ano, idDisciplina, limiteMedia} );
			

		
		return medias;
		
	}
}

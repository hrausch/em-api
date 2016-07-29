package br.cefetmg.em.domain.repository;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.jdbc.core.RowMapper;
import org.springframework.stereotype.Component;

import br.cefetmg.em.domain.Bimestre;
import br.cefetmg.em.domain.Student;
import br.cefetmg.em.domain.StudentSummary;
import br.cefetmg.em.util.BimestreUtil;

@Component
public class StudentRepositoryImpl implements StudentRepositoryCustom {
	
	@Autowired
    JdbcTemplate jdbcTemplate;
	
	
	public List<StudentSummary> findStudentSummary(long idCurso, long idTurma, int bimestre, int ano){
		
		Bimestre bimestreSelecionado = BimestreUtil.getBimestres().get(bimestre);
		
		String sql = "select MIN(fn.nota) AS menor_nota, AVG(fn.nota) AS media_nota, stddev(fn.nota) AS desvio_padrao,"
						+ " a.id_aluno, a.nome, a.matricula, a.foto, "
						+ "(SELECT COUNT(id_disciplina) FROM fato_notas fn2 WHERE fn2.bimestre=fn.bimestre AND fn2.id_curso=fn.id_curso"
						+ " AND fn2.id_turma=fn.id_turma AND fn2.ano=fn.ano AND fn2.id_aluno=a.id_aluno AND nota < ? ) AS medias_perdidas"
						+ " from aluno a "
						+ " JOIN fato_notas fn ON fn.id_aluno = a.id_aluno "
						+ " WHERE fn.bimestre=? AND fn.id_curso=? AND fn.id_turma=? AND fn.ano=? "
						+ " GROUP BY a.id_aluno, a.nome, a.matricula, a.foto ORDER BY medias_perdidas DESC, a.nome ASC ";
		
		List<StudentSummary> list = this.jdbcTemplate.query(
				sql, new Object[]{bimestreSelecionado.getMedia(), bimestreSelecionado.getIdBimestre(),idCurso, idTurma, ano},
		        
				new RowMapper<StudentSummary>() {
		            
					@Override
					public StudentSummary mapRow(ResultSet rs, int rowNum) throws SQLException {
						
						StudentSummary obj = new StudentSummary();
						Student s = new Student();
						
						s.setIdAluno(rs.getInt("id_aluno"));
						s.setNome(rs.getString("nome"));
						s.setMatricula(rs.getString("matricula"));
						s.setFoto(rs.getString("foto"));
						
						obj.setStudent(s);
						
						obj.setMenorNotaBimestre(Float.parseFloat(rs
								.getString("menor_nota")));
						obj.setMediaNotaBimestre(Float.parseFloat(rs
								.getString("media_nota")));
						obj.setDesvioNotaBimestre(Float.parseFloat(rs
								.getString("desvio_padrao")));
						obj.setNumeroMediasPerdida(rs.getInt("medias_perdidas"));
						
						obj.setAlertaSinal(true, bimestre);
						
		                return obj;
		            }

		        });
		
		return list;
		
		 
	}
		
		
	
}

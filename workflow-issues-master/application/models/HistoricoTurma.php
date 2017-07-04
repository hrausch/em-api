<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HistoricoTurma extends CI_Model {
	public function pegaSegChamada($info) {
		$resultado = $this->db->query('SELECT * FROM segunda_chamada AS s JOIN aluno AS a ON s.id_aluno=a.id_aluno  WHERE a.id_turma ="' .$info.'"')->result_array();

			return $resultado;
	}

    public function pegaDisciplinas() {
        $resultado = $this->db->query('SELECT * FROM disciplina')->result_array();
        return $resultado;
    }

		public function pegaAdvertencias($id_turma) {
			$resultado = $this->db->query('SELECT * FROM advertencia JOIN aluno WHERE aluno.id_turma = '.$id_turma.' AND aluno.id_aluno = advertencia.id_aluno')->result_array();
			return $resultado;
		}
		
	public function pegaTipos() {
		 $resultado = $this->db->query('SELECT * FROM tipo_itens')->result_array();
		 return $resultado;
	}
	
	public function pegaRelacao($id_adv){
		$resultado = $this->db->query('SELECT * FROM itens_advertencia WHERE id_advertencia = '.$id_adv)->result_array();
		return $resultado;
	}
		public function pegaChamadas() {
			$resultado = $this->db->query('SELECT * FROM segunda_chamada')->result_array();
			return $resultado;
		}
		public function pegaTodasTurmas() {
			$resultado = $this->db->query('SELECT * FROM turma')->result_array();
			return $resultado;
		}
		public function pegaAlunoTurma($id_aluno) {
			$resultado = $this->db->query('SELECT * FROM aluno WHERE id_aluno = '.$id_aluno)->result_array();
			return $resultado;
		}
		public function pegaTodasAdvertencias() {
			$resultado = $this->db->query('SELECT * FROM advertencia')->result_array();
			return $resultado;
		}
		
		public function pegaDisciplinasLecionada($id_turma) {
			$resultado = $this->db->query('SELECT DISTINCT id_disciplina FROM fato_notas WHERE id_turma = '.$id_turma)->result_array();		
			return $resultado;		
		}
		
		public function pegaMedia($id_turma, $bimestre, $ano, $id_disciplina) {
			$resultado = $this->db->query('SELECT AVG(nota) FROM fato_notas WHERE id_disciplina = '.$id_disciplina.' AND id_turma = '.$id_turma.' AND bimestre = '.$bimestre.' AND ano = '.$ano)->result_array();
			return $resultado;		
		}
		
		public function pegaNomeDisciplina($id_disciplina) {
			$resultado = $this->db->query('SELECT * FROM disciplina WHERE id_disciplina = '.$id_disciplina)->result_array();
			return $resultado;
		}
}

?>

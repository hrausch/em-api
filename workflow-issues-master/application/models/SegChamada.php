<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SegChamada extends CI_Model {

    public function insertSegundaChamada($dados = NULL) {
        if ($this->db->insert("segunda_chamada", $dados)) {
            return true;
        } else {
            return false;
        }
    }
    public function getPedidoPorId($id) {
        $resultado = $this->db->query('SELECT * FROM segunda_chamada WHERE id_segunda_chamada=' . $id)->result_array();
        return $resultado;
    }
    public function pegaTurmas($id_curso) {
       $resultado = $this->db->query("SELECT id_turma, turma FROM turma WHERE id_curso =".$id_curso)->result_array();
       return $resultado;
    }
    public function pegaAluno($info) {
       $resultado = $this->db->query("SELECT * FROM aluno WHERE matricula =".$info)->result();
       return $resultado;
    }
    public function pegaDisciplina($id) {
      $resultado = $this->db->query("SELECT DISTINCT(fn.id_disciplina), d.nome_disciplina FROM fato_notas fn JOIN disciplina d ON d.id_disciplina = fn.id_disciplina WHERE fn.id_turma =". $id )->result_array();

      return $resultado;
    }
    public function disciplina_segchamada($id) {
       return $this->db->query("SELECT d.nome_disciplina, d.id_disciplina FROM disciplina AS d JOIN segunda_chamada AS s ON d.id_disciplina=".$id)->result_array();
    }

    public function aluno_segchamada($info) {
      $resultado = $this->db->query("SELECT * FROM aluno WHERE id_aluno =".$info)->result_array();
      return $resultado;
    }


    public function pegaTipoUsuario($id) {
       return $this->db->query("SELECT id_tipo_usuario FROM relacao_tipo_usuario AS r WHERE r.id_usuario =".$id)->result_array();
    }
    public function pegaPedidos() {
      return $this->db->get('segunda_chamada')->result_array();
    }
    public function pegaPedidosPorIdAluno($id) {
      $resultado = $this->db->query("SELECT * FROM segunda_chamada WHERE id_aluno =".$id)->result_array();
      return $resultado;
    }
    public function mudaStatus($status, $id) {
      $this->db->query("UPDATE segunda_chamada SET situacao='".$status."' WHERE id_segunda_chamada=".$id);
    }



}

?>

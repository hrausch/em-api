<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno extends CI_Model {

    public function get($id = NULL) {
        if ($id !== NULL) {
            $this->db->where("id_aluno", $id);
        }
        $resultado = $this->db->get("aluno");
        return $resultado->result_array();
    }

    public function get_turma($id = NULL) {
        if ($id !== NULL) {
            $this->db->where("id_turma", $id);
        }
        $resultado = $this->db->get("turma");
        return $resultado->result_array();
    }

    public function get_curso($id = NULL) {
        if ($id !== NULL) {
            $this->db->where("id_curso", $id);
        }
        $resultado = $this->db->get("curso");
        return $resultado->result_array();
    }

    public function getAlunosByTurmaAndCurso($dados = NULL) {
        if ($dados !== NULL) {
            $sql = "SELECT id_aluno,nome FROM aluno WHERE id_curso = ? AND id_turma = ? ";
            $resultado = $this->db->query($sql, $dados);
            return $resultado->result_array();
        }
    }

}

?>
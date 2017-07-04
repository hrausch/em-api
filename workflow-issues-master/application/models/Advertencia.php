<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Advertencia extends CI_Model {

    public function get($id = NULL) {
        if ($id !== NULL) {
            $this->db->where("id", $id);
        }
        $resultado = $this->db->get("advertencia");
        return $resultado->result_array();
    }


    public function getByUsuario($id) {
    	  $coor = $this->getTipoUsuario($id);

        if ($id !== NULL && ($coor != "2")&&($coor != "3")&&($coor != "1") ) {
           $this->db->where("id_professor", $id);
        }
        $resultado = $this->db->get("advertencia");
        return $resultado->result_array();
    }


	public function getTipoUsuario($id) {
		 $resultado = $this->db->query("SELECT * FROM relacao_tipo_usuario AS r JOIN usuario AS u ON r.id_usuario =".$id)->result_array();
     return $resultado[0]['id_tipo_usuario'];
	}

  public function pegaTipoUsuario($id) {
     return $this->db->query("SELECT id_tipo_usuario FROM relacao_tipo_usuario AS r WHERE r.id_usuario =".$id)->result();
  }


    public function getByAdvertencia($id = NULL) {
        if ($id !== NULL) {
            $this->db->where("id", $id);
        }
        $resultado = $this->db->get("advertencia");
        return $resultado->result_array();
    }

    public function getByAluno($id = NULL) {
        if ($id !== NULL) {
            $this->db->where("id_aluno", $id);
        }
        $resultado = $this->db->get("advertencia");
        return $resultado->result_array();
    }

    public function insert($dados) {
      if($this->db->insert('advertencia', $dados) == false){
        return false;
      }

      return true;

    }

    public function insertComentario($dados = NULL) {
        if ($this->db->insert("comentario_advertencia", $dados)) {
            return true;
        } else {
            return false;
        }
    }

     public function getComentario($id) {
        $this->db->where("id_advertencia", $id);
        $resultado = $this->db->get("comentario_advertencia");
        return $resultado->result_array();
    }

    public function updateAdvertencia($dados, $id) {
        $this->db->where('id', $id);
        if ($this->db->update('advertencia', $dados)) {
            return true;
        } else {
            return false;
        }
    }
    public function pegaTurmas($id_curso) {
       $resultado = $this->db->query("SELECT id_turma, turma FROM turma WHERE id_curso =".$id_curso)->result_array();
       return $resultado;
    }

    public function pegaAlunos($id_turma) {
      $resultado = $this->db->query("SELECT id_aluno, nome FROM aluno WHERE id_turma =".$id_turma)->result_array();
      return $resultado;
    }
    public function pegaProfessor() {
      return $resultado = $this->db->query("SELECT * FROM usuario AS u JOIN relacao_tipo_usuario AS r ON u.id_usuario = r.id_usuario AND r.id_tipo_usuario=5")->result_array();
    }

    public function mudaStatus($status, $id) {
    	$this->db->query("UPDATE advertencia SET status='".$status."' WHERE id=".$id);
    }

}
?>

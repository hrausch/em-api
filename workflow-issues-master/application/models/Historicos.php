<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historicos extends CI_Model {
	
	 public function pegaAdvertencias($id_aluno) {
        $resultado = $this->db->query('SELECT * FROM advertencia WHERE id_aluno ="' . $id_aluno.'"')->result_array();
        return $resultado;
    }
    public function pegaTiposAdv() {
        $resultado = $this->db->query('SELECT * FROM tipo_itens')->result_array();
        return $resultado;
    }
    public function pegaIdItem($id) {
        $resultado = $this->db->query('SELECT * FROM itens_advertencia WHERE id_advertencia="'.$id.'"')->result_array();
        return $resultado;
    }
    public function pegaDisciplinas() {
        $resultado = $this->db->query('SELECT * FROM disciplina')->result_array();
        return $resultado;
    }
	public function pega2chamada($id_aluno) {
        $resultado = $this->db->query('SELECT * FROM segunda_chamada WHERE id_aluno ="' . $id_aluno.'"')->result_array();
        return $resultado;
    }
}

?>

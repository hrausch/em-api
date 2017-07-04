<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Model {

    public function get($dados) {
        $this->db->where($dados);
        $resultado = $this->db->get("usuario");
        return $resultado->result_array();
    }
  

    public function getById($id) {
        if ($id !== NULL) {
            $this->db->where("id_usuario", $id);
        }
        $resultado = $this->db->get("usuario");
        return $resultado->result_array();
    }

    public function getByUser($id) {
        if ($id !== NULL) {
            $this->db->where("id_usuario", $id);
        }
        $resultado = $this->db->get("usuario");
        return $resultado->result_array();
    }

    public function updateInfo($dados, $id) {
        $this->db->where('id_usuario', $id);
        if ($this->db->update('usuario', $dados)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSenha($dados, $id) {
        $this->db->where('id_usuario', $id);
        if ($this->db->update('usuario', $dados)) {
            error_log("ok");
            return true;
        } else {
            error_log("nok");
            return false;
        }
    }
    public function insertTipoUsuario($dados = NULL) {
        if ($this->db->insert("relacao_tipo_usuario", $dados)) {
            return true;
        } else {
            return false;
        }
    }
    public function insertUsuario($dados = NULL) {
        if ($this->db->insert("usuario", $dados)) {
            return true;
        } else {
            return false;
        }
    }
    public function list_user() {
        return $this->db->get('usuario')->result();
    }
    public function list_tipo() {
      $resultado = $this->db->query('SELECT * FROM relacao_tipo_usuario AS r JOIN usuario AS u ON u.id_usuario = r.id_usuario')->result();
      return $resultado;
    }
}

?>

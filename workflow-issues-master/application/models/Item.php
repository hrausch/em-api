<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Model {

    public function insertItemAdvertencia($dados = NULL) {
        if ($this->db->insert("itens_advertencia", $dados)) {
            return true;
        } else {
            return false;
        }
    }

    public function getItemAdvertencia($id = NULL) {
        if ($id !== NULL) {
            $this->db->where("id_advertencia", $id);
        }
        $resultado = $this->db->get("itens_advertencia");
        return $resultado->result_array();
    }

    public function getItem($id) {
        if ($id !== NULL) {
            $this->db->where("id", $id);
        }
        $resultado = $this->db->get("tipo_itens");
        return $resultado->result_array();
    }

    public function get_tipo($id = NULL) {
        if ($id !== NULL) {
            $this->db->where("id", $id);
        }
        $resultado = $this->db->get("tipo");
        return $resultado->result_array();
    }

}

?>

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function fazerLogin() {
        $this->load->helper(array("form", "url"));
        $this->load->library("form_validation");
        $this->load->database();
        $this->load->model("Usuarios");
        $this->load->library("session");
        $this->form_validation->set_rules("login", "Login", "required");
        $this->form_validation->set_rules("senha", "Senha", "required");
        $usuario = null;
        if ($this->form_validation->run() == TRUE) {
            $teste = $this->input->post();
            $teste["senha"] = md5($this->input->post("senha"));
            $usuario = $this->Usuarios->get($teste);
            if (count($usuario) > 0) {
                $sessao = array(
                    "usuario" => $usuario[0]["nome"],
                    "id" => $usuario[0]["id_usuario"],
                    "curso" => $usuario[0]["curso_relacionado"]
                );
                $this->session->set_userdata($sessao);
                $retorno["erro"] = false;
            } else {
                $retorno["erro"] = true;
                $retorno["validacao"] = true;
                $retorno["msg"] = "Email ou senha incorreto!";
            }
        } else {
            $retorno["erro"] = true;
            $retorno["validacao"] = false;
            $retorno["msg"] = "Preencha todos os campos ou verifique os campos digitados!";
        }
        echo json_encode($retorno);
    }

    public function sair() {
        $this->load->helper("url");
        $this->load->library("session");
        $this->session->sess_destroy();
        redirect(base_url());
    }

}

?>

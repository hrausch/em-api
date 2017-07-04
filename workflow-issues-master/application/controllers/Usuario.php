<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    private $url;
    public $user;

    public function __construct() {
        parent::__construct();
        $this->load->helper(array("form", "url"));
        $this->load->library("form_validation");
        $this->load->model("Usuarios");
        $this->load->model("Advertencia");
        $this->load->library("parser");
        $this->load->database();
        $this->load->library("session");
        $this->url = base_url();
    }

    public function index() {
        $data = array("id_usuario" => $this->session->userdata("id"));
        $usuario = $this->Usuarios->get($data);
        $dados = array(
            "url" => $this->url,
            "nome" => $usuario[0]["nome"],
            "login" => $usuario[0]["login"],
            "email" => $usuario[0]["email"],
            "id" => $usuario[0]["id_usuario"]
        );
        $section = $this->parser->parse("usuario", $dados, true);
        $entrada = array(
            "url" => $this->url,
            "title" => "Detalhes Usuário",
            "section" => $section,
            "usuario" => $this->session->userdata("usuario")
        );

        $this->parser->parse("home", $entrada);
    }

    public function alterarInformacoes() {
        $this->form_validation->set_rules("nome", "Nome", "required");
        $this->form_validation->set_rules("email", "Email", "required");
        if ($this->form_validation->run() == TRUE) {
            $usuario = $this->Usuarios->updateInfo($this->input->post(), $this->session->userdata("id"));
            if ($usuario) {
                $this->session->unset_userdata("usuario");
                $this->session->set_userdata("usuario", $this->input->post("nome"));
                $retorno["erro"] = false;
                $retorno["validacao"] = true;
                $retorno["msg"] = "Suas Informações foram atualizadas com sucesso!";
            } else {
                $retorno["erro"] = true;
                $retorno["validacao"] = true;
                $retorno["msg"] = "Erro na atualização de suas informações, tente novamente!";
            }
        } else {
            $retorno["erro"] = true;
            $retorno["validacao"] = false;
            $retorno["msg"] = "Preencha todos os campos ou verifique os campos digitados!";
        }
        echo json_encode($retorno);
    }

    public function alterarSenha() {
        $this->form_validation->set_rules("senhaAtual", "Senha", "required");
        $this->form_validation->set_rules("senha", "Nova", "required");
        $this->form_validation->set_rules("confirmacao", "Confirma", "required");
        $dados = array("senha" => md5($this->input->post("confirmacao")));

        if ($this->form_validation->run() == TRUE) {
            $usu = $this->Usuarios->getById($this->session->userdata("id"));

            foreach ($usu as $u) {
                if ($u["senha"] == md5($this->input->post("senhaAtual"))) {
                    if ($this->input->post("confirmacao") == $this->input->post("senha")) {
                        $usuario = $this->Usuarios->updateSenha($dados, $this->session->userdata("id"));
                        error_log("11");
                    }
                } else {
                    $usuario = NULL;
                }
            }
            if ($usuario) {
                $retorno["erro"] = false;
                $retorno["validacao"] = true;
                $retorno["msg"] = "Suas Informações foram atualizadas com sucesso!";
            } else {
                $retorno["erro"] = true;
                $retorno["validacao"] = true;
                $retorno["msg"] = "Erro na atualização de suas informações, tente novamente!";
            }
        } else {
            $retorno["erro"] = true;
            $retorno["validacao"] = false;
            $retorno["msg"] = "Preencha todos os campos ou verifique os campos digitados!";
        }
        echo json_encode($retorno);
    }

    public function listarUsuario() {
        if ($this->session->userdata("id")) {
            $info = array("url" => $this->url, "titulo" => "Usuários");
            $info['usuarios'] = $this->Usuarios->list_user();
           $info['tipo']= $this->Usuarios->list_tipo();

            $this->section = $this->parser->parse("usuariolist", $info, true);
            $entrada = array(
                "url" => $this->url,
                "title" => "Usuários",
                "section" => $this->section,
                "usuario" => $this->session->userdata("usuario")
            );
            $this->parser->parse("home", $entrada);
        } else {
            redirect(base_url());
        }
    }

}

?>

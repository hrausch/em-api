<?php

class Cadastro extends CI_Controller {

    private $section;
    private $data;
    private $url;

    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->database();
        $this->load->library("parser");
        $this->url = base_url();
        $this->load->model("Usuarios");
        $this->load->library("session");
        if (!$this->session->userdata("id")) {
            $this->data = array("url" => $this->url);
        } else {
            $data = array("url" => $this->url);
            $this->section = $this->parser->parse("principal", $data, true);
        }
    }

    public function index() {
        if ($this->session->userdata("id")) {
            $dados = array(
                "url" => $this->url
            );
            $section = $this->parser->parse("cadastro", $dados, true);
            $entrada = array(
                "url" => $this->url,
                "title" => "Cadastrar Usuário",
                "section" => $section,
                "usuario" => $this->session->userdata("usuario")
            );
            $this->parser->parse("home", $entrada);
        } else {
            redirect(base_url());
        }
    }

    //Cadastro de Usuário
    public function cadastrar() {
        $this->load->helper(array("form", "url"));
        $this->load->database();
        //Pega campos do formulario
        $data['email'] = $this->input->post('email');
        $data['login'] = $this->input->post('login');
        $data['nome'] = $this->input->post('nome');
        $data['curso_relacionado'] = $this->input->post('curso');
        $data['senha'] = md5($this->input->post('senha'));
        $confirmaSenha = $_POST['confirma'];
        $resultado[] = $this->Usuarios->insertUsuario($data);

        $id_user =$this->db->insert_id();
          foreach ($this->input->post("tipo[]") as $item) {
                $dados2["id_tipo_usuario"] = $item;
                $dados2["id_usuario"] = $id_user;
                $this->Usuarios->insertTipoUsuario($dados2);

          }
          if($resultado) {
            echo '<script>alert("NOVO USUARIO ADICIONADO!!!");
            location.href="http://localhost/Estagio/workflow-issues-master/index.php/Usuario/listarUsuario";</script>';
            $this->index();
          }else {
            echo "<center><strong>Ocorreu algum erro ao adicionar os dados no banco!!! Retorne e tente novamente.</strong></center>";
          }

         }


}

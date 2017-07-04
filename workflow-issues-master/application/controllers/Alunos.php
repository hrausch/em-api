<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Alunos extends CI_Controller {

    private $url;

    public function __construct() {
        parent::__construct();
        $this->load->library("parser");
        $this->load->helper("url");
        $this->load->database();
        $this->load->model("Advertencia");
        $this->load->model("Aluno");
        $this->load->model("Item");
        $this->load->library("session");
        $this->url = base_url();
        $this->load->helper("form");
        $this->load->library("form_validation");
    }

    public function index() {
        if ($this->session->userdata("id")) {
            $data = array("url" => $this->url);
            $section = $this->parser->parse("aluno", $data, true);
            $entrada = array(
                "url" => $this->url,
                "title" => "Busca por Aluno",
                "section" => $section,
                "usuario" => $this->session->userdata("usuario")
            );

            $this->parser->parse("home", $entrada);
        } else {
            $this->parser->parse('login', $this->data);
        }
    }

    public function advertencias($id = NULL) {
        if ($id == NULL) {
            
        } else {
            $adv = $this->Advertencia->getByAluno($id);
            $i = 0;
            foreach ($adv as $a) {
                $aluno = $this->Aluno->get($a["id_aluno"]);
                foreach ($aluno as $an) {
                    $a["aluno"] = $an["nome"];
                    $curso = $this->Aluno->get_curso($an["id_curso"]);
                    $turma = $this->Aluno->get_turma($an["id_turma"]);
                    foreach ($turma as $t) {
                        $a["curso"] = $t["turma"];
                    }
                    foreach ($curso as $c) {
                        $a["curso"] = $a["curso"] . " - " . $c["curso"];
                    }
                }
                $tipo = $this->Item->get_tipo($a["tipo"]);
                $a["tipo"] = $tipo[0]["tipo"];
                $a["url"] = $this->url;
                $adv[$i] = $a;
                $i++;
            }
            $data = array(
                "entrada" => $adv,
                "url" => $this->url,
                "titulo" => "Advertências"
            );
            $this->section = $this->parser->parse("advertencias", $data, true);
            $entrada = array(
                "url" => $this->url,
                "title" => "Advertências",
                "section" => $this->section,
                "usuario" => $this->session->userdata("usuario")
            );

            $this->parser->parse("home", $entrada);
        }
    }

}

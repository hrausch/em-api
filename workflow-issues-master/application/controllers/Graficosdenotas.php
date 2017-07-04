<?php

class Graficosdenotas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array("form", "url"));
        $this->load->library("form_validation");
        $this->load->library("parser");
        $this->load->library("session");
        $this->load->model("GraficosNotas");
        $this->url = base_url();
    }

    public function index() {
        if ($this->session->userdata("id")) {
            $dados = array(
                "url" => $this->url
            );
            $section = $this->parser->parse("indicadores", $dados, true);
            $entrada = array(
                "url" => $this->url,
                "title" => "Gráficos de notas",
                "section" => $section,
                "usuario" => $this->session->userdata("usuario")
            );
            $this->parser->parse("home", $entrada);
        } else {
            redirect(base_url());
        }
    }
    public function grafnota() {
        if ($this->session->userdata("id")) {
            $dados = array(
                "url" => $this->url
            );
            $section = $this->parser->parse("graficosdenotas", $dados, true);
            $entrada = array(
                "url" => $this->url,
                "title" => "Gráficos de notas",
                "section" => $section,
                "usuario" => $this->session->userdata("usuario")
            );
            $this->parser->parse("home", $entrada);
        } else {
            redirect(base_url());
        }
    }

    //FUNÇÃO CONSULTA VALORES NO BD, RETORNA DADOS ERECARREGA VIEW
    public function geraGraficoBarra() {
        //RECEBENDO VALORES BD
        $curso = $_POST['curso'];
        $turma = $_POST['turma'];
        $periodo = $_POST['bimestre'];
        $ano = $_POST['anobase'];

        //CONSULTANDO NO BD (NO MODEL)
        $dados['grafico'] = $this->GraficosNotas->geraGrafBarra($curso, $turma, $periodo, $ano);
        $dados['graficoRadar'] = $this->GraficosNotas->geraGrafRadar($curso, $turma, $periodo, $ano);
        $dados['periodo'] = $periodo;

        //CHAMANDO A VIEW
        $section = $this->parser->parse("graficosdenotas", $dados, true);
        $entrada = array(
            "url" => $this->url,
            "title" => "Gráficos de notas",
            "section" => $section,
            "usuario" => $this->session->userdata("usuario")
        );
        $this->parser->parse("home", $entrada);
    }

}

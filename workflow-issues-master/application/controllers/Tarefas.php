<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tarefas extends CI_Controller {

    private $section;
    private $data;
    private $url;

    public function __construct() {
        parent::__construct();
        $this->load->library("parser");
        $this->load->helper("url");
        $this->load->database();
        $this->load->model("Advertencia");
        $this->load->model("Aluno");
        $this->load->model("Usuarios");
        $this->load->model("Demandas");

        $this->load->model("SegChamada");

        $this->load->model("Item");
        $this->load->library("session");
        $this->url = base_url();
        $this->load->helper("form");
        $this->load->library("form_validation");
        if (!$this->session->userdata("id")) {
            $this->data = array("url" => $this->url);
        } else {
            $data = array("url" => $this->url);
            $this->section = $this->parser->parse("principal", $data, true);
        }
    }


    public function geraHtml($pedidos) {
      //SEGUNDA CHAMADA
        $resultado = "";
        foreach ($pedidos as $linha) {
            $disciplina = $this->SegChamada->disciplina_segchamada($linha['id_disciplina']);
            $aluno  = $this->SegChamada->aluno_segchamada($linha['id_aluno']);

            if($this->session->userdata("curso")==$aluno[0]['id_curso']){
                if ($linha['situacao'] == "Encaminhada") {
                    $resultado = $resultado . '<tr bgcolor="#FFFFD5">';

                $resultado = $resultado . '<td>' . $aluno[0]['nome']. '</td>';
                $resultado = $resultado . '<td>' . $disciplina[0]["nome_disciplina"] . '</td>';
                $resultado = $resultado . '<td>' . date("d/m/Y", strtotime($linha['data_inic_periodo'])) . '</td>';
                $resultado = $resultado . '<td>' . date("d/m/Y", strtotime($linha['data_fim_periodo'])) . '</td>';
                $resultado = $resultado . '<td>' . date("d/m/Y", strtotime($linha['data_pedido'])) . '</td>';                $resultado = $resultado . '<td>' . date("d/m/Y", strtotime($linha['data_pedido'])) . '</td>';
                $resultado = $resultado . '<td>' . $linha['situacao'] . '</td>';
                $resultado = $resultado . '<td><a href="{url}index.php/usercomum/Segundachamada/detalhes/' . $linha['id_segunda_chamada'] . '" class="btn btn-default"><i class="fa fa-info-circle"></i></a></button></td>';
                $resultado = $resultado . '</tr>';
                  }
             }
        }
        //DEMANDAS

        return $resultado;

    }
    public function geraHtmlTabelaDemandas($demandas) {
        $resultado = "";
        foreach ($demandas as $linha) {
            $nome = $this->Demandas->pegaNomeUsuario($linha['id_usuario_criador']);
            $nome2 = $this->Demandas->pegaNomeUsuario($linha['id_usuario']);
            $tipo = $this->Demandas->pegaTipo($linha["id_tipo_demanda"]);
            if ($tipo[0]["tipo_demanda"] != "Resposta") {
                if ($linha['situacao'] == "Aguardando resposta") {
                    $resultado = $resultado . '<tr bgcolor="#FFFFD5">';

                $resultado = $resultado . '<td>' . $nome[0]["nome"] . '</td>';
                $resultado = $resultado . '<td>' . $nome2[0]["nome"] . '</td>';
                $resultado = $resultado . '<td>' . $tipo[0]["tipo_demanda"] . '</td>';
                $resultado = $resultado . '<td>' . date("d/m/Y", strtotime($linha['data_criacao'])) . '</td>';
                $resultado = $resultado . '<td>' . date("H:i - d/m/Y", strtotime($linha['data_update'])) . '</td>';
                $resultado = $resultado . '<td>' . $linha['situacao'] . '</td>';
                $resultado = $resultado . '<td><a href="{url}index.php/Demanda/detalhes/' . $linha['id_demanda'] . '/' . $linha['id_usuario_criador'] . '/' . $linha['id_usuario'] . '" class="btn btn-default"><i class="fa fa-info-circle"></i></a></button></td>';
                $resultado = $resultado . '</tr>';
              }
           }
        }
        return $resultado;
    }
    public function lista() {
      if ($this->session->userdata("id")) {
        $info = array("url" => $this->url, "titulo" => "Usuários");
        $info['tarefa_recebida'] = $this->geraHtml($this->SegChamada->pegaPedidos());
        $info['demandas_recebidas'] = $this->geraHtmlTabelaDemandas($this->Demandas->pegaDemandas($this->session->userdata("id")));
        $info['tipo']=$this->SegChamada->pegaTipoUsuario($this->session->userdata("id"));
        $this->section = $this->parser->parse("tarefas", $info, true);
        $entrada = array(
            "url" => $this->url,
            "title" => "Segunda Chamada",
            "section" => $this->section,
            "usuario" => $this->session->userdata("usuario")
        );
        $this->parser->parse("home", $entrada);
      } else {
          redirect(base_url());
      }
    }

}

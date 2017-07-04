<?php

class Historico extends CI_Controller {

    private $section;
    private $data;
    private $url;

    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->database();
        $this->load->model("Historicos");
        $this->load->library("parser");
        $this->url = base_url();
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
                "url" => $this->url,
                "resultado" => ""
            );
            $section = $this->parser->parse("historico", $dados, true);
            $entrada = array(
                "url" => $this->url,
                "title" => "Histórico",
                "section" => $section,
                "usuario" => $this->session->userdata("usuario")
            );
            $this->parser->parse("home", $entrada);
        } else {
            redirect(base_url());
        }
    }
    
 	public function gerarGraficos() {
 				if ($this->session->userdata("id")) {
 				$id_aluno = $this->input->post('aluno_select');
 				$resultado = $this->geraGrafico1($id_aluno);
 				$resultado = $resultado.$this->geraGrafico2($id_aluno);
            $dados = array(
              "url" => $this->url
            );
           $dados["resultado"] = $resultado;
            $section = $this->parser->parse("historico", $dados, true);
            $entrada = array(
                "url" => $this->url,
                "title" => "Histórico",
                "section" => $section,
                "usuario" => $this->session->userdata("usuario")
            );
            $this->parser->parse("home", $entrada);
        } else {
            redirect(base_url());
        }
 	}

 	public function geraGrafico1($id_aluno) {
 		$tipo = $this->Historicos->pegaTiposAdv();
 		$adv = $this->Historicos->pegaAdvertencias($id_aluno);
 		$html = '
		<!-- Resources --><script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
		<script src="https://www.amcharts.com/lib/3/pie.js"></script>
		<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
		<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
		<script src="https://www.amcharts.com/lib/3/themes/none.js"></script>
		<!-- Chart code --><script>
		var chart = AmCharts.makeChart( "chartdiv", {"titles": [{"text": "Advertências deste aluno","size": "35"}],"type": "pie",
  		"theme": "none","dataProvider": [';

  		$dados = "{},";
  		foreach($tipo as $t){
  			$cont = 0;
  			foreach($adv as $a){
  				$b = $this->Historicos->pegaIdItem($a["id"]);
  				if($t['id'] == $b[0]["id_item"]) {
					$cont++;
  				}
  			}
  			if($cont != 0) {
  			$dados = $dados.'{"tipo": "'.$t["item"].'",';
  			$dados = $dados.'"quantidade":'.$cont.'},';
  			}
 		}
 		$dados = $dados.'{}';
 		if($dados != '{},{}') {
			$html = $html.$dados;
			$html = $html.'],
  		"valueField": "quantidade",
  		"titleField": "tipo",
   	"balloon":{
   		"fixedPosition":true
  		},
  		"export": {
  		 	"enabled": true
  		}
		});</script>
		<!-- Styles --><style>#chartdiv {width: 100%;height: 500px;}</style>
		<!-- HTML -->
		<div id="chartdiv"></div><hr>';
 		}else {
			$html = $html.'],
  		"valueField": "quantidade",
  		"titleField": "tipo",
   	"balloon":{
   		"fixedPosition":true
  		},
  		"export": {
  		 	"enabled": false
  		}
		});</script>
		<!-- HTML -->
		<div id="chartdiv"></div>
		<!-- Styles --><style>#chartdiv {width: 100%;height: 90px;}</style>
		<center> Este aluno não possui advertências </center>		<hr>
		';
 		}
 		return $html;
 	}


 	public function geraGrafico2($id_aluno) {
 		$dis = $this->Historicos->pegaDisciplinas();
 		$adv = $this->Historicos->pega2chamada($id_aluno);
 		$html = '<!-- Chart code --><script>
		var chart = AmCharts.makeChart( "chartdiv2", {"titles": [{"text": "Pedidos de 2ª chamadas por disciplina","size": "35"}],"type": "pie",
  		"theme": "none","dataProvider": [';

  		$dados = "{},";
  		foreach($dis as $t){
  			$cont = 0;
  			foreach($adv as $a){
  				if($t['id_disciplina'] == $a["id_disciplina"]) {
					$cont++;
  				}
  			}
  			if($cont != 0) {
  			$dados = $dados.'{"tipo": "'.$t["nome_disciplina"].'",';
  			$dados = $dados.'"quantidade":'.$cont.'},';
  			}
 		}
 		$dados = $dados.'{}';
 		if($dados != '{},{}') {
			$html = $html.$dados;
			$html = $html.'],
  		"valueField": "quantidade",
  		"titleField": "tipo",
   	"balloon":{
   		"fixedPosition":true
  		},
  		"export": {
  		 	"enabled": true
  		}
		});</script>
		<!-- Styles --><style>#chartdiv2 {width: 100%;height: 500px;}</style>
		<!-- HTML -->
		<div id="chartdiv2"></div><hr>';
 		}else {
			$html = $html.'],
  		"valueField": "quantidade",
  		"titleField": "tipo",
   	"balloon":{
   		"fixedPosition":true
  		},
  		"export": {
  		 	"enabled": false
  		}
		});</script>
		<!-- Styles --><style>#chartdiv2 {width: 100%;height: 90px;}</style>
		<!-- HTML -->
		<div id="chartdiv2"></div>
		<center> Este aluno não pediu 2ª chamadas</center><hr>
		';
 		}
 		return $html;
 	}

}

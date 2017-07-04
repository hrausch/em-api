<?php

class TurmaHistorico extends CI_Controller {

    private $section;
    private $data;
    private $url;

    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->database();
        $this->load->model("Historicos");
        $this->load->model("HistoricoTurma");

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
            $section = $this->parser->parse("turma-historico", $dados, true);
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
 				$id_turma = $this->input->post('turma');
 				$bimestre = $this->input->post('bimestre');
 				$ano = $this->input->post('ano');
 				$resultado = $this->geraGrafico1($id_turma);
 				$resultado = $resultado.$this->geraGrafico2($id_turma);
 				$resultado = $resultado.$this->geraGrafico4($id_turma);
				$resultado = $resultado.$this->geraGrafico5($id_turma);
				$resultado = $resultado.$this->geraGrafico6($id_turma, $bimestre, $ano);
            $dados = array(
              "url" => $this->url
            );
           $dados["resultado"] = $resultado;
            $section = $this->parser->parse("turma-historico", $dados, true);
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

 	public function geraGrafico1($id_turma) {
 		$i = $this->HistoricoTurma->pegaSegChamada($id_turma);
    $dis = $this->HistoricoTurma->pegaDisciplinas();
    $html = '<!-- Resources --><script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
		<script src="https://www.amcharts.com/lib/3/pie.js"></script>
		<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
		<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
		<script src="https://www.amcharts.com/lib/3/themes/none.js"></script>
    <!-- Chart code --><script>
    var chart = AmCharts.makeChart( "chartdiv2", {"titles": [{"text": "Pedidos de 2ª chamadas por Turma","size": "35"}],"type": "pie",
      "theme": "none","dataProvider": [';

      $dados = "{},";
      foreach($dis as $t){
        $cont = 0;
        foreach($i as $a){
          if($t['id_disciplina'] == $a["id_disciplina"]) {
          $cont++;
          }
        }
        if($cont != 0) {
        $dados = $dados.'{"tipo": "'.$t["nome_disciplina"].'",';
        $dados = $dados.'"quantidade":'.$cont.'},';
      }
    }      //echo $a['id_disciplina'];

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
    <center> Esta turma não pediu 2ª chamadas</center><hr>
    ';
  }
    return $html;
  }
  
  public function geraGrafico2($id_turma){
  $adv = $this->HistoricoTurma->pegaAdvertencias($id_turma);
  $tipos = $this->HistoricoTurma->pegaTipos();
  $html = '<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/radar.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

<!-- Chart code -->
<script>
var chart = AmCharts.makeChart( "chartdiv3",{"titles": [{"text": "Advertências desta turma","size": "35"}],
  "type": "radar",
  "theme": "none",
  "dataProvider": [';
$dados = '{},';
foreach($tipos as $t){
	$cont = 0;
	foreach($adv as $a){
		$r = $this->HistoricoTurma->pegaRelacao($a['id']);
		if($r != NULL) {
		if($t['id'] == $r[0]['id_item']) {
			$cont++;
		}}
	}
	if($cont != 0) {
        $dados = $dados.'{"tipo": "'.$t["item"].'",';
        $dados = $dados.'"litres":'.$cont.'},';
      }
}
$dados = $dados.'{}'; 
 if($dados != '{},{}') {
      $html = $html.$dados;
      $html = $html.'],
  "valueAxes": [ {
    "axisTitleOffset": 20,
    "minimum": 0,
    "axisAlpha": 0.15
  } ],
  "startDuration": 2,
  "graphs": [ {
    "balloonText": "[[value]] advertência deste tipo",
    "bullet": "round",
    "lineThickness": 2,
    "valueField": "litres"
  } ],
  "categoryField": "tipo",
  "export": {
    "enabled": true
  }
} );
</script>
<!-- Styles -->
<style>
#chartdiv3 {
  width: 100%;
  height: 500px;
}				
</style>
<!-- HTML -->

<div id="chartdiv3"></div>							';
}else {
$html = $html.'],
  "valueAxes": [ {
    "axisTitleOffset": 20,
    "minimum": 0,
    "axisAlpha": 0.15
  } ],
  "startDuration": 2,
  "graphs": [ {
    "balloonText": "[[value]] advertência deste tipo",
    "bullet": "round",
    "lineThickness": 2,
    "valueField": "litres"
  } ],
  "categoryField": "tipo",
  "export": {
    "enabled": false
  }
} );
</script>
<!-- Styles -->
<style>
#chartdiv3 {
  width: 100%;
  height: 90px;
}				
</style>
<!-- HTML -->
<div id="chartdiv3"></div>
  <center> Esta turma não possui advertências</center><hr>';
}
return $html;
   }
	
	public function geraGrafico4($id_turma) {
		$turmas = $this->HistoricoTurma->pegaTodasTurmas();
		$segchamada = $this->HistoricoTurma->pegaChamadas();	
	
		$html = '<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}

.amcharts-export-menu-top-right {
  top: 10px;
  right: 0;
}
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<!-- Chart code -->
<script>
var chart = AmCharts.makeChart("chartdiv", {
  "type": "serial",
  "titles": [{"text": "Comparações entre turmas - Segundas chamadas","size": "35"}],
  "theme": "light",
  "marginRight": 70,
  "dataProvider": [';

  foreach($turmas as $t){
  	$cont = 0;
  	foreach($segchamada as $s){
  		$o = $this->HistoricoTurma->pegaAlunoTurma($s['id_aluno']);
  		if($o[0]['id_turma'] == $t['id_turma'] && $o != NULL) {
  			$cont++;  		
  		} 	
  	}
  	if($t['id_curso'] == 1){
  		$ttt = "EDI - ".$t['turma'];
  	}else if($t['id_curso'] == 2) {
  		$ttt = "INF - ".$t['turma'];
  	}else {
  		$ttt = "MEC - ".$t['turma'];
  	}
  	$html = $html.'{"country": "'.$ttt.'",';
	$html = $html.'"visits": '.$cont.' ,';
	if($id_turma != $t['id_turma']) {
   $html = $html.'"color": "#0D52D1"},';}else {
    $html = $html.'"color": "#FF0F00"},';
   }
  }
  
  $html = $html.'],
  "startDuration": 1,
  "graphs": [{
    "balloonText": "<b>A turma [[category]] pediu [[value]] segundas chamadas</b>",
    "fillColorsField": "color",
    "fillAlphas": 0.9,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "visits"
  }],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "country",
  "categoryAxis": {
    "gridPosition": "start",
    "labelRotation": 45
  },
  "export": {
    "enabled": true
  }

});
</script>

<!-- HTML -->
<div id="chartdiv"></div><hr>';				
	
	return $html;
	
	}
	public function geraGrafico5($id_turma) {
		$turmas = $this->HistoricoTurma->pegaTodasTurmas();
		$adv = $this->HistoricoTurma->pegaTodasAdvertencias();	
	
		$html = '<!-- Styles -->
<style>
#chartdiv5 {
  width: 100%;
  height: 500px;
}

.amcharts-export-menu-top-right {
  top: 10px;
  right: 0;
}
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<!-- Chart code -->
<script>
var chart = AmCharts.makeChart("chartdiv5", {
  "type": "serial",
  "titles": [{"text": "Comparações entre turmas - Advertências","size": "35"}],
  "theme": "light",
  "marginRight": 70,
  "dataProvider": [';

  foreach($turmas as $t){
  	$cont = 0;
  	foreach($adv as $s){
  		$o = $this->HistoricoTurma->pegaAlunoTurma($s['id_aluno']);
  		if($o[0]['id_turma'] == $t['id_turma'] && $o != NULL) {
  			$cont++;  		
  		} 	
  	}
  	if($t['id_curso'] == 1){
  		$ttt = "EDI - ".$t['turma'];
  	}else if($t['id_curso'] == 2) {
  		$ttt = "INF - ".$t['turma'];
  	}else {
  		$ttt = "MEC - ".$t['turma'];
  	}
  	$html = $html.'{"country": "'.$ttt.'",';
	$html = $html.'"visits": '.$cont.' ,';
	if($id_turma != $t['id_turma']) {
   $html = $html.'"color": "#0D52D1"},';}else {
    $html = $html.'"color": "#FF0F00"},';
   }
  }
  
  $html = $html.'],
  "startDuration": 1,
  "graphs": [{
    "balloonText": "<b>A turma [[category]] recebeu [[value]] advertências</b>",
    "fillColorsField": "color",
    "fillAlphas": 0.9,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "visits"
  }],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "country",
  "categoryAxis": {
    "gridPosition": "start",
    "labelRotation": 45
  },
  "export": {
    "enabled": true
  }

});
</script>

<!-- HTML -->
<div id="chartdiv5"></div><hr>';				
	
	return $html;
	
	}
	
	public function geraGrafico6($id_turma, $bimestre, $ano) {
	$lecionadas = $this->HistoricoTurma->pegaDisciplinasLecionada($id_turma);
	$html = '<!-- Styles -->
<style>
#chartdiv6 {
	width		: 100%;
	height		: 500px;
	font-size	: 11px;
}					
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/none.js"></script>

<!-- Chart code -->
<script>
var chart6 = AmCharts.makeChart( "chartdiv6", {
  "type": "serial",
   "titles": [{"text": "Média de notas desta turma no período","size": "35"}],
  "theme": "none",
  "dataProvider": [';
  foreach($lecionadas as $l){
  		$nome = $this->HistoricoTurma-> pegaNomeDisciplina($l['id_disciplina']);
		$nota = $this->HistoricoTurma->pegaMedia($id_turma, $bimestre, $ano, $l['id_disciplina']);
		if($nota[0]["AVG(nota)"] != "") {
  			$html = $html.'{"country":"'.$nome[0]["nome_disciplina"].'", "visits": '.$nota[0]["AVG(nota)"].' },';
  		}
  }  
  $html = $html.'{}],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.9,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "visits"
  }],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "country",
  "categoryAxis": {
    "gridPosition": "start",
    "labelRotation": 45
  },
  "export": {
    "enabled": true
  }

} );
</script>

<!-- HTML -->
<div id="chartdiv6"></div>';
return $html;
	
	
	}
}

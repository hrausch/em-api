var chart2 = AmCharts.makeChart( "chartdiv1", {
	"type": "serial",
	"categoryField": "category",
	"startDuration": 1,
	"categoryAxis": {
		"gridPosition": "start"
	},
	"graphs": [
		{
			"balloonText": "[[title]] na [[categoryTitle]]:[[value]]",
			"fillAlphas": 1,
			"id": "AmGraph-1",
			"title": "Média de notas",
			"type": "column",
			"valueField": "1 Bimestre"
		},

	],

	"valueAxes": [
		{
			"id": "ValueAxis-1",
			"title": "MÉDIA POR MATÉRIA"
		},
		{
			"id": "ValueAxis-2",
			"position": "right",
			"gridAlpha": 0,
			"title": "MÉDIA POR MATÉRIA"
		}
	],
	"dataProvider": [
		//INICIO PHP
		<?php //CONTAR QUANTAS LINHAS POSSUI
	 		$numero = 0;
			foreach($grafico as $coluna){
				$numero = $numero + 1;
			}
			//COLOCANDO OS VALORES NO GRÁFICO
			$contador = 0;
			foreach($grafico as $coluna){
				$contador = $contador + 1;
				echo '{';
				echo '"categoryTitle": "'.$coluna['nome_disciplina'].'",';
				echo '"category": "'.$coluna['disciplina'].'",';
				echo '"1 Bimestre": "'.$coluna['nota'].'",';
				//SE FOR A ÚLTIMA COLUNA É NECESSÁRIO FECHAR O GRÁFICO
				if($contador == $numero){
					echo '}';
				}else{
					echo '},';
				}
				if($numero==0){
					echo "teste";
				}
			}

?>
	]
} );

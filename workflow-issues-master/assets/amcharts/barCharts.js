var chart2 = AmCharts.makeChart( "chartdiv1", {
	"type": "serial",
	"categoryField": "category",
	"startDuration": 1,
	"categoryAxis": {
		"gridPosition": "start"
	},
	"graphs": [
		{
			"balloonText": "[[title]] of [[category]]:[[value]]",
			"fillAlphas": 1,
			"id": "AmGraph-1",
			"title": "graph 1",
			"type": "column",
			"valueField": "1 Bimestre"
		},
		{
			"balloonText": "[[title]] of [[category]]:[[value]]",
			"fillAlphas": 1,
			"id": "AmGraph-2",
			"title": "graph 2",
			"type": "column",
			"valueAxis": "ValueAxis-2",
			"valueField": "2 Bimestre"
		}
	],
	
	"valueAxes": [
		{
			"id": "ValueAxis-1",
			"title": "Axis title"
		},
		{
			"id": "ValueAxis-2",
			"position": "right",
			"gridAlpha": 0,
			"title": "Axis title"
		}
	],
	"dataProvider": [
		{
			"2 Bimestre": "76.54762",
			"categoryTitle": "Artes",
			"category": "8FG.002",
			"1 Bimestre": "90.42857"
		},
		{
			"2 Bimestre": "68.38095",
			"categoryTitle": " Biologia I",
			"category": "8FG.009",
			"1 Bimestre": "80.0"
		},
		{
			"2 Bimestre": "75.2381",
			"categoryTitle": " Educação Física I",
			"category": "8FG.003",
			"1 Bimestre": "68.928566"
		},
		{
			"2 Bimestre": "73.19048",
			"categoryTitle": "Filosofia",
			"category": "8FG.016",
			"1 Bimestre": "77.85715"
		},
		{
			"2 Bimestre": "73.61905",
			"categoryTitle": "Física I",
			"category": "8FG.011",
			"1 Bimestre": "60.285717"
		},
		{
			"2 Bimestre": "34.52381",
			"categoryTitle": "Fundamentos de Informática",
			"category": "8INF.142",
			"1 Bimestre": "66.78572"
		},
		{
			"2 Bimestre": "67.809525",
			"categoryTitle": "Geografia I",
			"category": "8FG.014",
			"1 Bimestre": "59.821426"
		},
		{
			"2 Bimestre": "76.0",
			"categoryTitle": "História I",
			"category": "8FG.015",
			"1 Bimestre": "74.28571"
		},
		{
			"2 Bimestre": "70.66667",
			"categoryTitle": "Inglês Técnico",
			"category": "8INF.023",
			"1 Bimestre": "83.42857"
		},
		{
			"2 Bimestre": "69.285706",
			"categoryTitle": " Língua Estrangeira Inglês I",
			"category": "8FG.019",
			"1 Bimestre": "74.14285"
		},
		{
			"2 Bimestre": "66.0",
			"categoryTitle": "Língua Portuguesa I",
			"category": "8FG.005",
			"1 Bimestre": "59.000004"
		},
		{
			"2 Bimestre": "67.73809",
			"categoryTitle": "Linguagem de Programação I",
			"category": "8INF.143",
			"1 Bimestre": "67.14285"
		},
		{
			"2 Bimestre": "68.6",
			"categoryTitle": "Matemática I",
			"category": "8FG.001",
			"1 Bimestre": "63.857143"
		},
		{
			"2 Bimestre": "78.92857",
			"categoryTitle": "Prática de Redação I",
			"category": "8FG.006",
			"1 Bimestre": "69.28571"
		}
	]







 
} );


	   

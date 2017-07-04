var chart = AmCharts.makeChart( "chartdiv", {
  "type": "radar",
  "theme": "light",
  "dataProvider": [
    {
        "categoryTitle": "Artes",
        "category": "8FG.002",
        "lostAverages": "12"
    },
    {
        "categoryTitle": " Biologia I",
        "category": "8FG.009",
        "lostAverages": "12"
    },
    {
        "categoryTitle": " Educação Física I",
        "category": "8FG.003",
        "lostAverages": "12"
    },
    {
        "categoryTitle": "Filosofia",
        "category": "8FG.016",
        "lostAverages": "12"
    },
    {
        "categoryTitle": "Física I",
        "category": "8FG.011",
        "lostAverages": "12"
    },
    {
        "categoryTitle": "Fundamentos de Informática",
        "category": "8INF.142",
        "lostAverages": "12"
    },
    {
        "categoryTitle": "Geografia I",
        "category": "8FG.014",
        "lostAverages": "12"
    },
    {
        "categoryTitle": "História I",
        "category": "8FG.015",
        "lostAverages": "12"
    },
    {
        "categoryTitle": "Inglês Técnico",
        "category": "8INF.023",
        "lostAverages": "12"
    },
    {
        "categoryTitle": " Língua Estrangeira Inglês I",
        "category": "8FG.019",
        "lostAverages": "12"
    },
    {
        "categoryTitle": "Língua Portuguesa I",
        "category": "8FG.005",
        "lostAverages": "12"
    },
    {
        "categoryTitle": "Linguagem de Programação I",
        "category": "8INF.143",
        "lostAverages": "12"
    },
    {
        "categoryTitle": "Matemática I",
        "category": "8FG.001",
        "lostAverages": "12"
    },
    {
        "categoryTitle": "Prática de Redação I",
        "category": "8FG.006",
        "lostAverages": "12"
    },
    {
        "categoryTitle": "Química I",
        "category": "8FG.013",
        "lostAverages": "12"
    }
],




  "valueAxes": [ {
    "axisTitleOffset": 20,
    "minimum": 0,
    "axisAlpha": 0.15
  } ],




  "startDuration": 2,
  "graphs": [ {
    "balloonText": "[[value]] litres of beer per year",
    "bullet": "round",
    "valueField": "lostAverages"
  } ],



  "categoryField": "category",
  "export": {
    "enabled": true
  }
} );

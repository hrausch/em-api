<!------------------------------------ SCRIPT QUE FAZ O GRÁFICO DE BARRAS ------------------------------------------------------------->
<script>
    var chart2 = AmCharts.makeChart("chartdiv1", {
        "type": "serial",
        "categoryField": "category",
        "startDuration": 1,
        "categoryAxis": {
            "gridPosition": "start"
        },
        "graphs": [
<?php
//ESTES IFs PERMITEM QUE DEPENDENDO DO NÚMERO DE BIMESTRES AS COLUNAS DO GRÁFICO NÃO FIQUEM DESPROPORCIONAIS
echo '
                {
                        "balloonText": "[[title]] na [[categoryTitle]]:[[value]]",
                        "fillAlphas": 1,
                        "id": "AmGraph-1",
                        "title": "Média de notas",
                        "type": "column",
                        "valueField": "1 Bimestre"
                },';
if ($periodo > 1) {
    echo '
                {
                        "balloonText": "[[title]] na [[categoryTitle]]:[[value]]",
                        "fillAlphas": 1,
                        "id": "AmGraph-2",
                        "title": "Média de notas",
                        "type": "column",
                        "valueField": "2 Bimestre"
                },';
}
if ($periodo > 2) {
    echo '{
                        "balloonText": "[[title]] na [[categoryTitle]]:[[value]]",
                        "fillAlphas": 1,
                        "id": "AmGraph-3",
                        "title": "Média de notas",
                        "type": "column",
                        "valueField": "3 Bimestre"
                },';
}
if ($periodo > 3) {
    echo '
                {
                        "balloonText": "[[title]] na [[categoryTitle]]:[[value]]",
                        "fillAlphas": 1,
                        "id": "AmGraph-4",
                        "title": "Média de notas",
                        "type": "column",
                        "valueField": "4 Bimestre"
                },';
}
?>
        ],

        "valueAxes": [
            {
                "id": "ValueAxis-1",
                "title": "MÉDIA POR MATÉRIA"
            }
        ],

        "dataProvider": [
<?php
//CONTAR QUANTAS LINHAS POSSUI

$numero = count($grafico);
//COLOCANDO OS VALORES NO GRÁFICO
$contador = 0;
$boolcontrole = false;
$periodocont = 0;
foreach ($grafico as $coluna) {
    $contador++;
    $periodocont++;
    if ($coluna['bimestre'] < $periodocont) {
        while ($periodocont <= $periodo) {
            if ($periodocont == 2) {
                $bimestre = '"2 Bimestre": "';
            } else if ($periodocont == 3) {
                $bimestre = '"3 Bimestre": "';
            } else {
                $bimestre = '"4 Bimestre": "';
            }
            echo $bimestre . 0 . '",';
            $periodocont++;
        }

        if ($contador == $numero) {
            echo '}';
        } else {
            echo '},';
        }
        if ($numero == 0) {
            echo "teste";
        }
        $periodocont = $coluna['bimestre'];
    }


    if ($coluna['bimestre'] == 1) {
        echo '{';
        echo '"categoryTitle": "' . $coluna['nome_disciplina'] . '",';
        echo '"category": "' . $coluna['disciplina'] . '",';
    }

    if ($coluna['bimestre'] == 1) {
        $bimestre = '"1 Bimestre": "';
    } else if ($coluna['bimestre'] == 2) {
        $bimestre = '"2 Bimestre": "';
    } else if ($coluna['bimestre'] == 3) {
        $bimestre = '"3 Bimestre": "';
    } else {
        $bimestre = '"4 Bimestre": "';
    }
    echo $bimestre . number_format((float) $coluna['nota'], 1, '.', '') . '",';


    //SE FOR A ÚLTIMA COLUNA É NECESSÁRIO FECHAR O GRÁFICO
    if ($coluna['bimestre'] == $periodo) {
        if ($contador == $numero) {
            echo '}';
            $boolcontrole = true;
        } else {
            echo '},';
        }
        if ($numero == 0) {
            echo "teste";
        }
    }
    if ($periodocont == $periodo) {
        $periodocont = 0;
    }
    if ($contador == $numero && $boolcontrole == false) {
        echo '}';
    }
}
?>
        ]
    });
    AmCharts.checkEmptyData = function (chart2) {
        if (0 == chart2.dataProvider.length) {


            // add dummy data point
            var dataPoint = {
                dummyValue: 0
            };
            dataPoint[chart2.categoryField] = '';
            chart2.dataProvider = [dataPoint];

            // add label
            chart2.addLabel(0, '50%', 'Não foram encontrados dados com estes filtros', 'center', 35, true);


            // redraw it
            chart2.validateNow();
        }
    }

    AmCharts.checkEmptyData(chart2);


</script>
<!--------------------------------------------------FIM DO SCRIPT QUE FAZ GRÁFICO DE BARRAS------------------------------------------------>
<!----------------------------------------- SCRIPT QUE FAZ O GRÁFICO DE RADAR ------------------------------------------------------------->
<script>
    var chart = AmCharts.makeChart("chartdiv", {
        "type": "radar",
        "theme": "light",
        "dataProvider": [
<?php
$numeroB = count($graficoRadar);
$contadorB = 0;
foreach ($graficoRadar as $coluna) {
    $contadorB++;
    echo '{"categoryTitle": "' . $coluna['nome_disciplina'] . '","category": "' . $coluna['nome_disciplina'] . '",
        "lostAverages": "' . $coluna['medias_perdidas'] . '"';
    if ($contadorB == $numeroB) {
        echo "}";
    } else {
        echo "},";
    }
}
?>
        ],

        "valueAxes": [{
                "axisTitleOffset": 20,
                "minimum": 0,
                "axisAlpha": 0.15
            }],

        "startDuration": 2,
        "graphs": [{
                "balloonText": "[[value]] alunos perderam média nesta disciplina durante o período demarcado",
                "bullet": "round",
                "valueField": "lostAverages"
            }],

        "categoryField": "category",
        "export": {
            "enabled": true
        }
    });
    AmCharts.checkEmptyData(chart);
</script>
<!--// fim do script grafico nota -->
//<!--CONTEÚDO-->
<br><br>
<div class="container-fluid">
    <form method="post" class="col-md-10" action="gerargraficos">
        <select name="curso" class="btn btn-primary" id="botao" required="">
            <option value="" disabled selected hidden>Curso</option>
            <option value="1">Edificações</option>
            <option value="2">Informática</option>
            <option value="3">Mecatrônica</option>
        </select>
        <select name="turma" class="btn btn-primary" id="botao" required="">
            <option value="" disabled selected hidden>Série</option>
            <option value="1">1º Ano Integrado</option>
            <option value="2">2º Ano Integrado</option>
            <option value="3">3º Ano Integrado</option>
            <option value="4">1º Ano Subsequente</option>
            <option value="5">2º Ano Subsequente</option>
        </select>
        <select name="bimestre" class="btn btn-primary" id="botao" required="">
            <option value="" disabled selected hidden>Bimestre</option>
            <option value="1">1º bimestre</option>
            <option value="2">2º bimestre</option>
            <option value="3">3º bimestre</option>
            <option value="4">4º bimestre</option>
        </select>
        <select name="anobase" class="btn btn-primary" id="botao" required="">
            <option value="" disabled selected hidden>Ano Base</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
        </select>
        <input type="submit" class="btn btn-primary" id="botao" value="Gerar gráficos">
    </form><br>
    <br><br>
    <div class="row">
        <div class="col-md-10" id="graf">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-reorder fa-fw"></i> GRÁFICO DE MÉDIAS (FORMATO BARRA)		<br><br>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="chartdiv" id="chartdiv1"></div>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-md-10" id="graf">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-reorder fa-fw"></i> TAREFAS PARA ANÁLISES
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="chartdiv" id="chartdiv"></div>
                    </div>
                </div>
            </div>

        </div>

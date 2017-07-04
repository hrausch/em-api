<br>
<section id="contact" class="section">
    <div class="container">
<h3>Pesquise o histórico de Turmas</h3> <hr>
<form class="form-horizontal" id="formDemanda" method="POST" action="{url}index.php/TurmaHistorico/gerarGraficos" enctype="multipart/form-data" onSubmit="return teste()">
<div id="pergunta_aluno" class="form-group">
 	<div id="pergunta_aluno">
        	<div class="col-sm-2" id="div_pcurso">
        		<select class="form-control" name="curso" id="curso_select" onchange="mudouCurso($(this).val())" required>
                                <option selected disabled>Curso</option>
                                <option value="1">Edificações</option>
                                <option value="2">Informática</option>
                                <option value="3">Mecatrônica</option>
                        </select>
                 </div>
         <div class="col-sm-2" id="div_pturma">
         	<select class="form-control" name="turma" id="turma_select" disabled>
	 	</select>
         </div>
		<div class="col-sm-2" id="div_pbimestre">
        		<select class="form-control" name="bimestre" id="bimestre_select" required>
                                <option selected disabled>Bimestre</option>
                                <option value="1">1º Bimestre</option>
                                <option value="2">2º Bimestre</option>
                                <option value="3">3º Bimetre</option>
                                <option value="4">4º Bimetre</option>
                        </select>
                 </div>
        <div class="col-sm-2" id="div_pAno">
        		<select class="form-control" name="ano" id="ano_select" required>
                                <option selected disabled>Ano-Base</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                        </select>
         </div>
         <div class="col-sm-3">
          <button type="submit" class="btn-block btn-success" id="botaoEnviar" >GERAR DADOS</button>
			</div>
 </div>
</div></form>
</div>
<div id="graficos">

</div>
</section>
<br>

<!-- GRÁFICOS -->

<?php if($resultado != ""){echo $resultado;}?>

<br><br><br>
<!-- SCRIPTS COMUNS -->
<script>
$(document).ready(function () {
      document.getElementById('div_pturma').disabled = true;
});
function mudouCurso(id_curso) {
        $.get("http://localhost/Estagio/workflow-issues-master/index.php/Demanda/buscarTurmas/" + id_curso, function (data) {
            document.getElementById("div_pturma").innerHTML = data;
        });
    }
    
function teste() {
	if(document.getElementById("ano_select").value == "Ano-Base" || document.getElementById("bimestre_select").value == "Bimestre" || document.getElementById("turma_select").value == "" || document.getElementById("turma_select").value == "Turma"){	
	return false;}
	else {
		return true;	
	}	
}

</script>

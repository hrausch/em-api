<br>
<section id="contact" class="section">
    <div class="container">
<h3>Pesquise o histórico de alunos</h3> <hr>
<form class="form-horizontal" id="formDemanda" method="POST" action="{url}index.php/Historico/gerarGraficos" enctype="multipart/form-data">
<div id="pergunta_aluno" class="form-group">
 	<div id="pergunta_aluno">
        	<div class="col-sm-2" id="div_pcurso">
        		<select class="form-control" name="curso" id="curso_select" onchange="mudouCurso($(this).val())">
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
         <div class="col-sm-3" id="div_paluno">
                <select class="form-control" name="aluno_select" id="aluno_select">
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
      document.getElementById('aluno_select').disabled = true;
});
function mudouCurso(id_curso) {
        $.get("http://localhost/Estagio/workflow-issues-master/index.php/Demanda/buscarTurmas/" + id_curso, function (data) {
            document.getElementById("aluno_select").innerHTML = "";
            document.getElementById("div_pturma").innerHTML = data;
            document.getElementById('aluno_select').disabled = true;
        });
    }

    function mudouTurma(id_turma) {
        $.get("http://localhost/Estagio/workflow-issues-master/index.php/Demanda/buscarAlunos/" + id_turma, function (data) {
            document.getElementById('aluno_select').disabled = false;
            document.getElementById("aluno_select").innerHTML = data;
        });
    }
</script>


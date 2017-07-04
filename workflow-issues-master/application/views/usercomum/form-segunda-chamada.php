<section id="contact" class="section">
    <div class="container"><br>
        <h2>2º Segunda Chamada</h2>

        <hr style="color: #000; background-color: #000; height: 3px;">
        <div class="col-md-10 col-md-offset-1 wow fadeInUp" data-wow-delay=".3s">

        <hr>
        <caption>Todos os campos são obrigatórios, exeto o envio de anexo</caption>


            <form class="form-horizontal" id="form-segunda-chamada" method="POST" action="inserirSegundaChamada" enctype="multipart/form-data">

              <div class="form-group">
                  <label for="matricula" class="col-sm-2 control-label">Matrícula*</label>
                  <div class="col-sm-10">
                      <input type="text" name="matricula" class="form-control" id="matricula" required>
                  </div>
              </div>

                <div class="form-group">

                      <label for="nome_alunos" class="col-sm-2 control-label">Disciplina(s)*</label>
                      <div class="col-sm-10">
                        <div id="pergunta_disciplina" class="form-group">
                            <div id="pergunta_disciplina">
                                <div class="col-sm-3" id="div_pcurso">
                                    <select class="form-control" name="curso" id="curso_select" onchange="mudouCurso($(this).val())" required="">
                                        <option selected disabled>Curso</option>
                                        <option value="1">Edificações</option>
                                        <option value="2">Informática</option>
                                        <option value="3">Mecatrônica</option>
                                    </select>
                                </div>
                                <div class="col-sm-3" id="div_pturma">
                                    <select class="form-control" name="turma" id="turma_select" disabled>

                                    </select>
                                </div>
                                <div class="col-sm-3" id="div_pdisciplina">
                                    <select class="form-control" name="disciplina" id="disciplina_select" onchange="selectDisciplina(this);">

                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-5"></div>
                            <ul class="col-sm-7" style="list-style-type: none;" id="ul_2"></ul>
                        </div>
                        <input type="hidden" id="id_disciplina" name="id_disciplina" value="" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="data" class="col-sm-2 control-label">Ausente do dia:* </label>
                    <div class="col-sm-10">
                        <input type="date" name="data" class="form-control" id="data" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="data" class="col-sm-2 control-label">Ao dia:* </label>
                    <div class="col-sm-10">
                        <input type="date" name="data-fim" class="form-control" id="data-fim" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="descricao" class="col-sm-2 control-label">Motivo*</label>
                    <div class="col-sm-10">
                        <textarea name="motivo" id="motivo" class="form-control" rows="3" placeholder="..." required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="anexo" id="arqv" class="col-sm-5 control-label">Arquivo anexo(Ex: Atestado Médico): </label>
                    <div class="col-sm-7">
                        <input type="file" name="anexo" id="anexo" class="form-control">
                    </div>
                </div>
                <input type="hidden" name="validacaoArquivo" id="validacaoArquivo" value="0">
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn-block btn-success" id="botaoEnviar" >Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</section>
<script type="text/javascript">

    function mudouCurso(id_curso) {
        $.get("http://localhost/Estagio/workflow-issues-master/index.php/usercomum/Segundachamada/buscarTurmas/" + id_curso, function (data) {
            document.getElementById("disciplina_select").innerHTML = "";
            document.getElementById("div_pturma").innerHTML = data;
            document.getElementById('disciplina_select').disabled = true;
        });
    }

    function mudouTurma(id_turma) {
        $.get("http://localhost/Estagio/workflow-issues-master/index.php/usercomum/Segundachamada/buscarDisciplina/" + id_turma, function (data) {
            document.getElementById('disciplina_select').disabled = false;
            document.getElementById("disciplina_select").innerHTML = data;
        });
    }

    function selectDisciplina(select) {

        var option = select.options[select.selectedIndex];
        var ul = document.getElementById('ul_2')
        var choices = ul.getElementsByTagName('input');
        for (var i = 0; i < choices.length; i++)
            if (choices[i].value == option.value)
                return;
        var li = document.createElement('li');
        var input = document.createElement('input');
        var text = document.createTextNode(option.firstChild.data);
        input.type = 'hidden';
        input.name = 'disciplina[]';
        input.value = option.value;
        li.appendChild(input);
        li.appendChild(text);
        li.setAttribute('onclick', 'this.parentNode.removeChild(this);');
        li.setAttribute('style', 'background: #BAFF7B url(http://localhost/Estagio/workflow-issues-master/assets/img/demandas/cross_bright.png) no-repeat 98% center; margin: 5px; padding: 0.1em 0.3em;cursor: pointer; color: #000; font-weight: bold; border: solid 1px #000;');
        ul.appendChild(li);

    }
    jQuery("#botaoEnviar").click(function (e) {

                if ($("#anexo").val() !== ""){
                   $("#validacaoArquivo").attr("value", "1");

                }
              });


</script>

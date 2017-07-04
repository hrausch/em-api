<section id="contact" class="section">
    <div class="container">
        <h2>Nova Advertência</h2>

        <hr style="color: #000; background-color: #000; height: 3px;">
        <div class="col-md-10 col-md-offset-1 wow fadeInUp" data-wow-delay=".3s">


            <hr>

            <form class="form-horizontal" id="formAdvertencia" method="POST" action="Adicionaradvertencia/registrarAdvertencia" enctype="multipart/form-data">
                <div class="form-group">

                    <label for="nome_alunos" class="col-sm-2 control-label">Alunos</label>
                    <div class="col-sm-10">

                        <div id="pergunta_aluno" class="form-group">
                            <div id="pergunta_aluno">
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
                                <div class="col-sm-3" id="div_paluno">
                                    <select class="form-control" name="aluno" id="aluno_select" onchange="selectAlunos(this);">

                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-10"></div>
                            <ul class="col-sm-7" style="list-style-type: none;"></ul>
                        </div>
                        <input type="hidden" id="id_aluno" name="id_aluno" value="" required>
                    </div>
                </div>
                <div class="form-group">

                    <label for="prof" class="col-sm-2 control-label">Professor</label>
                    <div class="col-sm-10">

                        <div id="pergunta_prof" class="form-group">
                            <div id="pergunta_prof">

                                <div class="col-sm-3" id="div_pprof">
                                    <select class="form-control" name="id_professor" id="prof_select">
                                        <option selected disabled>Professor</option>

                                        <?php
                                        foreach ($prof as $linha) {
                                            echo "<option value='" . $linha["id_usuario"] . "'>" . $linha['nome'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="disciplina" class="col-sm-2 control-label">Disciplina</label>
                    <div class="col-sm-10"><br>
                        <input type="text" name="disciplina" class="form-control" id="disciplina" placeholder="Banco de Dados" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="data" class="col-sm-2 control-label">Data</label>
                    <div class="col-sm-10">
                        <input type="date" name="data" class="form-control" id="data" required>
                    </div>
                </div>
                <div class="form-group" style=" text-align: justify;">
                    <label for="tipo" class="col-sm-2 control-label">Tipo</label>
                    <div class="col-sm-10">
                        <input  type="radio" name="tipo" id="ha_tipo" value="1" onchange="mudou(1)" required="">Leve<br>
                        <input  type="radio" name="tipo" id="ha_tipo" value="2" onchange="mudou(2)" required="">Grave<br>
                        <input  type="radio" name="tipo" id="ha_tipo" value="3" onchange="mudou(3)" required="s">Gravissíma<br>
                    </div>
                </div>
                <div class="form-group" style=" text-align: justify;" id="tipo_iten">
                    <label for="tipo_iten" class="col-sm-2 control-label">Tipo Advertencia</label>
                    <div class="col-sm-10">
                        <div id="leve" >
                            <input type="checkbox" name='item[]' value='1' >Tem postura indadequada com o ambiente de sala de aula<br><br>
                            <input type="checkbox" name='item[]' value='2'>Uso de vocabulário incoveniente<br><br>
                            <input type="checkbox" name='item[]' value='3'>Não faz os deveres e trabalhos escolares solicitados pelo professor(a)<br><br>
                            <input type="checkbox" name='item[]' value='4'>Não faz anotaçõesa das matérias e não participa das aulas<br><br>
                            <input type="checkbox" name='item[]' value='5'>Compareceu às aulas com vestimenta inadequada: sem uniforme<br><br>
                            <input type="checkbox" name='item[]' value='6'>Manuseio e/ou uso de celular e/ou aparelho eletrônico em sala de aula<br><br>
                            <input type="checkbox" name='item[]' value='7'>Não trouxe o material necessário às aulas<br><br>
                        </div>
                        <div id="grave">
                            <input type="checkbox" name='item[]' value='8'>Tumultua a sala com conversas e brincadeiras, mantendo-se desatento e indiferente às aulas<br><br>
                            <input type="checkbox" name='item[]' value='9'>Ausência em dia de Avaliação/Teste, sem justificativa<br><br>
                            <input type="checkbox" name='item[]' value='10'>Má conservação<br><br>
                            <input type="checkbox" name='item[]' value='11'>Ausência da sala de aula ou da escola sem autorização<br><br>
                        </div>
                        <div id="gravissimo">
                            <input type="checkbox" name='item[]' value='12'>Age com rebeldia, não controla suas ações; grita, é brusco e imprevisível<br><br>
                            <input type="checkbox" name='item[]' value='13'>Falta de respeito com professor(a), não obedece, não cumpre ordens, não aceita conselhos e repreensões<br><br>
                            <input type="checkbox" name='item[]' value='14'>Briga com colegas<br><br>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="descricao" class="col-sm-2 control-label">Ocorrido</label>
                    <div class="col-sm-10">
                        <textarea name="descricao" id="descricao" class="form-control" rows="3" placeholder="Aluno fez tal coisa..." required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="arquivo_anexo" id="arqv" class="col-sm-5 control-label">Arquivo anexo: </label>
                    <div class="col-sm-7">
                        <input type="file" name="arquivo" id="arquivo" class="form-control">
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
    $(document).ready(function () {
        $("#leve").hide();
        $("#grave").hide();
        $("#gravissimo").hide();

    });
    function mudou(valor) {
        if (valor == 1) {
            $("#leve").show();
            $("#grave").hide();
            $("#gravissimo").hide();
        } else if (valor == 2) {
            $("#leve").hide();
            $("#grave").show();
            $("#gravissimo").hide();

        } else if (valor == 3) {
            $("#leve").hide();
            $("#grave").hide();
            $("#gravissimo").show();

        }
    }
    function mudouCurso(id_curso) {
        $.get("http://localhost/Estagio/workflow-issues-master/index.php/Adicionaradvertencia/buscarTurmas/" + id_curso, function (data) {
            document.getElementById("aluno_select").innerHTML = "";
            document.getElementById("div_pturma").innerHTML = data;
            document.getElementById('aluno_select').disabled = true;
        });
    }

    function mudouTurma(id_turma) {
        $.get("http://localhost/Estagio/workflow-issues-master/index.php/Adicionaradvertencia/buscarAlunos/" + id_turma, function (data) {
            document.getElementById('aluno_select').disabled = false;
            document.getElementById("aluno_select").innerHTML = data;
        });
    }



    function selectAlunos(select) {
        var option = select.options[select.selectedIndex];
        var nnn = document.getElementById('pergunta_aluno');
        var ul = nnn.parentNode.getElementsByTagName('ul')[0];
        var choices = ul.getElementsByTagName('input');
        for (var i = 0; i < choices.length; i++)
            if (choices[i].value == option.value)
                return;
        var li = document.createElement('li');
        var input = document.createElement('input');
        var text = document.createTextNode(option.firstChild.data);
        input.type = 'hidden';
        input.name = 'alunos[]';
        input.value = option.value;
        li.appendChild(input);
        li.appendChild(text);
        li.setAttribute('onclick', 'this.parentNode.removeChild(this);');
        li.setAttribute('style', 'background: #BAFF7B url(http://localhost/Estagio/workflow-issues-master/assets/img/adv/cross_bright.png) no-repeat 98% center; margin: 5px; padding: 0.1em 0.3em;cursor: pointer;  color: #000; font-weight: bold; border: solid 1px #000;');
        ul.appendChild(li);
    }

    jQuery("#botaoEnviar").click(function (e) {

        if ($("#arquivo").val() !== "") {
            $("#validacaoArquivo").attr("value", "1");

        }
    });


</script>

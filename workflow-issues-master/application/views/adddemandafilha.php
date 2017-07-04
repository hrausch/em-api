<section id="contact" class="section">
    <div class="container">
        <h2>Formulário resposta</h2>
        <hr style="color: #000; background-color: #000; height: 3px;">
        <div class="col-md-10 col-md-offset-1 wow fadeInUp" data-wow-delay=".3s">

            <?php echo '<form class="form-horizontal" id="formDemanda" method="POST" action="{url}index.php/Demanda/registraFilha/' . $id_demanda . '" enctype="multipart/form-data" onsubmit="return validar()">'; ?>
	<div class="form-group">
                    <label for="destinatarios" class="col-sm-5 control-label">Destinatário(s): *</label>
                    <div class="col-sm-7">
                        <select class="form-control"  id="destinatarios" onchange="selectDestinatarios(this);" required>
                            <option selected disabled>Destinatário(os)</option>
                            <?php
                            foreach ($destinatarios as $opcao) {
                                if ($opcao['nome'] != $usuario) {
                                    echo '<option value="' . $opcao['id_usuario'] . '">' . $opcao['nome'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
  <div class="col-sm-5"></div>
                    <ul class="col-sm-7" style="list-style-type: none;" id="ul_1"></ul>
                </div>
                <hr>
            <div class="form-group">
                <label for="descricao_demanda" class="col-sm-5 control-label">Texto da demanda: *</label>
                <div class="col-sm-7">
                   <?php echo '<textarea name="descricao" id="descricao_demanda" class="form-control" rows="3" required>'.$demandamae[0]["texto"].'</textarea>';?>
                </div>
            </div>
            <hr>
            <div class="form-group">
                    <label for="tipo" class="col-sm-5 control-label">Tipo da demanda: *</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="tipo" id="tipo" required>
                            <option value="0">Outro</option>
                            <option value="1">Solicitação de documentos</option>
                            <option value="2">Solicitação de reunião</option>
                        </select>
                    </div>
                </div>
            <div class="form-group">
                <label for="arquivo_anexo" id="arqv" class="col-sm-5 control-label">Anexar arquivo: </label>
                <div class="col-sm-7">
                    <input type="file" name="arquivo_anexo" id="arquivo" class="form-control">
                </div>
            </div>
            <hr>

            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-5">
                    <button type="submit" class="btn-block btn-success" id="botaoEnviar" >Salvar</button>
                </div>
            </div>
            <br><br><br>
            </form>       
        </div>

    </div>
</section>
<script type="text/javascript">
function selectDestinatarios(select) {
        var option = select.options[select.selectedIndex];
        var ul = document.getElementById('ul_1')
        var choices = ul.getElementsByTagName('input');
        for (var i = 0; i < choices.length; i++)
            if (choices[i].value == option.value)
                return;
        var li = document.createElement('li');
        var input = document.createElement('input');
        var text = document.createTextNode(option.firstChild.data);
        input.type = 'hidden';
        input.name = 'destinatarios[]';
        input.value = option.value;
        li.appendChild(input);
        li.appendChild(text);
        li.setAttribute('onclick', 'this.parentNode.removeChild(this);');
        li.setAttribute('style', 'background: #BAFF7B url(http://localhost/Estagio/workflow-issues-master/assets/img/demandas/cross_bright.png) no-repeat 98% center; margin: 5px; padding: 0.1em 0.3em;cursor: pointer; color: #000; font-weight: bold; border: solid 1px #000;');
        ul.appendChild(li);
    }
     function validar() {
        if (document.getElementsByName('destinatarios[]').length < 1) {
            alert("ESCOLHA PELO MENOS UM DESTINATÁRIO!!!");
            return false;}
     }
</script>



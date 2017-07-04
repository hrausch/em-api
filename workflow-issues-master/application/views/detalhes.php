<section id="detalhes" class="section">
    <div class="container">
        <h2>Detalhes da Advertência</h2>
        <hr>
        <center>
            <table id="table-adv">
                {adv}
                <tr>
                    <th scope="row">Aluno:</th>
                    <td>{aluno}</td>
                </tr>
                <tr>
                    <th scope="row">Disciplina:</th>
                    <td>{disciplina}</td>
                </tr>
                <tr>
                    <th scope="row">Curso/Série:</th>
                    <td>{curso}</td>
                </tr>
                <tr>
                    <th scope="row">Tipo:</th>
                    <td>{tipo}</td>
                </tr>
                <tr>
                    <th scope="row">Item(s):</th>
                    <td>{item}</td>
                </tr>
                <tr>
                    <th scope="row">Data:</th>
                    <td>{data}</td>
                </tr>
                <tr>
                    <th scope="row">Status:</th>
                    <td>{status}</td>
                </tr>
                <tr>
                    <th scope="row">Ocorrido:</th>
                    <td>{descricao}</td>
                </tr>
                {arquivo}
                {cordenacao}
                {/adv}
            </table>
        </center>
        <hr>
        <h3 id="h3-detalhes">Comentários</h3>
        <hr>
        {entrada}
        <table id="table-adv">
            <tr>
                <th scope="row">Usuário:</th>
                <td>{usuario}</td>
            </tr>
            <tr>
                <th scope="row">Data:</th>
                <td>{data_criacao}</td>
            </tr>
            <tr>
                <th scope="row">Comentário:</th>
                <td>{comentario}</td>
            </tr>
            {arquivo}
        </table>
        <hr>
        {/entrada}
        <div class="col-md-6 col-md-offset-3 wow fadeInUp" data-wow-delay=".3s">
            <form class="form-horizontal" id="formComentario" action="{url}index.php/Adicionaradvertencia/registrarComentario/{id}" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="info" class="col-sm-2 control-label no-print">Adicionar comentário</label>
                    <div class="col-sm-10">
                        <textarea name="comentario" id="comentario" class="form-control no-print" rows="3" placeholder="Fazer tal coisa..."></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="arquivo" id="arqv" class="col-sm-2 control-label no-print">Arquivo*</label>
                    <div class="col-sm-10">
                        <input type="file" name="arquivo" id="arquivo" class="form-control no-print">
                        <div id="informacao" class="hidden no-print">Não necessário</div>
                    </div>
                </div>
                <input type="hidden" name="validacaoArquivo" id="validacaoArquivo" value="0">
                <input type="hidden" name="id_advertencia" value={id}>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" id="botaoEnviar" class="btn-block btn-success no-print">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
{modal}
<script>
    jQuery(document).ready(function () {

        jQuery("#botaoEnviar").click(function (e) {
            jQuery("#alerta").attr("class", "hidden");
            jQuery("#control").attr("class", "hidden");
            if ($("#arquivo").val() !== "") {
                $("#validacaoArquivo").attr("value", "1");
            }
        });

        $("#arqv").mouseover(function () {
            $("#informacao").attr("class", "");
        });
        $("#arqv").mouseout(function () {
            $("#informacao").attr("class", "hidden");
        });

        $("#formComentario").validate({
            rules: {
                comentario: "required"
            },
            messages: {
                comentario: "Escreva o comentário"
            }
        });
        jQuery("#formEdita").submit(function (e) {
            var dados = jQuery("#formEdita").serialize();
            jQuery.post("{url}index.php/Adicionaradvertencia/editarAdvertencia/{id}", dados, function (retorno) {
                var retornu = JSON.parse(retorno);
                if (retornu.validacao) {
                    if (!retornu.erro) {
                        //linha importante!
                        window.location.reload();
                    } else {

                    }
                } else {

                }
            });
            return false;
        });

    });
</script>

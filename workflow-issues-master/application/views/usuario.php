<div class="" id="geral">
    <section id="usuario" class="section">
        <div class="container">
            <h2>Detalhes do seu usuário</h2>
            <hr>
            <div class="col-md-6 col-md-offset-3 wow fadeInUp" data-wow-delay=".3s">
                <form class="form-horizontal" id="formUsuario" method="POST">
                    <div class="form-group">
                        <label for="usu" class="col-sm-2 control-label">Usuário</label>
                        <div class="col-sm-10">
                            <input type="text" name="login" id="login" class="form-control" value="{login}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="usu" class="col-sm-2 control-label">Nome</label>
                        <div class="col-sm-10">
                            <input type="text" name="nome" id="nome" class="form-control" value="{nome}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="usu" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" id="email" class="form-control" value="{email}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn-block btn-success">Salvar</button>
                            <button type="button" id="botaoSenha" class="btn-block btn-info">Alterar Senha</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <br><br>
</div>

<div class="hidden" id="senha">
    <section id="usuario" class="section">
        <div class="container">
            <h2>Alterar sua senha</h2>
            <hr>
            <div class="col-md-6 col-md-offset-3 wow fadeInUp" data-wow-delay=".3s">
                <form class="form-horizontal" id="formSenha" method="POST">
                    <div class="form-group">
                        <label for="senhaAtual" class="col-sm-2 control-label">Senha atual</label>
                        <div class="col-sm-10">
                            <input type="password" name="senhaAtual" id="senhaAtual" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="senhaNova" class="col-sm-2 control-label">Senha nova</label>
                        <div class="col-sm-10">
                            <input type="password" name="senha" id="senha" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirmacao" class="col-sm-2 control-label">Confirmação</label>
                        <div class="col-sm-10">
                            <input type="password" name="confirmacao" id="confirmacao" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn-block btn-success">Salvar</button>
                            <button type="button" id="botaoVoltar" class="btn-block btn-warnig">Voltar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <br><br><br><br>
</div>

<div class="modal fade" id="modalStatus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">titulo</h4>
            </div>
            <div class="modal-body">
                corpo
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-success"><i class="fa fa-check"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        jQuery("#botaoSenha").click(function (e) {
            jQuery("#geral").attr("class", "hidden");
            jQuery("#senha").attr("class", "");
        });

        jQuery("#botaoVoltar").click(function (e) {
            jQuery("#senha").attr("class", "hidden");
            jQuery("#geral").attr("class", "");
        });

        $('#modalStatus').on('hidden.bs.modal', function () {
            window.location.reload();
        });

        jQuery("#formUsuario").submit(function (e) {
            var dados = jQuery("#formUsuario").serialize();
            jQuery.post("{url}index.php/Usuario/alterarInformacoes", dados, function (retorno) {
                var retorno = JSON.parse(retorno);
                if (!retorno.erro) {
                    jQuery("#modalStatus").find(".modal-title").html("Sucesso!");
                    jQuery("#modalStatus").find(".modal-body").html(retorno.msg);
                    jQuery("#modalStatus").modal("show");
                } else {
                    jQuery("#modalStatus").find(".modal-title").html("Erro!");
                    jQuery("#modalStatus").find(".modal-body").html(retorno.msg);
                    jQuery("#modalStatus").modal("show");
                }
            });
            return false;
        });

        jQuery("#formSenha").submit(function (e) {
            var dados = jQuery("#formSenha").serialize();
            jQuery.post("{url}index.php/Usuario/alterarSenha", dados, function (retorno) {
                var retorno = JSON.parse(retorno);
                if (!retorno.erro) {
                    jQuery("#modalStatus").find(".modal-title").html("Sucesso!");
                    jQuery("#modalStatus").find(".modal-body").html(retorno.msg);
                    jQuery("#modalStatus").modal("show");
                } else {
                    jQuery("#modalStatus").find(".modal-title").html("Erro!");
                    jQuery("#modalStatus").find(".modal-body").html(retorno.msg);
                    jQuery("#modalStatus").modal("show");
                }
            });
            return false;
        });
    });
</script>


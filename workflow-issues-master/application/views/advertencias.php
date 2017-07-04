<section id="advertencias" class="section">
    <div class="container">
        <h2>{titulo}</h2><br />
        <button type="button" id="printer"><i class="fa fa-print" aria-hidden="true"></i></button>
        <a id="botao" class="btn btn-primary" href="{url}index.php/Adicionaradvertencia" >Adicionar Advertencia</a></li></th><br />
        <hr>
        <form id="formImprimir" action="{url}index.php/Imprimir/imprimir" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th>Aluno</th>
                        <th>Disciplina</th>
                        <th>Curso/Série</th>
                        <th>Tipo</th>
                        <th>Status</th>
                        <th>Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                    {entrada}
                    <tr>
                        <td><input type="checkbox" class="hidden imprimir" id="imprimir" name="imprimir[]" value="{id}"><a href="{url}index.php/Alunos/advertencias/{id_aluno}" id="link-aluno">{aluno}</a></td>
                        <td>{disciplina}</td>
                        <td>{curso}</td>
                        <td>{tipo}</td>
                        <td>{status}</td>
                        <td><a href="{url}index.php/Adicionaradvertencia/detalhes/{id}" class="btn btn-default"><i class="fa fa-info-circle"></i></a></button></td>
                    </tr>
                    {/entrada}
                </tbody>
            </table>
            <div id="oculta" class="hidden">
                <button type="submit" class="btn btn-success" id="impri">Imprimir</button>
                <button type="button" class="btn btn-danger" id="cancelar">Cancelar</button>
            </div>
        </form>
    </div>
</section>

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
    jQuery(document).ready(function () {
        var estado = 0;
        jQuery("#printer").click(function () {
            if (estado === 0) {
                jQuery(".imprimir").attr("class", "imprimir");
                jQuery("#oculta").attr("class", "");
                jQuery(".imprimir").after(" ");
                estado = 1;
            } else {
                jQuery(".imprimir").attr("class", "hidden imprimir");
                jQuery("#oculta").attr("class", "hidden");
                jQuery(".imprimir").after("");
                estado = 0;
            }
        });

        jQuery("#cancelar").click(function () {
            jQuery(".imprimir").attr("class", "hidden imprimir");
            jQuery("#oculta").attr("class", "hidden");
            jQuery(".imprimir").after("");
            estado = 0;
        });

        jQuery("#formImprimir").submit(function () {
            if ($(".imprimir").is(':checked')) {
                return true;
            } else {
                jQuery("#modalStatus").find(".modal-title").html("Erro!");
                jQuery("#modalStatus").find(".modal-body").html("Selecione ao menos uma advertência para imprimir");
                jQuery("#modalStatus").modal("show");
                return false;
            }
        });

    });
</script>

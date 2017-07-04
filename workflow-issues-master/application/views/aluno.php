<section id="contact" class="section">
    <div class="container">
        <h2>Buscar Aluno</h2>
        <hr>
        <form class="form-horizontal" id="formAlunos">
            <div class="hidden" id="control">
                <div class="hidden" id="alerta"></div>
            </div>
            <div class="form-group">
                <label for="curso" class="col-sm-2 control-label">Curso</label>
                <div class="col-sm-4">
                    <select class="form-control" name="curso" id="curso">
                        <option value="nulo"></option>
                        <option value="1">Edificações </option>
                        <option value="2">Informática</option>
                        <option value="3">Mecatrônica </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="turma" class="col-sm-2 control-label">Turma</label>
                <div class="col-sm-4">
                    <select class="form-control" name="turma" id="turma" disabled>
                        <option value="nulo"></option>
                        <option value="1">1º - Integrado</option>
                        <option value="2">2º - Integrado</option>
                        <option value="3">3º - Integrado</option>
                        <option value="4">1º - Subsequente</option>
                        <option value="5">2º - Subsequente</option>
                    </select>
                </div>
            </div>
        </form>
        <div id="select-alunos" class="hidden">
            <table class="table" id="tabela-alunos">
                <tr>
                    <th id="principal">Aluno</th>
                    <th id="principal">Detalhes</th>
                </tr>
            </table>
        </div>
    </div>
</section>

<script>
    jQuery(document).ready(function () {

        var valor = null;
        var qtd = null;

        jQuery("#curso").change(function () {
            valor = $(this).val();
            jQuery("#turma").prop('selectedIndex', 0);
            if (valor !== "nulo") {
                jQuery("#turma").removeAttr("disabled");
            } else {
                jQuery("#turma").attr("disabled", true);
                jQuery("#select-alunos").attr("class", "hidden");
                jQuery("#turma").prop('selectedIndex', 0);
            }
            for (i = 0; i < qtd; i++) {
                var par = $("#linha"); //tr
                par.remove();
            }
            qdt = 0;
        });


        jQuery("#turma").change(function () {
            var turma = jQuery(this).val();
            if (valor !== "nulo" && turma !== "nulo") {
                jQuery.get("{url}index.php/Adicionaradvertencia/obterAlunos/" + valor + "-" + turma, function (retorno) {
                    var retorno = JSON.parse(retorno);
                    if (retorno) {
                        for (i = 0; i < retorno.qtd; i++) {
                            var newRow = $("<tr id='linha'>");
                            var cols = "";
                            cols += '<td>' + retorno.resultado[i].nome + '</td>';
                            cols += "<td><a href='{url}index.php/Alunos/advertencias/" + retorno.resultado[i].id_aluno + "' class='btn btn-default'><i class='fa fa-info-circle'></i></a></button></td>";
                            newRow.append(cols);
                            $("#tabela-alunos").append(newRow);
                            qtd++;
                        }

                    }
                });
                jQuery("#select-alunos").attr("class", "");
                jQuery("#curso").prop('selectedIndex', 0);
                jQuery("#turma").attr("disabled", true);
                jQuery("#turma").prop('selectedIndex', 0);
            } else {
                jQuery("#select-alunos").attr("class", "hidden");
            }
        });

    });
</script>
<br><br>

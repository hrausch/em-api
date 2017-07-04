<section id="segunda-chamada" class="section">
    <div id="container" style="margin-left: 20px; margin-right: 20px;">
        <center><h2>2º Chamada</h2></center>
        <br><br>
                <?php
                $t=$tipo[0]['id_tipo_usuario'];

                if($t == 1 || $t == 2){
                if ($pedido_recebido != NULL) {
                  echo '<table class="table" id="tabela">
                      <caption>LISTA DE PEDIDOS</caption>
                        <thead>
                            <tr>
                            <th>Nome do Aluno</th>
                            <th>Disciplina</th>
                            <th>Ausente do dia:</th>
                            <th>Ao dia:</th>
                            <th>Data do Pedido</th>
                            <th>Situação</th>
                            <th>Detalhes</th>
                            </tr>
                          </thead>
                          <tbody>' . $pedido_recebido. '</tbody></table>';
                } else {
                    echo '<h3> Não há nenhum pedido para ser listado';
                }
              }else{
                echo '<h3> Você não pode ver os dados desta página';

              }
                ?>
            </tbody>
        </table>
    </div>
</section>


    </div>
    <br><br>

</section>

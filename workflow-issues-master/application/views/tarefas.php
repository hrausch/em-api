<section id="tarefas" class="section">
    <div id="container" style="margin-left: 20px; margin-right: 20px;">
        <center><h2>Tarefas Pendentes</h2></center>
        <br><br>
                <?php
                $t=$tipo[0]['id_tipo_usuario'];

                if ($tarefa_recebida != NULL) {
                  echo '<table class="table" id="tabela">
                      <caption>LISTA DE PEDIDOS DE SEGUNDA CHAMADA</caption>
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
                          <tbody>' . $tarefa_recebida. '</tbody></table>';
               } else {
                    echo '<h3> Não há nenhum pedido para ser listado';
                }
                if ($demandas_recebidas != NULL) {
                    echo '<table class="table" id="tabela">
                   			<caption>LISTA DE DEMANDAS</caption>
                        	<thead>
                            	<tr>
                                	<th>De</th>
                                	<th>Para</th>
                                	<th>Tipo</th>
                                	<th>Data da demanda</th>
                                	<th>Última interação</th>
                                	<th>Situação</th>
                                	<th>Detalhes</th>
                            	</tr>
                        		</thead>
                        		<tbody>' . $demandas_recebidas . '</tbody></table>';
                } else {
                    echo '<h3> Não há nenhuma demanda para ser listada';
                }
                ?>
            </tbody>
        </table>
    </div>
</section>


    </div>
    <br><br>

</section>

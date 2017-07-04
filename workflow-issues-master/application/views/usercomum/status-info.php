<section id="info" class="section">
    <div class="container">
      <center><br>
        <h2>Informações do Pedido</h2>
        <hr>
        <?php
        if ($info_recebida != NULL) {
          echo '<table class="table" id="tabela">
              <caption>LISTA DE PEDIDOS DE SEGUNDA CHAMADA FEITOS POR VOCÊ.<br> CASO ALGUM ESTEJA DEFERIDO, ENTRE EM CONTATO COM SEU PROFESSOR PARA SABER A DATA EM QUE SERÁ REALIZADO
                <br>Obs.: Pedidos indeferidos podem ser encaminhados ao colegiado, entre em contato com o coordnador de seu curso caso seja o caso.
              </caption>
                <thead>
                    <tr>
                    <th>Nome do Aluno</th>
                    <th>Disciplina</th>
                    <th>Ausente do dia</th>
                    <th>Ao dia</th>
                    <th>Data do Pedido</th>
                    <th>Situação</th>
                    </tr>
                  </thead>
              <tbody>' . $info_recebida. '</tbody></table>

                </thead>
          </table>';
        } else {
            echo '<h3> Seu pedido de segunda chamada não foi encontrado';
        }
        ?>
        </center>
        <hr>

    </div>
</section>

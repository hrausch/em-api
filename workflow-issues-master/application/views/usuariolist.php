<section id="advertencias" class="section">
    <div class="container">
        <h2>Usuários</h2><br />
        <a id="botao" class="btn btn-primary" href="{url}index.php/Cadastro" >Cadastrar Usuário</a></li><br />
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Login</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($usuarios as $usuario) {
                    echo "<tr>";
                    echo "<td>" . $usuario->nome . "</td>";
                    echo "<td>" . $usuario->email . "</td>";
                    echo "<td>" . $usuario->login . "</td>";
                    echo "<td>";

                    foreach ($tipo as $t) {
                      if($t->id_usuario==$usuario->id_usuario){
                        echo " | ".  $t->id_tipo_usuario. " | ";
                      }
                    }
                    echo "</td>";

                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>
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

        </div>
    </div>
</div>
<div class="alert alert-info" role="alert">LEGENDA (Tipo usuário): 1-Administrador / 2-Coordenador / 3-CP / 4-CPE / 5-Professores  </div>

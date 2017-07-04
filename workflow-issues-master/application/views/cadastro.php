
<br>
<section id="contact" class="section">
    <div class="container">
        <div class="col-md-10 col-md-offset-1 wow fadeInUp" data-wow-delay=".3s">
            <div class="panel panel-default" >
                <div class="panel-heading">
                    <h2>Cadastrar Usuário</h2>
                    <hr style="color: #000; background-color: #000; height: 3px;">
                    <div class="col-md-10 col-md-offset-1 wow fadeInUp" data-wow-delay=".3s">
                    </div>
                    <div class="panel-body" >

                        <form class="form-horizontal" name="formCadastro" id="formCadastro"  enctype="multipart/form-data" method="POST" action="{url}index.php/Cadastro/cadastrar">
                            <div class="col-sm-10">

                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                    <input id="nome" type="text" class="form-control" name="nome" placeholder="Nome" required="">
                                </div><br>

                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input id="email" type="text" class="form-control" name="email" placeholder=" E-mail"required="">
                                </div><br>

                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input id="login" type="text" class="form-control" name="login" placeholder="Usuário" required="">
                                </div><br>

                                <div class="dropdown">
                                    <label class="input-group">Tipo Usuário:</label>

                                    <input type="checkbox" name='tipo[]' value='1' >Administrador<br><br>
                                    <input type="checkbox" name='tipo[]' value='2'>Coordenador<br><br>
                                    <input type="checkbox" name='tipo[]' value='3'>CP<br><br>
                                    <input type="checkbox" name='tipo[]' value='4'>CPE<br><br>
                                    <input type="checkbox" name='tipo[]' value='5'>Professor<br><br>


                                </div>
                                <br>

                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                                    <select class="form-control" name="curso" id="curso_select">
                                                        <option selected disabled>Curso em que o usuário está envolvido</option>
                                                        <option value="1">Edificações</option>
                                                        <option value="2">Informática</option>
                                                        <option value="3">Mecatrônica</option>
                                                        <option value="4">Todos</option>
                                                        <option value="5">Nenhum</option>

                                                </select>


                                </div>
                                <br>

                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input id="senha" type="password" class="form-control" name="senha" placeholder="Senha" required="">
                                </div><br>


                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input id="confirma" type="password" class="form-control" name="confirma" placeholder="Confirmar Senha" required="">
                                </div><br>


                                <div class="form-group">
                                    <!-- Button -->
                                    <div class="col-sm-12 controls">
                                        <center>
                                            <button type="submit" id="botao" href="#" class="btn btn-primary"><i class="fa fa-sign-in"></i> Cadastrar</button>
                                            <a id="botao" class="btn btn-primary" href="{url}index.php/Usuario/listarUsuario" >Cancelar</a></li></th><br />

                                        </center>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
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

    <div id="particles"></div>
</section>




<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{url}/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="{url}/assets/js/login.js"></script>
<script src="{url}/assets/js/login_controller.js"></script>
<script>
    //VALIDA SE AS SENHAS CONFEREM
    var password = document.getElementById("senha")
    var confirm_password = document.getElementById("confirma");
    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Senhas diferentes!");
        } else {
            confirm_password.setCustomValidity('');
        }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>

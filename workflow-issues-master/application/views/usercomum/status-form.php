<div class="container">

    <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">

        <br><br>

        <div class="panel panel-default"  >
            <div class="panel-heading" >
                <div class="panel-title text-center">Verifique o Status do seu pedido</div>
            </div>

            <div class="panel-body" >

                <form name="form" id="form" action="{url}index.php/usercomum/Segundachamada/verifcaStatus"  class="form-horizontal" enctype="multipart/form-data" method="POST">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input id="matricula" type="text" class="form-control" name="matricula" placeholder="Matrícula">
                    </div>
                    <br>
                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <center>
                                <button style="background: #17578c" type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Ver</button>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
          </div>
</div>

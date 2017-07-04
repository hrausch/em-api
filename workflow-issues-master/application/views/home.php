<!DOCTYPE html>
<html id="html">

    <head>

        <meta http-equiv="content-type" content="text/html; charset=UTF-8">

        <title>{title}</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Icon -->

        <link rel="icon" type="image/png" href="{url}assets/img/icone.png">

        <!-- Bootstrap Css -->
        <link href="{url}assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Print Css -->
        <link rel="stylesheet" type="text/css" href="{url}assets/css/print.css" media="print" />

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <!-- Plugin -->
        <link href="{url}assets/plugins/tags/jquery.tag-editor.css" rel="stylesheet">
        <script src="{url}assets/plugins/jquery-validation/dist/jquery.validate.min.js" rel="stylesheet"></script>
        <script src="{url}assets/plugins/jquery-validation/dist/additional-methods.js" rel="stylesheet"></script>
        <script src="{url}assets/js/jquery.tablesorter.js"  rel="stylesheet"></script>

        <!-- Style -->
        <link href="{url}assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
        <link href="{url}assets/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
        <link href="{url}assets/plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
        <link href="{url}assets/plugins/Lightbox/dist/css/lightbox.css" rel="stylesheet">
        <link href="{url}assets/plugins/Icons/et-line-font/style.css" rel="stylesheet">
        <link href="{url}assets/plugins/animate.css/animate.css" rel="stylesheet">
        <link href="{url}assets/css/style.css" rel="stylesheet">
        <link href="{url}assets/css/estilo.css" rel="stylesheet">
        <link href="{url}assets/css/sb-admin-2.css" rel="stylesheet">
        <!--Graficos-->
        <script src="{url}assets/amcharts/amcharts.js"></script>
        <script src="{url}assets/amcharts/radar.js"></script>
        <script src="{url}assets/amcharts/serial.js"></script>
        <script src="{url}assets/amcharts/themes/light.js"></script>


        <!-- Custom Fonts
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">-->

        <script src="{url}assets/jquery/jquery-1.11.3.min.js"></script>
        <!-- Icons Font -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body id="html">
        <!-- Preloader
            ============================================= -->
        <div class="preloader"><i class="fa fa-circle-o-notch fa-spin fa-2x"></i></div>
        <!-- Header
            ============================================= -->
        <section class="main-header">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacao" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <ul class="nav navbar-nav">
                            <li><a href="{url}">Início</a></li>
                        </ul>
                    </div>
                    <div class="collapse navbar-collapse text-center" id="navegacao">
                        <div class="col-md-10 col-xs-16 nav-wrap" style="padding-left: 115px;">
                            <ul class="nav navbar-nav">
                                 <li><a href="{url}index.php/Usuario/listarUsuario" class="page-scroll">Usuários</a></li>
                                  <!--<li><a href="{url}index.php/Alunos" class="page-scroll">Alunos</a></li>-->

                            </ul>
                        </div>
                        <div class="">
                            <ul class="nav navbar-nav">
                                <li><a href="{url}index.php/Usuario"><i class="fa fa-user"></i> {usuario}</a></li>
                                <li><a href="{url}index.php/Login/sair"><i class="fa fa-sign-out"></i> Sair</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

        </section>

        <!-- Section
            ============================================= -->
        {section}
        <br><br>

        <!-- Footer
            ============================================= -->
        <footer id="footer">
            <div class="container">
                <h6>Desenvolvido por CEFET-MG Unidade Varginha - Departamento de Computação e Engenharia Civil 2016</h6>
            </div>
        </footer>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{url}assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="{url}assets/js/custom.js"></script>
        <!-- JS PLUGINS -->
        <script src="{url}assets/plugins/tags/jquery.tag-editor.min.js"></script>
        <script src="{url}assets/plugins/owl-carousel/owl.carousel.min.js"></script>
        <script src="{url}assets/js/jquery.easing.min.js"></script>
        <script src="{url}assets/plugins/countTo/jquery.countTo.js"></script>
        <script src="{url}assets/plugins/inview/jquery.inview.min.js"></script>
        <script src="{url}assets/plugins/Lightbox/dist/js/lightbox.min.js"></script>
        <script src="{url}assets/plugins/WOW/dist/wow.min.js"></script>

        <script>
            $(document).ready(function () {

                if ($("#html").height() < $(window).height()) {
                    $("#footer").addClass("fixed");
                } else {
                    $("#footer").removeClass("fixed");
                }
            });
        </script>
    </body>
</html>

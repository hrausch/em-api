jQuery(document).ready(function () {
    
    jQuery("#botaoEnviar").click(function (e) {
        jQuery("#alerta").attr("class", "hidden");
        jQuery("#control").attr("class", "hidden");
    });
    
    jQuery("#formAdvertencia").submit(function (e) {
        var dados = jQuery("#formAdvertencia").serialize();
        jQuery.post("Home/registrarAdvertencia", dados, function (retorno) {
            var retorno = JSON.parse(retorno);
            if (retorno.validacao) {
                if (!retorno.erro) {
                    //linha importante!
                    window.location.href = "http://localhost/breno/HTML5Application/nbproject/public_html/Advertencia/index.php/Home/advertencias";
                } else {
                    jQuery("#alerta").attr("class", "alert alert-danger");
                    jQuery("#control").attr("class", "form-group");
                    jQuery("#alerta").html(retorno.msg);
                }
            } else {
                jQuery("#alerta").attr("class", "alert alert-warning");
                jQuery("#control").attr("class", "form-group");
                jQuery("#alerta").html(retorno.msg);
            }
        });
        return false;
    });
    
});
jQuery(document).ready(function () {

    jQuery("#form").submit(function (e) {
        var dados = jQuery("#form").serialize();
        jQuery.post("index.php/Login/fazerLogin", dados, function (retorno) {
            var retorno = JSON.parse(retorno);
            if (!retorno.erro) {
                window.location.reload();
            } else {
                jQuery("#modalStatus").find(".modal-title").html("Erro!");
                jQuery("#modalStatus").find(".modal-body").html(retorno.msg);
                jQuery("#modalStatus").modal("show");
            }
        });
        return false;
    });
});


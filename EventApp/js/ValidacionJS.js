
function validarText(id) {
    if ($("#" + id).val() === null || $("#" + id).val() === "")
    {
        var div = $("#" + id).closest("div");
        div.removeClass("has-success");
        $("#glypcn" + id).remove();
        div.addClass("has-error has-feedback");
        div.append(' <span id="glypcn' + id + '" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>');
        return false;
    } else {
        var div = $("#" + id).closest("div");
        div.removeClass("has-error");
        div.addClass("has-success has-feedback");
        $("#glypcn" + id).remove();
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>');
        return true;
    }
}
;

function validarNumeros(id) {
    var dato = $("#" + id).val();
    if (isNaN(dato) || dato === "" || dato === null) {
        var div = $("#" + id).closest("div");
        div.removeClass("has-success");
        $("#glypcn" + id).remove();
        div.addClass("has-error has-feedback");
        div.append(' <span id="glypcn' + id + '" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>');
		return false;
    } else {
        var div = $("#" + id).closest("div");
        div.removeClass("has-error");
        div.addClass("has-success has-feedback");
        $("#glypcn" + id).remove();
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>');
		 return true;
    }
}
;

function validarLogitudTEXTO(id, minimo) {
    var dato = $("#" + id).val();
    if (dato.length < minimo) {
        var div = $("#" + id).closest("div");
        div.removeClass("has-success");
        $("#glypcn" + id).remove();
        div.addClass("has-error has-feedback");
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>');
		return false;
    } else {
        var div = $("#" + id).closest("div");
        div.removeClass("has-error");
        div.addClass("has-success has-feedback");
        $("#glypcn" + id).remove();
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>');
		 return true;
    }
}
;

function validarEmail(id) {
    var dato = $("#" + id).val();
    var expre = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;

    if (!expre.test(dato)) {
        var div = $("#" + id).closest("div");
        div.removeClass("has-success");
        $("#glypcn" + id).remove();
        div.addClass("has-error has-feedback");
        div.append(' <span id="glypcn' + id + '" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>');
		return false;
    } else {
        var div = $("#" + id).closest("div");
        div.removeClass("has-error");
        div.addClass("has-success has-feedback");
        $("#glypcn" + id).remove();
        div.append('<span id="glypcn' + id + '" class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>');
		 return true;
    }

}
;


function alerta(rpta) {

    var alerta = document.getElementById("cpalerta");
    alerta.style.display = "block";

    if (rpta === true) {
        var div = $("#cpalerta").closest("div");
        div.removeClass("alert alert-danger");
        div.addClass("alert alert-success");
        $("#textAlertaBIEN").remove();
        $("#textAlertaMAL").remove();
        div.append('<center id="textAlertaBIEN">Se validó y envió correctamente la consulta</center>');
    } else {
        var div = $("#cpalerta").closest("div");
        div.removeClass("alert alert-success");
        div.addClass("alert alert-danger");
        $("#textAlertaMAL").remove();
        $("#textAlertaBIEN").remove();
        div.append('<center id="textAlertaMAL">Error al enviar la consulta, por favor verifique sus datos</center>');
    }
}
;






'use strict';  

angular.module('AppEvent')

	.controller('CTRLcertificacion',function($scope,$location,$http,$window){



	})

        // .filter('startFrom', function() {
        //     return function(input, start) {
        //         start = +start; //parse to int
        //         return input.slice(start);
        //     }
        // });


function alertaRegistro(rpta, tipo, smsSuccess, smsError) {

    var alerta = document.getElementById(tipo);
    alerta.style.display = "block";

    if (rpta === true) {
        var div = $("#" + tipo).closest("div");
        div.removeClass("alert alert-danger");
        div.addClass("alert alert-success");
        $("#textAlertaBIEN").remove();
        $("#textAlertaMAL").remove();
        div.append('<center id="textAlertaBIEN">"' + smsSuccess + '"</center>');        
    } else {
        var div = $("#" + tipo).closest("div");
        div.removeClass("alert alert-success");
        div.addClass("alert alert-danger");
        $("#textAlertaMAL").remove();
        $("#textAlertaBIEN").remove();
        div.append('<center id="textAlertaMAL">"' + smsError +'"</center>');
    }
};

function ocultarAlertaCategoria(){
      var alerta = document.getElementById("cpalertaRegistroCategoria");
    alerta.style.display = "none";  
};
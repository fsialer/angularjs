'use strict';  

angular.module('AppEvent')

	.controller('CTRLregAsistente',function($scope,$location,$http,$window){

        $scope.pnlTablaEvento = true;


        $scope.pnlResultadoBusquedaAsistente = false;
        $scope.pnlFormularioRegistroAsistente = false; 
        $scope.pnlListadoAsistente = false;



        $scope.llamarTablaRegistroAsistente = function(valor){
            $scope.tituloRegistroAsistencia = "Registro de Asistentes al Evento"
            $scope.pnlTablaEvento = !valor;           
            $scope.pnlTablaRegistroAsistencias = valor;    

            $scope.pnlFormularioRegistroAsistente = !valor;
            $scope.pnlResultadoBusquedaAsistente = !valor;       
            $scope.pnlListadoAsistente = !valor;

        }

        $scope.buscarAsistente = function(valor){
            $scope.tituloResultadoBusqueda = "Resultado de la Busqueda"
            $scope.pnlResultadoBusquedaAsistente = valor;
            $scope.pnlFormularioRegistroAsistente = !valor;
            $scope.pnlListadoAsistente = !valor;            
        }


        $scope.LlamarRegistroNuevoAsistente = function(valor){
            $scope.tituloRegistroAsis = "Registra un nuevo Asistente"
            $scope.pnlFormularioRegistroAsistente = valor;
            $scope.pnlResultadoBusquedaAsistente = !valor;       
            $scope.pnlListadoAsistente = !valor;               
        }

        $scope.LlamarlistadoAsistente = function(valor){
           $scope.tituloListadoAsistentes = "Listado de Asistentes Confirmados"
           $scope.pnlListadoAsistente = valor;
           $scope.pnlFormularioRegistroAsistente = !valor;
           $scope.pnlResultadoBusquedaAsistente = !valor;                        
        }        

	})

        .filter('startFrom', function() {
            return function(input, start) {
                start = +start; //parse to int
                return input.slice(start);
            }
        });


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
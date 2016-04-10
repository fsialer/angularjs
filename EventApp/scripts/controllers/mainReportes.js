'use strict';  

angular.module('AppEvent')

	.controller('CTRLreportes',function($scope,$location,$http,$window){

        $scope.visible = false;
        $scope.pnlTabla = true;
        $scope.pnlFormulario = false;            


        $scope.llamarformulario = function(valor){
          $scope.tituloFormulario = "Registro del Participante";
          $scope.pnlFormulario = valor;
          $scope.visible = valor;
          $scope.pnlTabla = !valor;          
          $scope.btnRegistrar = valor;
          $scope.btnEditar = !valor;

        }

        $scope.mostrarFrmEditar = function(valor){
          $scope.tituloFormulario = "Modificar los Datos del Participante";
          $scope.pnlTabla = !valor; 
          $scope.visible = valor;
          $scope.pnlFormulario = valor;
          $scope.btnRegistrar = !valor;
          $scope.btnEditar = valor;
        }


        $scope.registrarParticipante = function(){
          alert("VOY A REGISTRAR");
        }

        $scope.editarParticipante = function(){
          alert("VOY A EDITAR");
        }

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
'use strict';  

angular.module('AppEvent')

  .controller('CTRLverifiacionUser', 

    function($scope,$location,$http,$window,$cookieStore){

        $cookieStore.remove("estadoConexion");
        $cookieStore.remove("usuario");
        $cookieStore.remove("tipo");              

        // $scope.listausuarios = [];

        // $http.get('http://localhost:8090/MIS PROYECTOS_BUPLA/SystemENCRIP/controller-be/mainUsuario.php?accion=listarUsuarios').success(function(data)
        // {
        //     $scope.listausuarios = data;            
        // });          

        $scope.evaluarUserPass = function(){
     
            var nomUser = null;
            var tipoUser = null;

            if($scope.userInfo != null && $scope.passwordInfo != null){

                for (var i = 0; i < $scope.listausuarios.length; i++) {
                    if($scope.userInfo == $scope.listausuarios[i]['tbUserS_user'] && $scope.passwordInfo == $scope.listausuarios[i]['tbUserS_password'] && $scope.listausuarios[i]['tbUserS_estado'] == "Activo"){

                        nomUser = $scope.listausuarios[i]['tbUserS_nombreApe'];
                        tipoUser =  $scope.listausuarios[i]['tbUserS_tipo'];                                                                                       

                        $cookieStore.put('estadoConexion', true);
                        $cookieStore.put('usuario', nomUser);
                        $cookieStore.put('tipo', tipoUser);                        

                        $location.path('/Fichas_de_examenes');
                        window.location.href = 'index.html';

                        alertaRegistro(true, "cpalertaVerificacion", "Sr(a): "+ nomUser +" - BIENVENIDO AL SISTEMA SIENCO.", "¡¡¡ LO SENTIMOS !!! El inicio de sesión no es válido." );                                                                      
                    }else{
                        alertaRegistro(false, "cpalertaVerificacion", "BIENVENIDO AL SISTEMA SIENCO.", "¡¡¡ LO SENTIMOS !!! El inicio de sesión no es válido porque su cuenta a sido desactivada." );                        
                    }
                }
            }else{
               alertaRegistro(false, "cpalertaVerificacion", "BIENVENIDO AL SISTEMA SIENCO.", "¡¡¡ ERROR DE ACCESO !!! Ingrese su usuario y contraseña para acceder al sistema." );                         
            }
        };      

        $scope.ocultarAlertaVeri = function(){            
            ocultarAlertaVeCLI();            
        }; 

        $scope.limpiar = function(){
            $scope.userInfo = null;
            $scope.passwordInfo = null;
        }; 
  })


 


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



function ocultarAlertaVeCLI(){
      var alerta = document.getElementById("cpalertaVerificacion");
    alerta.style.display = "none";  
};




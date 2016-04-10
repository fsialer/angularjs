'use strict';  

angular.module('AppEvent')

	.controller('CTRLparticipante',function($scope,$location,$http,$window){

        $scope.visible = false;
        $scope.pnlTabla = true;
        $scope.pnlFormulario = false;            
        $scope.campoBuscar = "*";


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

        /* VARIABLES PARA LA PAGINACIÓN*/
        $scope.currentPage = 0;
        $scope.pageSize = 5;
        $scope.particiantes = [];         


        $http.get('http://localhost:8090/MIS PROYECTOS_BUPLA/EventApp/controller-be/mainParticipante.php?accion=listarParticipantes').success(function(data)
        {
            $scope.particiantes = data;
            $scope.contadorParticipante = $scope.particiantes.length;
        });

        $scope.numberOfPages=function(){
            return Math.ceil($scope.particiantes.length/$scope.pageSize);                
        }  

        $scope.listarParticipantes = function(){
          $http.get('http://localhost:8090/MIS PROYECTOS_BUPLA/EventApp/controller-be/mainParticipante.php?accion=listarParticipantes').success(function(data)
          {
              $scope.particiantes = data;
              $scope.contadorParticipante = $scope.particiantes.length;
          });          
        }


        $scope.registrarParticipante = function(){

           if($scope.nomParticipante != null && $scope.cargoParti != "" && $scope.correoParti != null && $scope.instiParti != null && $scope.dniParti !=null && $scope.telefono2Parti != null  ){
                var RegistroParticipante = $http.post("http://localhost:8090/MIS PROYECTOS_BUPLA/EventApp/controller-be/mainParticipante.php?accion=RegistrarParti", 
                    {
                      nomParticipante : $scope.nomParticipante,
                      cargoParti : $scope.cargoParti,
                      correoParti : $scope.correoParti,
                      institucionParti : $scope.instiParti,                    
                      dniPartici: $scope.dniParti,
                      telfParti_2 : $scope.telefono2Parti,
                      descripParti: $scope.descripcionParti,
                    });
                    RegistroParticipante.success(function(data)
                    {
                     alertaRegistro(true, "cpalertaRegistroParticipante", "Los Datos se registraron correctamente", "ERROR AL REGISTRAR LOS DATOS, por favor verifique lo campos solicitados" );                                           
                      $scope.listarParticipantes();
                    })
            }else{
                alertaRegistro(false, "cpalertaRegistroParticipante", "Los Datos se registraron correctamente", "ERROR AL REGISTRAR LOS DATOS, por favor verifique lo campos solicitados" );
            } 
        }

        $scope.selectParti = function(id,nomb,cargo,correo,institu,dni,telf2,descrip){
          $scope.idParticipante = id;
          $scope.nomParticipante = nomb;
          $scope.cargoParti = cargo;
          $scope.correoParti = correo;
          $scope.instiParti = institu;            
          $scope.dniParti = dni;
          $scope.telefono2Parti = telf2;
          $scope.descripcionParti = descrip;
        }

        $scope.editarParticipante = function(){
           if($scope.idParticipante != null && $scope.nomParticipante != null && $scope.cargoParti != "" && $scope.correoParti != null && $scope.instiParti != null && $scope.dniParti !=null && $scope.telefono2Parti != null  ){

                var actulizarParticipante = $http.post("http://localhost:8090/MIS PROYECTOS_BUPLA/EventApp/controller-be/mainParticipante.php?accion=EditarParti", 
                {
                      AC_parti_id : $scope.idParticipante,
                      AC_nomParticipante : $scope.nomParticipante,
                      AC_cargoParti : $scope.cargoParti,
                      AC_correoParti : $scope.correoParti,
                      AC_institucionParti : $scope.instiParti,                    
                      AC_dniParti : $scope.dniParti,
                      AC_telfParti_2 : $scope.telefono2Parti,
                      AC_descripParti: $scope.descripcionParti,                      
                });            
                actulizarParticipante.success(function(respuesta) {
                    alertaRegistro(true, "cpalertaRegistroParticipante", "Los Datos se actualizaron correctamente", "ERROR AL ACTUALIZAR LOS DATOS, por favor verifique lo campos solicitados" );                                           
                    $scope.listarParticipantes();
                })                     
            }else{
                alertaRegistro(false, "cpalertaRegistroParticipante", "Los Datos se actualizaron correctamente", "ERROR AL ACTUALIZAR LOS DATOS, por favor verifique lo campos solicitados" );
            }
        }

        $scope.eliminarParticipante = function(id){
            var eliminarPartici = $http.post("http://localhost:8090/MIS PROYECTOS_BUPLA/EventApp/controller-be/mainParticipante.php?accion=BorrarParti", 
                {codeParti: id});
            eliminarPartici.success(function(respuesta)
            {
                $scope.listarParticipantes();                      
            });          
        }

        $scope.comparacion = function(valor){
            var buscarpor =  $scope.SelectbuscarPor;
            var campoText =  $scope.campoBuscar;   

            if(buscarpor == "Nombre" ){
                if(valor.tb_parti_NombreApe == campoText){
                    return true;
                }else{
                    return false;
                }                  
            } else{
              if(buscarpor == "DNI"){
                if(valor.tb_parti_dniParti == campoText){
                    return true;
                }else{
                    return false;
                }  
              }else{
                if(buscarpor == "Todos" || campoText == "*"){
                    return true;
                }else{
                    return false;
                }                
              }
            }                  
        }

        $scope.selectDatos = function(id,nombre){
          $scope.datos = {cpId:id , cpnomb:nombre};
        }

        $scope.ocultarPanel = function(){
            ocultarAlertaParticipante();
        }

        $scope.limpiar = function(){
          $scope.nomParticipante = null;
          $scope.cargoParti = null;
          $scope.correoParti = null;
          $scope.instiParti = null;            
          $scope.telefono1Parti = null;
          $scope.telefono2Parti = null;
          $scope.descripcionParti = null;     
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

function ocultarAlertaParticipante(){
      var alerta = document.getElementById("cpalertaRegistroParticipante");
    alerta.style.display = "none";  
};
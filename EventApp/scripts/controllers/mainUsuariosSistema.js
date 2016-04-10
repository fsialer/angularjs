'use strict';  

angular.module('AppEvent')

	.controller('CTRLusuarios',function($scope,$location,$http,$window){

		$scope.mostrarTablaOpciones = true;
		$scope.mostrarsFormulario = false;
		$scope.frmParaModificar = false;
		$scope.btnEditar = false;
		$scope.btnRegistrar = true;
		$scope.frmParaRegistrar = true;
		$scope.titulo = "Listado de Usuarios del Sistema";

		$scope.mostrarRegistro = function(valor){
			$scope.titulo = "Registro del Usuario del Sistema";
			$scope.mostrarsFormulario = valor;
			$scope.frmParaRegistrar = valor;
			$scope.btnRegistrar = valor;
			$scope.mostrarTablaOpciones = !valor;
			$scope.frmParaModificar = !valor;
			$scope.btnEditar = !valor
			if(!valor == true){
				$scope.titulo = "Listado de Usuarios del Sistema";				
			}
		}

		$scope.mostrarFrmModificar = function(valor){
			$scope.titulo = "Modificar Datos del Evaluador";			
			$scope.mostrarsFormulario = valor;
			$scope.frmParaModificar = valor;
			$scope.btnEditar = valor
			$scope.mostrarTablaOpciones = !valor;
			$scope.frmParaRegistrar = !valor;
			$scope.btnRegistrar = !valor
			if(!valor == true){
				$scope.titulo = "Listado de Usuarios del Sistema";				
			}
		}

        $scope.selecModuloAsig = function(id, nombreUser){
            $scope.datosU = { cpId: id, cpUser : nombreUser};
        }

        /* VARIABLES PARA LA PAGINACIÓN*/
        $scope.currentPage = 0;
        $scope.pageSize = 5;
        $scope.usuarios = [];         

        $http.get('http://localhost:8090/MIS PROYECTOS_BUPLA/SystemENCRIP/controller-be/mainUsuario.php?accion=listarUsuarios').success(function(data)
        {
            $scope.usuarios = data;
            $scope.contadorUsuarios = $scope.usuarios.length;
        });    

        $scope.numberOfPages=function(){
            return Math.ceil($scope.usuarios.length/$scope.pageSize);                
        }  

        $scope.registrarUsuario = function(){
            
            if($scope.nombreUSER != null && $scope.apeUSERU != null && $scope.dniUSER != null && $scope.estadoUSER != "" && $scope.telfUSER != null  && $scope.tipoUSER != "" && $scope.USERdato != null && $scope.PASSwordDato != null){
                var RegistroUsuario = $http.post("http://localhost:8090/MIS PROYECTOS_BUPLA/SystemENCRIP/controller-be/mainUsuario.php?accion=registrarUsuarioU", 
                    {
                        perUser : $scope.nombreUSER + " " + $scope.apeUSERU,
                        dniU : $scope.dniUSER,
                        estadoU : $scope.estadoUSER,
                        telfU : $scope.telfUSER,
                        tipoU: $scope.tipoUSER,
                        userU : $scope.USERdato,
                        passU : $scope.PASSwordDato,
                    });
                    RegistroUsuario.success(function(data)
                    {
                      alertaRegistro(true, "cpalertaRegistroUsuario", "El usuario se registro correctamente", "Error al registrar el usuario, por favor verifique lo campos solicitados" );                                           
                      $scope.ListarTodoPersonalUsuario();
                    })
            }else{
                alertaRegistro(false, "cpalertaRegistroUsuario", "El usuario se registro correctamente", "Error al registrar el usuario, por favor verifique lo campos solicitados" );
            }        	
        };


		$scope.enviarDatoParaEditarU = function(id){
				
            var selectINFOEusuario = $http.post("http://localhost:8090/MIS PROYECTOS_BUPLA/SystemENCRIP/controller-be/mainUsuario.php?accion=selectUsuario",
                 {userCodigo: id});

                 selectINFOEusuario.success(function(data) {
                    $scope.usuarioInfoMO = data[0];           

					$scope.idPersUser = $scope.usuarioInfoMO.tbUserS_id;
		        	$scope.usuarioPER = $scope.usuarioInfoMO.tbUserS_nombreApe;
		        	$scope.dniUSER = $scope.usuarioInfoMO.tbUserS_dni;
		        	$scope.estadoUSER = $scope.usuarioInfoMO.tbUserS_estado;                    
		        	$scope.telfUSER = $scope.usuarioInfoMO.tbUserS_tefl;
		        	$scope.tipoUSER = $scope.usuarioInfoMO.tbUserS_tipo;
		        	$scope.USERdato = $scope.usuarioInfoMO.tbUserS_user;  
                    $scope.PASSwordDato = $scope.usuarioInfoMO.tbUserS_password;
            })                 
		}

		$scope.EditarUsuario = function(){
            var actulizarUsuario = $http.post("http://localhost:8090/MIS PROYECTOS_BUPLA/SystemENCRIP/controller-be/mainUsuario.php?accion=EditarUsuario", 
            {
                Cmpiduser: $scope.idPersUser,
                Cmpusuario: $scope.usuarioPER,
                Cmpdni: $scope.dniUSER,
                Cmpestado: $scope.estadoUSER, 
                Cmptelf: $scope.telfUSER,
                Cmptipo: $scope.tipoUSER,
                Cmpuser: $scope.USERdato,
                Cmppass: $scope.PASSwordDato,                        
            });            
            actulizarUsuario.success(function(respuesta) {
                alertaRegistro(true, "cpalertaRegistroUsuario", "Se Editaron los datos Correctamente", "Error al modificar los datos, por favor verifique lo campos solicitados" );                                                                   
                $scope.ListarTodoPersonalUsuario();
            })      
		}

		$scope.eliminarUsuario = function(id){
            var eliminarUSER = $http.post("http://localhost:8090/MIS PROYECTOS_BUPLA/SystemENCRIP/controller-be/mainUsuario.php?accion=EliminarUsuario", 
                {codeUSER: id});
            eliminarUSER.success(function(respuesta)
            {
                $scope.ListarTodoPersonalUsuario();		
               // eliminarModAsigCli.log(respuesta);
            });     
		}

        $scope.ListarTodoPersonalUsuario = function(){            
            $http.get('http://localhost:8090/MIS PROYECTOS_BUPLA/SystemENCRIP/controller-be/mainUsuario.php?accion=listarUsuarios').success(function(data)
            {
                $scope.usuarios = data;
                $scope.contadorUsuarios = $scope.usuarios.length;
            });             
        }        

        $scope.ocultarAlertaUsuario = function(){
            ocultarAlertaUsuario();            
        };     

        $scope.limpiarFormularioUsuario = function(){
            $scope.usuarioPER = null;
            $scope.nombreUSER = null;
            $scope.apeUSERU = null;
            $scope.dniUSER = null;

            $scope.estadoUSER = "";
            $scope.telfUSER = null;
            $scope.tipoUSER = "";

            $scope.USERdato = null;
            $scope.PASSwordDato = null;            
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

function ocultarAlertaUsuario(){
      var alerta = document.getElementById("cpalertaRegistroUsuario");
    alerta.style.display = "none";  
};
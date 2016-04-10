
var app=angular.module("myapp",[]);
app.factory('Fabrica',function(){
	var servicio={
		objeto:{mensaje:'Saludos desde la fabrica'},
	msjInicial:function(){
		servicio.objeto['mensaje']='Saludos desde la Fabrica';
	},
	msjNuevo:function(msj){
		servicio.objeto.mensaje=msj;
	}

	};
	return servicio;
});//factory se utilizan para compartir informacion en diferentes controladores
app.controller("ControladorUno",function($scope,Fabrica){
	$scope.nuevo=function(){
		Fabrica.msjNuevo($scope.nuevoMensaje);
	};
	$scope.dato=Fabrica.objeto;

});
	app.controller("ControladorDos",function($scope,Fabrica){
	$scope.nuevo=function(){
		Fabrica.msjNuevo($scope.nuevoMensaje);
	};
	$scope.dato=Fabrica.objeto;
	});

	app.controller("ControladorTres",function($scope,Fabrica){
			
			$scope.resetear=function(){
				Fabrica.msjInicial();
			};
	
	});
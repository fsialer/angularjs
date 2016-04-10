var app=angular.module("MyFirstApp",[]);
app.controller("FirstController",function($scope){
	$scope.nombre="Fernando";
	$scope.nuevoComentario={};
	$scope.comentarios=[
	{comentario:"Buen tutorial",username:"fernando"},
	{
		comentario:"Malo tutorial",username:"Adolfo"
	}];
	$scope.agregarComentario=function(){
		$scope.comentarios.push($scope.nuevoComentario);
		$scope.nuevoComentario={};
	}
	
});
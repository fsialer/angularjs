var controladores=angular.module('MyApp',[]);
controladores.controller('ControladorTareas',['$scope',function($scope){
	$scope.tareas=[{texto:'Ser super heoricos con AngularJS',
	hecho:true},{texto:'crea una aplicacion con angularJS',
	hecho:false}];
	$scope.agregarTareas=function(){
		$scope.tareas.push({texto:$scope.nuevaTarea,hecho:false});
		$scope.nuevaTarea="";

	};
	$scope.restantes=function(){
		var cuenta=0;
		angular.forEach($scope.tareas,function(tarea){
			cuenta+=tarea.hecho ? 0:1;
		});
		return cuenta;
	}
	$scope.eliminar=function(){
		var tareasViejas=$scope.tareas;
		$scope.tareas=[];
		angular.forEach(tareasViejas,function(tarea){
			if (!tarea.hecho) $scope.tareas.push(tarea);
		});
	}

}]);
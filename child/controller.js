angular.module("MyFirstApp",[])
.run(function($rootScope){
$rootScope.nombre="Fernando";
})
.controller("FirstController",function($scope){
	$scope.nombre="jose";
	setTimeout(function(){
		$scope.$apply(function(){
			$scope.nombre="Natalia";
		},2000);
	})
})
.controller("childController",function($scope){
	
});
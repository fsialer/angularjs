var app=angular.module("mainModule",[]);
//Como crear filtro personzalizados
app.filter("removeHTML",function() {
	return function(texto){
		return String(texto).replace(/<[^>]+>/gm,'');
	}
})
.controller("filtersController",function($scope){
	$scope.mi_html2={};
	$scope.mi_html2.title="Hola";
	$scope.mi_html2.body="<p>Hola mundo</p>";
	$scope.mi_html="<p>Hola mundo</p>";
	$scope.costo=2;
});
var app=angular.module("MyFirstApp",[]);
app.controller("firstController",function($scope,$http){
	$scope.loading=true;
	$http.get("http://jsonplaceholder.typicode.com/posts")
	.success(function(data){
		
		$scope.posts=data;
		$scope.loading=false;
	})
	.error(function(err){
		$scope.loading=false;
	});
	
});
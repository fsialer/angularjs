angular.module("CustomDirective" ,[])

.directive("backImg",function(){
	return function(scope,element,attrs){
		attrs.$observe('backImg', function(value){
			element.css({
				"background":"url("+value+")",
				"background-position": "center",
				"background-size": "cover"

			});
		});
	}
})
.controller("AppCtrl",function($scope,$http){
	$scope.repos=[];
	$http.get("https://api.github.com/users/fsialer/repos")
	.success(function(data){
		$scope.repos=data;
		
	})
	.error(function(er){
		console.log(er);
	})
});
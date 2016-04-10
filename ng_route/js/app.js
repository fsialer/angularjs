angular.module("CustomDirective",["ngRoute"])
.config(function($routeProvider){
	$routeProvider
	.when("/",{
		controller:"ReposController",
		templateUrl:"template/home.html"

	})
	.when("/repo/:name",{
		controller:"RepoController",
		templateUrl:"template/repo.html"
	})
	.otherwise("/");
})
'use strict';  

angular.module('AppEvent')

	.controller('CTRLbienvenido',function($scope,$location,$http,$window,$cookieStore){

        var usuario = $cookieStore.get('usuario');
        $scope.titulo = usuario;

	})





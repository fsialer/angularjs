   
'use strict';  

angular.module('AppEvent')


   .controller('fazCRTL', 

        function($scope,$location,$http,$cookieStore){


        $scope.usuarioAC = $cookieStore.get('usuario');
        $scope.cargo = $cookieStore.get('tipo');
        $scope.estadoCON = $cookieStore.get('estadoConexion');

        $scope.listausuarios = [];

        $http.get('http://localhost:8090/MIS PROYECTOS_BUPLA/SystemENCRIP/controller-be/mainUsuario.php?accion=listarUsuarios').success(function(data)
        {
            $scope.listausuarios = data;            
        });         

        $scope.cerrarSesion = function(){

            $cookieStore.remove("estadoConexion");
            $cookieStore.remove("usuario");
            $cookieStore.remove("tipo")

            window.location.href = 'index.html';
            // $location.path('/Login');
        };

    });
'use strict';  

angular.module('AppEvent',['ngRoute', 'ngCookies'])


    // .run(function($rootScope, $location, $cookieStore){
    //     $rootScope.$on('$routeChangeStart',function(event, next, current){
    //         if($cookieStore.get('estadoConexion') == false || $cookieStore.get('estadoConexion') == null) {
    //             if(next.templateUrl == 'views/frm_PersonaEvaluadora.html' 
    //                 || next.templateUrl == 'views/frm_fichaAleatoriaEvaluacion.html' 
    //                 || next.templateUrl == 'views/frm_fichasEntrada_RegAlumno.html' 
    //                 || next.templateUrl == 'views/frm_resultadoExamen.html' 
    //                 || next.templateUrl == 'views/frm_FichaEvaluacionDoc.html' 
    //                 || next.templateUrl == 'views/frm_Categorias.html' 
    //                 || next.templateUrl == 'views/frm_UsuriosSistema.html'                     
    //                 || next.templateUrl == 'views/frm_BienvenidoPanel.html' 
    //                ){
    //                $location.path('/Login');
    //             }
    //         }else{
    //             if(next.templateUrl == 'views/inicioSesion.html'){                     
    //                  $location.path('/Fichas_de_examenes');
    //             }
    //         }        
    //     })
    // })

    .config(function($routeProvider)
        {
            $routeProvider
                .when('/',
                {
                    templateUrl: 'views/frm_BienvenidoPanel.html',
                    controller: 'CTRLbienvenido'
                })

                .when('/Bienvenido',
                {
                    templateUrl: 'views/frm_BienvenidoPanel.html',
                    controller: 'CTRLbienvenido'
                })

                .when('/Login',
                {
                    templateUrl: 'views/inicioSesion.html',
                    controller: 'CTRLverifiacionUser'
                })                

                .when('/Evento',
                {
                    templateUrl: 'views/frm_Evento.html',
                    controller: 'CTRLevento'
                })

                .when('/Participante',
                {
                    templateUrl: 'views/frm_Participante.html',
                    controller: 'CTRLparticipante'
                })

                .when('/Registro_de_asistencia',
                {
                    templateUrl: 'views/frm_RegistroAsistencia.html',
                    controller: 'CTRLregAsistente'
                })                

                .when('/Entrega_Certificacion',
                {
                    templateUrl: 'views/frm_EntregaCertificado.html',
                    controller: 'CTRLcertificacion'
                }) 

                .when('/Reportes',
                {
                    templateUrl: 'views/frm_Reportes.html',
                    controller: 'CTRLreportes'
                })                 

                .when('/Configuracion',
                {
                    templateUrl: 'views/frm_UsuriosSistema.html',
                    controller: 'CTRLusuarios'
                })                                 

                .otherwise(
                {
                    redirectTo: '/'
                });
        });
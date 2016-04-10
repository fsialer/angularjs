'use strict';  

angular.module('AppEvent')

	.controller('CTRLevento',function($scope,$location,$http,$window){

        $scope.visible = false;
        $scope.pnlTabla = true;
        $scope.pnlFormulario = false;
        $scope.pnlFormularioPonentes = false;


        $scope.llamarformulario = function(valor){
          $scope.tituloFormulario = "Registro de Evento";
          $scope.pnlFormulario = valor;
          $scope.pnlTabla = !valor; 
          $scope.visible = valor;         
          $scope.btnRegistrar = valor;
          $scope.btnEditar = !valor;

        }

        $scope.mostrarFrmEditar = function(valor){
          $scope.tituloFormulario = "Modificar los Datos del Evento";
          $scope.pnlTabla = !valor; 
          $scope.visible = valor;
          $scope.pnlFormulario = valor;
          $scope.btnRegistrar = !valor;
          $scope.btnEditar = valor;
        }

        $scope.llamarTablaPonentes = function(valor){
          $scope.tituloPonentes = "aaaa"
          $scope.pnltablaPonentes = valor;
          $scope.pnlTabla = !valor;
        }

        $scope.llamarFormularioPonentes = function(valor){
          $scope.tituloFormularioPonentes = "Registro de Ponente del Evento"
          $scope.pnltablaPonentes = !valor;
          $scope.pnlFormularioPonentes = valor;
          $scope.btnRegistrarPonente = valor;
          $scope.btnEditarPonente = !valor;
        }

        $scope.mostrarFrmEditarPonente = function(valor){
          $scope.tituloFormularioPonentes = "Modificar los Datos del Ponente del Evento"
          $scope.pnltablaPonentes = !valor;
          $scope.pnlFormularioPonentes = valor;
          $scope.btnRegistrarPonente = !valor;
          $scope.btnEditarPonente = valor;
        }

        $scope.llamarTablaOrganisadores = function(valor){
          $scope.tituloOganizadores = "qqqqqqq";
          $scope.pnlTabla = !valor;
          $scope.pnltablaOrganisadores = valor;
        }

        $scope.llamarFormularioOrganisadores = function(valor){
          $scope.tituloFormularioOrganizadores = "Registrar Organizador del Evento"
          $scope.pnlFormularioOrganisadores = valor;
          $scope.pnltablaOrganisadores = !valor;
          $scope.btnRegistrarOrganisador = valor;
          $scope.btnEditarOrganisador = !valor;
        }

        $scope.mostrarFrmEditarOrganisador = function(valor){
          $scope.tituloFormularioOrganizadores = "Modificar los Datos del Organizador del Evento"
          $scope.pnlFormularioOrganisadores = valor;
          $scope.pnltablaOrganisadores = !valor;
          $scope.btnRegistrarOrganisador = !valor;
          $scope.btnEditarOrganisador = valor;
        }


        /* VARIABLES PARA LA PAGINACIÓN*/
        $scope.currentPage = 0;
        $scope.pageSize = 5;
        $scope.eventos = [];  

        $http.get('http://localhost:8090/MIS PROYECTOS_BUPLA/EventApp/controller-be/mainEvento.php?accion=listarEventos').success(function(data)
        {
            $scope.eventos = data;
            $scope.contadorEventos = $scope.eventos.length;
        });

        $scope.numberOfPages=function(){
            return Math.ceil($scope.eventos.length/$scope.pageSize);                
        }          



        $scope.registrarEvento = function(){
          alert("VOY A REGISTRAR");
        }

        $scope.editarEvento = function(){
          alert("VOY A EDITAR");
        }


        $scope.registrarPonentes = function(){
          alert("VOY A REGISTRAR PONENTE");
        }

        $scope.editarPonentes = function(){
          alert("VOY A EDITAR PONENTES");
        }

        $scope.registrarOrganisador = function(){
          alert("VOY A REGISTRAR ORGANIZADOR");
        }

        $scope.editarOrganisador = function(){
          alert("VOY A EDITAR ORGANISADOR");
        }


	})

        .filter('startFrom', function() {
            return function(input, start) {
                start = +start; //parse to int
                return input.slice(start);
            }
        });


        // $scope.mostrarTablaOpciones = true;
        // $scope.mostrarsFormulario = false;
        // $scope.btnEditar = false;
        // $scope.btnRegistrar = true;
        // $scope.titulo = "Listado de Eventos";

        // $scope.mostrarRegistro = function(valor){
        //  $scope.titulo = "Registro de Categoria";
        //  $scope.mostrarsFormulario = valor;
        //  $scope.btnRegistrar = valor;
        //  $scope.mostrarTablaOpciones = !valor;
        //  $scope.btnEditar = !valor
        //  if(!valor == true){
  //               $scope.titulo = "Listado de Categorias de Conductores";          
        //  }
        // }

        // $scope.mostrarFrmModificar = function(valor){
        //  $scope.titulo = "Modificar Datos de la Categoria";          
        //  $scope.mostrarsFormulario = valor;
        //  $scope.btnEditar = valor
        //  $scope.mostrarTablaOpciones = !valor;
        //  $scope.btnRegistrar = !valor
        //  if(!valor == true){
  //               $scope.titulo = "Listado de Categorias de Conductores";         
        //  }
        // }

  //       $scope.selecModuloAsig = function(id, nombreModulo){
  //           $scope.datos = { cpId: id, cpEva : nombreModulo};
  //       }

  //       /* VARIABLES PARA LA PAGINACIÓN*/
  //       $scope.currentPage = 0;
  //       $scope.pageSize = 5;
  //       $scope.categorias = [];         

  //       $http.get('http://localhost:8090/MIS PROYECTOS_BUPLA/SystemENCRIP/controller-be/mainCategoria.php?accion=listarCategorias').success(function(data)
  //       {
  //           $scope.categorias = data;
  //           $scope.contadorcategorias = $scope.categorias.length;
  //       });    

  //       $scope.ListarCategoriastodo = function(){            
  //           $http.get('http://localhost:8090/MIS PROYECTOS_BUPLA/SystemENCRIP/controller-be/mainCategoria.php?accion=listarCategorias').success(function(data)
  //           {
  //               $scope.categorias = data;
  //               $scope.contadorcategorias = $scope.categorias.length;
  //           });              
  //       }  

  //       $scope.numberOfPages=function(){
  //           return Math.ceil($scope.categorias.length/$scope.pageSize);                
  //       }  

  //       $scope.selectDatos = function(id, categoria, estado, descrip){        
  //           $scope.idCategoria = id;
  //           $scope.nombreCategoria = categoria;
  //           $scope.estadoCategoria = estado;
  //           $scope.descripcionCategoria = descrip;
  //       }

  //       $scope.registrarCategoria = function(){
            
  //           if($scope.nombreCategoria != null && $scope.estadoCategoria != "" && $scope.descripcionCategoria != null){
  //               var RegistroCategoria = $http.post("http://localhost:8090/MIS PROYECTOS_BUPLA/SystemENCRIP/controller-be/mainCategoria.php?accion=registrarCategoria", 
  //                   {
  //                   nomCategoria : $scope.nombreCategoria,
  //                   esatdoCate : $scope.estadoCategoria,
  //                   descripcionCate : $scope.descripcionCategoria,
  //                   });
  //                   RegistroCategoria.success(function(data)
  //                   {
  //                     alertaRegistro(true, "cpalertaRegistroCategoria", "La categoria se registro correctamente", "ERROR AL REGISTRAR LA CATEGORIA, por favor verifique lo campos solicitados" );                                           
  //                     $scope.ListarCategoriastodo();
  //                   })
  //           }else{
  //               alertaRegistro(false, "cpalertaRegistroCategoria", "La categoria se registro correctamente", "ERROR AL REGISTRAR LA CATEGORIA, por favor verifique lo campos solicitados" );
  //           }            
  //       };

        // $scope.EditarCategoria = function(){

  //           if($scope.idCategoria != null){
  //               var actulizarCATEGORIA = $http.post("http://localhost:8090/MIS PROYECTOS_BUPLA/SystemENCRIP/controller-be/mainCategoria.php?accion=EditarCategoria", 
  //               {
  //                   CmpidCate: $scope.idCategoria,
  //                   CmpnombreCate: $scope.nombreCategoria,
  //                   CmpestadoCate: $scope.estadoCategoria, 
  //                   CmpdescripCate: $scope.descripcionCategoria,                      
  //               });            
  //               actulizarCATEGORIA.success(function(respuesta) {
  //                   alertaRegistro(true, "cpalertaRegistroCategoria", "Se Editaron los datos Correctamente", "ERROR AL MODIFICAR LOS DATOS, por favor verifique lo campos solicitados" );                                                                   
  //                   $scope.ListarCategoriastodo();
  //               }) 
  //           }else{
  //               alertaRegistro(false, "cpalertaRegistroCategoria", "Se Editaron los datos Correctamente", "ERROR AL MODIFICAR LOS DATOS, por favor verifique lo campos solicitados" );                                                                   
  //           }

     
        // }

        // $scope.eliminarCategoria = function(id){
  //           var eliminarCategoria = $http.post("http://localhost:8090/MIS PROYECTOS_BUPLA/SystemENCRIP/controller-be/mainCategoria.php?accion=EliminarCategoria", 
  //               {codeCate: id});
  //           eliminarCategoria.success(function(respuesta)
  //           {
  //               $scope.ListarCategoriastodo();                      
  //           });     
        // }

      

  //       $scope.ocultarAlertaCate = function(){
  //           ocultarAlertaCategoria();            
  //       };     

  //       $scope.limpiarFormularioCategoria= function(){
  //           $scope.idCategoria = null;
  //           $scope.nombreCategoria = null;
  //           $scope.estadoCategoria =  "";
  //           $scope.descripcionCategoria = null;
           
  //       }   





function alertaRegistro(rpta, tipo, smsSuccess, smsError) {

    var alerta = document.getElementById(tipo);
    alerta.style.display = "block";

    if (rpta === true) {
        var div = $("#" + tipo).closest("div");
        div.removeClass("alert alert-danger");
        div.addClass("alert alert-success");
        $("#textAlertaBIEN").remove();
        $("#textAlertaMAL").remove();
        div.append('<center id="textAlertaBIEN">"' + smsSuccess + '"</center>');        
    } else {
        var div = $("#" + tipo).closest("div");
        div.removeClass("alert alert-success");
        div.addClass("alert alert-danger");
        $("#textAlertaMAL").remove();
        $("#textAlertaBIEN").remove();
        div.append('<center id="textAlertaMAL">"' + smsError +'"</center>');
    }
};

function ocultarAlertaCategoria(){
      var alerta = document.getElementById("cpalertaRegistroCategoria");
    alerta.style.display = "none";  
};
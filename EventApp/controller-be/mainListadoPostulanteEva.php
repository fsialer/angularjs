<?php
 
header('Access-Control-Allow-Origin: *');
require "../models-be/ClsListadoPostulanteEva.php";

$objClsListadoPostulanteEva = new ClsListadoPostulanteEva();

if (!empty($_GET["accion"])) {

     if ($_GET["accion"] == 'listarFichasEvaluadores') {
        $Resultado = $objClsListadoPostulanteEva->Get_MostrarlistarFichasEvaluadores();
        echo $Resultado;
    }       

     if ($_GET["accion"] == 'listarSemanas') {
        $Resultado = $objClsListadoPostulanteEva->Get_listarSemanas();
        echo $Resultado;
    } 

     if ($_GET["accion"] == 'listarfichasEntradas') {
        $Resultado = $objClsListadoPostulanteEva->Get_listarfichasEntradas();
        echo $Resultado;
    } 

     if ($_GET["accion"] == 'listarcategorias') {
        $Resultado = $objClsListadoPostulanteEva->Get_listarcategorias();
        echo $Resultado;
    } 

     if ($_GET["accion"] == 'listadoPostulantes') {
        $Resultado = $objClsListadoPostulanteEva->Get_listadoPostulantes();
        echo $Resultado;
    }     



    if ($_GET["accion"] == 'registrarFichaEvaluacion') {
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $Cmp_cmpIDSemana = $objDatos->cmpIDSemana;
        $Cmp_cmpIDFichaEntrada = $objDatos->cmpIDFichaEntrada;

        try {
            $Resultado =  $objClsListadoPostulanteEva->insert_fichaEvaluacion($Cmp_cmpIDSemana,$Cmp_cmpIDFichaEntrada);
            $objClsListadoPostulanteEva->beginTransaction();
            echo 'registro realizado correctamente';
        } catch (Exception $e) {
            $objClsListadoPostulanteEva->rollback();
            echo $e;
        }
    }
    

    if ($_GET["accion"] == 'EditarFichaEvaluacion') {
        $objDatos = json_decode(file_get_contents("php://input"));

        $cmp_IDfichaEva = $objDatos->CmpIDfichaEVA;
        $cmp_IDsemana = $objDatos->CmpIDsemana;
        $cmp_IDfichaEn = $objDatos->CmpIDfichaEntrada;
         
        try {
            $Resultado = $objClsListadoPostulanteEva->editar_FichaEvaluacion($cmp_IDfichaEva,$cmp_IDsemana,$cmp_IDfichaEn);
            $objClsListadoPostulanteEva->beginTransaction();
            echo 'edición realizado correctamente';
        } catch (Exception $e) {
            $objClsListadoPostulanteEva->rollback();
            echo $e;
        }
    }        

    if ($_GET["accion"] == 'EliminarFichaEvaluacion') {
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $Cmp_codeFichaEva = $objDatos->codeFichaEva;
        
        try{
            $Resultado = $objClsListadoPostulanteEva->eliminar_FichaEvaluacion($Cmp_codeFichaEva);
        }catch(Exception $e){
            $objClsListadoPostulanteEva->rollback();
            echo $e;
        }                    
    }     




}


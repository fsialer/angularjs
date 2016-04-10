<?php
 
header('Access-Control-Allow-Origin: *');
require "../models-be/ClsResultadosExa.php";

$objResultadoPost = new ClsResultadosExa();

if (!empty($_GET["accion"])) {

     if ($_GET["accion"] == 'listarPostulantes') {
        $Resultado = $objResultadoPost->Get_MostrarResultadosPos();
        echo $Resultado;
    }       

     if ($_GET["accion"] == 'listarResultados') {
        $Resultado = $objResultadoPost->Get_listarResultados();
        echo $Resultado;
    }    

     if ($_GET["accion"] == 'ListadoFechas') {
        $Resultado = $objResultadoPost->Get_ListadoFechas();
        echo $Resultado;
    } 

     if ($_GET["accion"] == 'listarEvaluadores') {
        $Resultado = $objResultadoPost->Get_listarEvaluadores();
        echo $Resultado;
    }     
    

    if ($_GET["accion"] == 'ActualizarResultadoPostulante') {
        $objDatos = json_decode(file_get_contents("php://input"));

        $cmp_idPos = $objDatos->CmpidPostulante;
        $cmp_resultado = $objDatos->CmpResultado;
        $cmp_Evaluador = $objDatos->cmpEvaluador;
         
        try {
            $Resultado = $objResultadoPost->editar_resultadoPos($cmp_idPos,$cmp_resultado,$cmp_Evaluador);
            $objResultadoPost->beginTransaction();
            echo 'edición realizado correctamente';
        } catch (Exception $e) {
            $objResultadoPost->rollback();
            echo $e;
        }
    }  

//---------------------




    // if ($_GET["accion"] == 'registrarEvaluador') {
    //     $objDatos = json_decode(file_get_contents("php://input"));
        
    //     $CmpEvaluador = $objDatos->evaluador;
    //     $CmpDNI = $objDatos->dni;
    //     $CmpEstado = $objDatos->estado;       
    //     $CmpTelefono = $objDatos->telefono;
    //     $CmpTipoPer = $objDatos->tipoPer;    
    //     $CmpDescripcion = $objDatos->descripcion; 

    //     try {
    //         $Resultado =  $objResultadoPost->insert_Evaluador($CmpEvaluador,$CmpDNI,$CmpEstado,$CmpTelefono,$CmpTipoPer,$CmpDescripcion);
    //         $objResultadoPost->beginTransaction();
    //         echo 'registro realizado correctamente';
    //     } catch (Exception $e) {
    //         $objResultadoPost->rollback();
    //         echo $e;
    //     }
    // }

    // if ($_GET["accion"] == 'selectEvaluador') {
    //         $objDatos = json_decode(file_get_contents("php://input"));
    //         $codigoEvaluador = $objDatos->evaluadorCodigo;
    //         $Resultado = $objResultadoPost->seledInfo($codigoEvaluador);
    //         echo $Resultado;
    // }    

    // if ($_GET["accion"] == 'ActualizarResultadoPostulante') {
    //     $objDatos = json_decode(file_get_contents("php://input"));

    //     $cmp_idEva = $objDatos->Cmpid;
    //     $cmp_evaluador = $objDatos->Cmpevaluador;
    //     $cmp_dni = $objDatos->Cmpdni;
    //     $cmptelef = $objDatos->Cmptelf;
    //     $cmp_estado = $objDatos->Cmpestado;
    //     $cmp_tipo = $objDatos->Cmptipo;
    //     $cmp_descrip = $objDatos->Cmpdescrip;
         
    //     try {
    //         $Resultado = $objResultadoPost->editar_evaluador($cmp_idEva,$cmp_evaluador,$cmp_dni,$cmptelef,$cmp_estado,$cmp_tipo,$cmp_descrip);
    //         $objResultadoPost->beginTransaction();
    //         echo 'edición realizado correctamente';
    //     } catch (Exception $e) {
    //         $objResultadoPost->rollback();
    //         echo $e;
    //     }
    // }        

    // if ($_GET["accion"] == 'EliminarEvaluador') {
    //     $objDatos = json_decode(file_get_contents("php://input"));
        
    //     $Cmp_codeEva = $objDatos->codeEva;
        
    //     try{
    //         $Resultado = $objResultadoPost->eliminar_evaluador($Cmp_codeEva);
    //     }catch(Exception $e){
    //         $objResultadoPost->rollback();
    //         echo $e;
    //     }                    
    // }     




}


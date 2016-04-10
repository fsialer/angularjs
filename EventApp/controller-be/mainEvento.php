<?php
 
header('Access-Control-Allow-Origin: *');
require "../models-be/ClsEvento.php";

$objEvento = new ClsEvento();

if (!empty($_GET["accion"])) {

     if ($_GET["accion"] == 'listarEventos') {
        $Resultado = $objEvento->Get_MostrarEvento();
        echo $Resultado;
    }       

    if ($_GET["accion"] == 'registrarEvaluador') {
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $CmpEvaluador = $objDatos->evaluador;
        $CmpDNI = $objDatos->dni;
        $CmpEstado = $objDatos->estado;       
        $CmpTelefono = $objDatos->telefono;
        $CmpTipoPer = $objDatos->tipoPer;    
        $CmpDescripcion = $objDatos->descripcion; 

        try {
            $Resultado =  $objEvaluador->insert_Evaluador($CmpEvaluador,$CmpDNI,$CmpEstado,$CmpTelefono,$CmpTipoPer,$CmpDescripcion);
            $objEvaluador->beginTransaction();
            echo 'registro realizado correctamente';
        } catch (Exception $e) {
            $objEvaluador->rollback();
            echo $e;
        }
    }

    if ($_GET["accion"] == 'selectEvaluador') {
            $objDatos = json_decode(file_get_contents("php://input"));
            $codigoEvaluador = $objDatos->evaluadorCodigo;
            $Resultado = $objEvaluador->seledInfo($codigoEvaluador);
            echo $Resultado;
    }    

    if ($_GET["accion"] == 'EditarEvaluador') {
        $objDatos = json_decode(file_get_contents("php://input"));

        $cmp_idEva = $objDatos->Cmpid;
        $cmp_evaluador = $objDatos->Cmpevaluador;
        $cmp_dni = $objDatos->Cmpdni;
        $cmptelef = $objDatos->Cmptelf;
        $cmp_estado = $objDatos->Cmpestado;
        $cmp_tipo = $objDatos->Cmptipo;
        $cmp_descrip = $objDatos->Cmpdescrip;
         
        try {
            $Resultado = $objEvaluador->editar_evaluador($cmp_idEva,$cmp_evaluador,$cmp_dni,$cmptelef,$cmp_estado,$cmp_tipo,$cmp_descrip);
            $objEvaluador->beginTransaction();
            echo 'edición realizado correctamente';
        } catch (Exception $e) {
            $objEvaluador->rollback();
            echo $e;
        }
    }        

    if ($_GET["accion"] == 'EliminarEvaluador') {
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $Cmp_codeEva = $objDatos->codeEva;
        
        try{
            $Resultado = $objEvaluador->eliminar_evaluador($Cmp_codeEva);
        }catch(Exception $e){
            $objEvaluador->rollback();
            echo $e;
        }                    
    }     




}


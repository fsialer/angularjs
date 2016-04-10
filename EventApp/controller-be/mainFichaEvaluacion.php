<?php
 
header('Access-Control-Allow-Origin: *');
require "../models-be/ClsAlumno.php";

$objSemana = new ClsAlumno();

if (!empty($_GET["accion"])) {

    if ($_GET["accion"] == 'listarSemanas') {
        $Resultado = $objSemana->Get_MostrarSemanas();
        echo $Resultado;
    } 

    if ($_GET["accion"] == 'listarSemanaASIGNADA') {
        $Resultado = $objSemana->Get_MostrarSemanaAsignada();
        echo $Resultado;
    } 

    if ($_GET["accion"] == 'registrarSemana') {
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $Cmp_NomSemana = $objDatos->NomSemana;
        $Cmp_NumEvaluadores = $objDatos->NumEvaluadores;
        $Cmp_NumVeedores = $objDatos->NumVeedores;        

        try {
            $Resultado =  $objSemana->insert_Semana($Cmp_NomSemana,$Cmp_NumEvaluadores,$Cmp_NumVeedores);
            $objSemana->beginTransaction();
            echo 'registro realizado correctamente';
        } catch (Exception $e) {
            $objSemana->rollback();
            echo $e;
        }
    }

    if ($_GET["accion"] == 'registrarAsigPersonalSemana') {
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $Cmp_dia = $objDatos->dia;
        $Cmp_IDpersonal = $objDatos->idPersonal;
        $Cmp_IDsemana = $objDatos->idSemana;        

        try {
            $Resultado =  $objSemana->insert_AsignacionPersonalSem($Cmp_dia,$Cmp_IDpersonal,$Cmp_IDsemana);
            $objSemana->beginTransaction();
            echo 'registro realizado correctamente';
        } catch (Exception $e) {
            $objSemana->rollback();
            echo $e;
        }
    }

    if ($_GET["accion"] == 'EditarAsigPersonnalXdia') {
        $objDatos = json_decode(file_get_contents("php://input"));

        $cmp_idSemana = $objDatos->CmpidSemana;
        $cmp_idPersonal = $objDatos->idPersonal;
         
        try {
            $Resultado = $objSemana->editar_personalAsignado($cmp_idSemana,$cmp_idPersonal);
            $objSemana->beginTransaction();
            echo 'edición realizado correctamente';
        } catch (Exception $e) {
            $objSemana->rollback();
            echo $e;
        }
    }

    if ($_GET["accion"] == 'selectEvaluador') {
            $objDatos = json_decode(file_get_contents("php://input"));
            $codigoEvaluador = $objDatos->evaluadorCodigo;
            $Resultado = $objSemana->seledInfo($codigoEvaluador);
            echo $Resultado;
    }    

    if ($_GET["accion"] == 'EditarSemanaSelect') {
        $objDatos = json_decode(file_get_contents("php://input"));

        $cmp_idSem = $objDatos->CmpidSem;
        $cmp_semana = $objDatos->CmpSemana;
        $cmp_numEva = $objDatos->CmpNumEva;
        $cmp_numVee = $objDatos->CmpNumVee;
         
        try {
            $Resultado = $objSemana->editar_semana($cmp_idSem,$cmp_semana,$cmp_numEva,$cmp_numVee);
            $objSemana->beginTransaction();
            echo 'edición realizado correctamente';
        } catch (Exception $e) {
            $objSemana->rollback();
            echo $e;
        }
    }        

    if ($_GET["accion"] == 'EliminarSemanaSelect') {
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $Cmp_codeSema = $objDatos->codeSema;
        
        try{
            $Resultado = $objSemana->eliminar_semana($Cmp_codeSema);
        }catch(Exception $e){
            $objEvaluador->rollback();
            echo $e;
        }                    
    }     

    if ($_GET["accion"] == 'EliminarPERSONALasignado') {
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $Cmp_codeSemaASIG = $objDatos->codeSemaASIG;
        
        try{
            $Resultado = $objSemana->eliminar_PERSONALasignado($Cmp_codeSemaASIG);
        }catch(Exception $e){
            $objEvaluador->rollback();
            echo $e;
        }                    
    }   

}


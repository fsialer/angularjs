<?php
 
header('Access-Control-Allow-Origin: *');
require "../models-be/ClsParticipante.php";

$objParticipante = new ClsParticipante();

if (!empty($_GET["accion"])) {

     if ($_GET["accion"] == 'listarParticipantes') {
        $Resultado = $objParticipante->Get_listarParticipantes();
        echo $Resultado;
    }       

    if ($_GET["accion"] == 'RegistrarParti') {
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $Cmp_nomParticipante = $objDatos->nomParticipante;
        $Cmp_cargoParti = $objDatos->cargoParti;
        $Cmp_correoParti = $objDatos->correoParti;       
        $Cmp_institucionParti = $objDatos->institucionParti;
        $Cmp_dniPartici = $objDatos->dniPartici;
        $Cmp_telfParti_2 = $objDatos->telfParti_2;               
        $Cmp_descripParti = $objDatos->descripParti;       

        try {
            $Resultado =  $objParticipante->insert_participante($Cmp_nomParticipante,$Cmp_cargoParti,$Cmp_correoParti,$Cmp_institucionParti,$Cmp_dniPartici,$Cmp_telfParti_2,$Cmp_descripParti);
            $objParticipante->beginTransaction();
            echo 'registro realizado correctamente';
        } catch (Exception $e) {            
            $objParticipante->rollback();
            echo $e;
        }
    } 

    if ($_GET["accion"] == 'EditarParti') {
        $objDatos = json_decode(file_get_contents("php://input"));

        $cmp_AC_idParticipante = $objDatos->AC_parti_id;
        $Cmp_AC_nomParticipante = $objDatos->AC_nomParticipante;
        $Cmp_AC_cargoParti = $objDatos->AC_cargoParti;
        $Cmp_AC_correoParti = $objDatos->AC_correoParti;       
        $Cmp_AC_institucionParti = $objDatos->AC_institucionParti;
        $Cmp_AC_dniParti = $objDatos->AC_dniParti;
        $Cmp_AC_telfParti_2 = $objDatos->AC_telfParti_2;               
        $Cmp_AC_descripParti = $objDatos->AC_descripParti;  
         
        try {
            $Resultado = $objParticipante->editar_Participante($cmp_AC_idParticipante,$Cmp_AC_nomParticipante,$Cmp_AC_cargoParti,$Cmp_AC_correoParti,$Cmp_AC_institucionParti,$Cmp_AC_dniParti,$Cmp_AC_telfParti_2,$Cmp_AC_descripParti);
            $objParticipante->beginTransaction();
            echo 'edición realizado correctamente';
        } catch (Exception $e) {
            $objParticipante->rollback();
            echo $e;
        }
    }        

    if ($_GET["accion"] == 'BorrarParti') {
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $Cmp_codeParti = $objDatos->codeParti;
        
        try{
            $Resultado = $objParticipante->eliminar_participante($Cmp_codeParti);
        }catch(Exception $e){
            $objParticipante->rollback();
            echo $e;
        }                    
    }     




}


<?php
 
header('Access-Control-Allow-Origin: *');
require "../models-be/ClsUsuario.php";

$objUsuario = new ClsUsuario();

if (!empty($_GET["accion"])) {

     if ($_GET["accion"] == 'listarUsuarios') {
        $Resultado = $objUsuario->Get_MostrarUsuarios();
        echo $Resultado;
    }       

    if ($_GET["accion"] == 'registrarUsuarioU') {
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $Cmp_peruser = $objDatos->perUser;
        $Cmp_dniU = $objDatos->dniU;
        $Cmp_estadoU = $objDatos->estadoU;       
        $Cmp_telfU = $objDatos->telfU;
        $Cmp_tipoU = $objDatos->tipoU;    
        $Cmp_userU = $objDatos->userU; 
        $Cmp_passU = $objDatos->passU;         

        try {
            $Resultado =  $objUsuario->insert_usuario($Cmp_peruser,$Cmp_dniU,$Cmp_estadoU,$Cmp_telfU,$Cmp_tipoU,$Cmp_userU,$Cmp_passU);
            $objUsuario->beginTransaction();
            echo 'registro realizado correctamente';
        } catch (Exception $e) {
            $objUsuario->rollback();
            echo $e;
        }
    }

    if ($_GET["accion"] == 'selectUsuario') {
            $objDatos = json_decode(file_get_contents("php://input"));
            $cmp_codeUser = $objDatos->userCodigo;
            $Resultado = $objUsuario->seledInfouser($cmp_codeUser);
            echo $Resultado;
    }    

    if ($_GET["accion"] == 'EditarUsuario') {
        $objDatos = json_decode(file_get_contents("php://input"));

        $cmp_iduser = $objDatos->Cmpiduser;
        $cmp_usuario = $objDatos->Cmpusuario;
        $cmp_dni = $objDatos->Cmpdni;
        $cmp_estado = $objDatos->Cmpestado;
        $cmp_telf = $objDatos->Cmptelf;
        $cmp_tipo = $objDatos->Cmptipo;
        $cmp_user = $objDatos->Cmpuser;
        $cmp_pass = $objDatos->Cmppass;
         
        try {
            $Resultado = $objUsuario->editar_usuario($cmp_iduser,$cmp_usuario,$cmp_dni,$cmp_estado,$cmp_telf,$cmp_tipo,$cmp_user,$cmp_pass);
            $objUsuario->beginTransaction();
            echo 'edición realizado correctamente';
        } catch (Exception $e) {
            $objUsuario->rollback();
            echo $e;
        }
    }        

    if ($_GET["accion"] == 'EliminarUsuario') {
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $Cmp_codeUSER = $objDatos->codeUSER;
        
        try{
            $Resultado = $objUsuario->eliminar_user($Cmp_codeUSER);
        }catch(Exception $e){
            $objUsuario->rollback();
            echo $e;
        }                    
    }     

    // if ($_GET["accion"] == 'userVerificadoBD') {
    //         $objDatos = json_decode(file_get_contents("php://input"));
    //         $cmp_passUser = $objDatos->userCodigo;
    //         $Resultado = $objUsuario->select_userVerificadoBD($cmp_passUser);
    //         echo $Resultado;
    // }    


}


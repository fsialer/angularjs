<?php
 
header('Access-Control-Allow-Origin: *');
require "../models-be/ClsFichaEntrada.php";

$objFichas = new ClsFichaEntrada();

if (!empty($_GET["accion"])) {

    if ($_GET["accion"] == 'listarFichas') {
        $Resultado = $objFichas->Get_MostrarFichas();
        echo $Resultado;
    }       

    if ($_GET["accion"] == 'listarCategorias') {
        $Resultado = $objFichas->Get_MostrarCategoria();
        echo $Resultado;
    }     

    if ($_GET["accion"] == 'listarAlumnos') {
        $Resultado = $objFichas->Get_MostrarAlumnos();
        echo $Resultado;
    }     

    if ($_GET["accion"] == 'buscarExistenciaCodigo') {
            $objDatos = json_decode(file_get_contents("php://input"));
            $cmp_codigoBuscar = $objDatos->CodigoBuscar;
            $Resultado = $objFichas->buscarCodigo($cmp_codigoBuscar);
            echo $Resultado;
    } 


    if ($_GET["accion"] == 'registrarFichas') {
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $Cmp_FECHAexa = $objDatos->fechaE;
        $Cmp_HORAexa = $objDatos->horaE;
        $Cmp_RESPONexa = $objDatos->responsableE;       
        $Cmp_DNIexa = $objDatos->dniE; 

        try {
            $Resultado =  $objFichas->insert_FichaEntra($Cmp_FECHAexa,$Cmp_HORAexa,$Cmp_RESPONexa,$Cmp_DNIexa);
            $objFichas->beginTransaction();
            echo 'registro realizado correctamente';
        } catch (Exception $e) {
            $objFichas->rollback();
            echo $e;
        }
    }


    if ($_GET["accion"] == 'registrarAlumnoEvaluar') {
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $Cmp_FECHA = $objDatos->fechaEVALU;
        $Cmp_idFichaRe = $objDatos->idfechaRegis;
        $Cmp_ALUMN0 = $objDatos->alumnoEVALU;
        $Cmp_DNI = $objDatos->dniEVALU;       
        $Cmp_CATEGORIA = $objDatos->categoriaEVALU; 
        $Cmp_CODIGOESPECIAL = $objDatos->CodigoEspecialEVALU; 
        $Cmp_DESCRIPCION = $objDatos->descripcionEVALU; 

        try {
            $Resultado =  $objFichas->insert_AlumnoEva($Cmp_FECHA,$Cmp_idFichaRe,$Cmp_ALUMN0,$Cmp_DNI,$Cmp_CATEGORIA,$Cmp_CODIGOESPECIAL,$Cmp_DESCRIPCION);
            $objFichas->beginTransaction();
            echo 'registro realizado correctamente';
        } catch (Exception $e) {
            $objFichas->rollback();
            echo $e;
        }
    }

   

    if ($_GET["accion"] == 'EditarFicha') {
        $objDatos = json_decode(file_get_contents("php://input"));

        $cmp_id = $objDatos->Cmpid;
        $cmp_fecha = $objDatos->Cmpfecha;
        $cmp_hora = $objDatos->Cmphora;
        $cmp_respon = $objDatos->Cmprespon;
        $cmp_dni = $objDatos->Cmdni;
         
        try {
            $Resultado = $objFichas->editar_ficha($cmp_id,$cmp_fecha,$cmp_hora,$cmp_respon,$cmp_dni);
            $objFichas->beginTransaction();
            echo 'edición realizado correctamente';
        } catch (Exception $e) {
            $objFichas->rollback();
            echo $e;
        }
    }        

    if ($_GET["accion"] == 'EditarAlumnoEvaluados') {
        $objDatos = json_decode(file_get_contents("php://input"));

        $cmp_idEva = $objDatos->CmpidEva;
        $cmp_alumEva = $objDatos->CmpAlumEva;
        $cmp_dniEva = $objDatos->CmpDniEva;
        $cmp_cateEva = $objDatos->CmpCateEva;
        $cmp_descripEva = $objDatos->CmpDescripEva;
         
        try {
            $Resultado = $objFichas->editar_AlumnoEva($cmp_idEva,$cmp_alumEva,$cmp_dniEva,$cmp_cateEva,$cmp_descripEva);
            $objFichas->beginTransaction();
            echo 'edición realizado correctamente';
        } catch (Exception $e) {
            echo 'ERROR - NO edición realizado correctamente';
            $objFichas->rollback();
            echo $e;
        }
    } 


    if ($_GET["accion"] == 'EliminarFicha') {
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $Cmp_codeFicha = $objDatos->codeFicha;
        
        try{
            $Resultado = $objFichas->eliminar_Ficha($Cmp_codeFicha);
        }catch(Exception $e){
            $objFichas->rollback();
            echo $e;
        }                    
    }    

    if ($_GET["accion"] == 'EliminarAE') {
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $Cmp_codeAlum = $objDatos->codeAlum;
        
        try{
            $Resultado = $objFichas->eliminar_Alum($Cmp_codeAlum);
        }catch(Exception $e){
            $objFichas->rollback();
            echo $e;
        }                    
    }  

    if ($_GET["accion"] == 'EliminarFicha_Alumnos') {
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $Cmp_codeFichaAlu = $objDatos->codeFichaAlu;
        
        try{
            $Resultado = $objFichas->eliminar_AlumnosFicha($Cmp_codeFichaAlu);
        }catch(Exception $e){
            $objFichas->rollback();
            echo $e;
        }                    
    }     


}


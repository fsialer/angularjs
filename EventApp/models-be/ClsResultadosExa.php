<?php

require "../config-be/ClsConexion.php";

class ClsResultadosExa extends ClsConexion {

    //Para Listar Modulos
    function Get_MostrarResultadosPos() {
        $this->query = "SELECT tbAlum_id, tbAlum_codigoEspecial FROM tb_alumno ORDER BY tbAlum_id DESC";
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    } 



    function editar_resultadoPos($cmp_idPos,$cmp_resultado,$cmp_Evaluador){    
        $this->query = "UPDATE `tb_alumno` SET `tbAlum_Resultado`='$cmp_resultado',`tbAlum_Evaluador`= '$cmp_Evaluador'  WHERE `tbAlum_id`=".$cmp_idPos;        
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    } 

    function Get_listarResultados() {
        $this->query = "SELECT tb_ficharegistroentrada.tbFichRe_fecha, tb_alumno.tbAlum_codigoEspecial, tb_categoria.tbCatego_Categoria,tb_alumno.tbAlum_Resultado,tb_evaluador.tbEva_evaluador FROM tb_fichaevaluacion
                        INNER JOIN tb_asignaciondocentesemana ON tb_asignaciondocentesemana.tbAsigDocSem_id = tb_fichaevaluacion.tbFichEva_IDsemana
                        INNER JOIN tb_ficharegistroentrada ON tb_ficharegistroentrada.tbFichRe_id = tb_fichaevaluacion.tbFichEva_IDfichaEntrada
                        INNER JOIN tb_alumno ON tb_ficharegistroentrada.tbFichRe_id = tb_alumno.tbAlum_idFichaEntrada
                        INNER JOIN tb_evaluador ON tb_alumno.tbAlum_Evaluador = tb_evaluador.tbEva_id
                        INNER JOIN tb_categoria ON tb_categoria.tbCatego_id = tb_alumno.tbAlum_categoria
                        GROUP BY tb_alumno.tbAlum_alumno";
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }

    function Get_ListadoFechas() {
        $this->query = "SELECT tb_ficharegistroentrada.tbFichRe_fecha FROM tb_fichaevaluacion
                        INNER JOIN tb_asignaciondocentesemana ON tb_asignaciondocentesemana.tbAsigDocSem_id = tb_fichaevaluacion.tbFichEva_IDsemana
                        INNER JOIN tb_ficharegistroentrada ON tb_ficharegistroentrada.tbFichRe_id = tb_fichaevaluacion.tbFichEva_IDfichaEntrada
                        INNER JOIN tb_alumno ON tb_ficharegistroentrada.tbFichRe_id = tb_alumno.tbAlum_idFichaEntrada
                        INNER JOIN tb_categoria ON tb_categoria.tbCatego_id = tb_alumno.tbAlum_categoria
                        GROUP BY tb_ficharegistroentrada.tbFichRe_fecha";
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }    

    function Get_listarEvaluadores() {
        $this->query = "SELECT tbEva_evaluador,tbEva_estado,tbEva_tipoPer, tbEva_id FROM tb_evaluador
                        WHERE tb_evaluador.tbEva_estado = 'Activo' AND tb_evaluador.tbEva_tipoPer = 'Evaluador'
                        ORDER BY tb_evaluador.tbEva_evaluador ASC";
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }



    // function insert_Evaluador($CmpEvaluador,$CmpDNI,$CmpEstado,$CmpTelefono,$CmpTipoPer,$CmpDescripcion){
    //     $this->query ="INSERT INTO `tb_evaluador`(`tbEva_fecha`, `tbEva_evaluador`, `tbEva_dni`, `tbEva_telefono`, `tbEva_estado`,`tbEva_tipoPer`, `tbEva_descripcion`) 
    //                    VALUES (now(),'$CmpEvaluador','$CmpDNI','$CmpTelefono','$CmpEstado', '$CmpTipoPer','$CmpDescripcion')";        
    //     $this->execute_single_query();
    //     return json_encode('registro');
    // } 

    // function seledInfo($codigoEvaluador) {
    //     $this->query = "SELECT tbEva_id,tbEva_fecha,tbEva_evaluador,tbEva_dni,tbEva_telefono,tbEva_estado,tbEva_tipoPer,tbEva_descripcion FROM tb_evaluador WHERE tbEva_id =".$codigoEvaluador;
    //     $this->execute_query();
    //     $data = $this->rows;
    //     return json_encode($data);
    // }     

    
    
    // function  eliminar_evaluador($Cmp_codeEva){
    //     $this->query = "DELETE FROM `tb_evaluador` WHERE `tbEva_id` =".$Cmp_codeEva;
    //     $this->execute_query();
    // }     


}
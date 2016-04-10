<?php

require "../config-be/ClsConexion.php";

class ClsEvento extends ClsConexion {

    //Para Listar Modulos
    function Get_MostrarEvento() {
        $this->query = "SELECT tbEvent_id,tbEvent_fecha,tbEvent_nombreEvento,tbEvent_Estado,tbEvent_hora,tbEvent_lugar,tbEvent_descripcion FROM tb_evento ORDER BY tb_evento.tbEvent_id DESC";
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }

    function insert_Evaluador($CmpEvaluador,$CmpDNI,$CmpEstado,$CmpTelefono,$CmpTipoPer,$CmpDescripcion){
        $this->query ="INSERT INTO `tb_evaluador`(`tbEva_fecha`, `tbEva_evaluador`, `tbEva_dni`, `tbEva_telefono`, `tbEva_estado`,`tbEva_tipoPer`, `tbEva_descripcion`) 
                       VALUES (now(),'$CmpEvaluador','$CmpDNI','$CmpTelefono','$CmpEstado', '$CmpTipoPer','$CmpDescripcion')";        
        $this->execute_single_query();
        return json_encode('registro');
    } 

    function seledInfo($codigoEvaluador) {
        $this->query = "SELECT tbEva_id,tbEva_fecha,tbEva_evaluador,tbEva_dni,tbEva_telefono,tbEva_estado,tbEva_tipoPer,tbEva_descripcion FROM tb_evaluador WHERE tbEva_id =".$codigoEvaluador;
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }     

    function editar_evaluador($cmp_idEva,$cmp_evaluador,$cmp_dni,$cmptelef,$cmp_estado,$cmp_tipo,$cmp_descrip){    
        $this->query = "UPDATE `tb_evaluador` SET `tbEva_evaluador`='$cmp_evaluador',`tbEva_dni`='$cmp_dni',`tbEva_telefono`='$cmptelef',`tbEva_estado`='$cmp_estado',`tbEva_tipoPer`='$cmp_tipo',`tbEva_descripcion`='$cmp_descrip' WHERE `tbEva_id` =".$cmp_idEva;        
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }     
    
    function  eliminar_evaluador($Cmp_codeEva){
        $this->query = "DELETE FROM `tb_evaluador` WHERE `tbEva_id` =".$Cmp_codeEva;
        $this->execute_query();
    }     


}
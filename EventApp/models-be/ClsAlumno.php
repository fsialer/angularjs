<?php

require "../config-be/ClsConexion.php";

class ClsAlumno extends ClsConexion {
    
    function Get_MostrarSemanas() {
        $this->query = "SELECT tbAsigDocSem_id,tbAsigDocSem_Semana,tbAsigDocSem_NumEvaluadores,tbAsigDocSem_NumVeedores FROM tb_asignaciondocentesemana ORDER BY tbAsigDocSem_id DESC";
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }

    function Get_MostrarSemanaAsignada() {
        $this->query = "SELECT tbSemAsigPer_id,tbSemAsigPer_dia,tbAsigDocSem_Semana,tbEva_evaluador,tbEva_tipoPer FROM tb_semanaasignadapersonal
                        INNER JOIN tb_evaluador ON tb_evaluador.tbEva_id = tb_semanaasignadapersonal.tbSemAsigPer_idPersonal
                        INNER JOIN tb_asignaciondocentesemana ON tb_asignaciondocentesemana.tbAsigDocSem_id = tb_semanaasignadapersonal.tbSemAsigPer_idSemana";
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }    

    function insert_Semana($Cmp_NomSemana,$Cmp_NumEvaluadores,$Cmp_NumVeedores){
        $this->query ="INSERT INTO `tb_asignaciondocentesemana`(`tbAsigDocSem_Semana`, `tbAsigDocSem_NumEvaluadores`, `tbAsigDocSem_NumVeedores`) 
                       VALUES ('$Cmp_NomSemana','$Cmp_NumEvaluadores','$Cmp_NumVeedores')";        
        $this->execute_single_query();
        return json_encode('registro');
    } 

    function insert_AsignacionPersonalSem($Cmp_dia,$Cmp_IDpersonal,$Cmp_IDsemana){
        $this->query ="INSERT INTO `tb_semanaasignadapersonal`(`tbSemAsigPer_dia`, `tbSemAsigPer_idPersonal`, `tbSemAsigPer_idSemana`) 
                       VALUES ('$Cmp_dia','$Cmp_IDpersonal','$Cmp_IDsemana')";        
        $this->execute_single_query();
        return json_encode('registro');
    }  

    function editar_semana($cmp_idSem,$cmp_semana,$cmp_numEva,$cmp_numVee){    
        $this->query = "UPDATE `tb_asignaciondocentesemana` SET `tbAsigDocSem_Semana`='$cmp_semana',`tbAsigDocSem_NumEvaluadores`='$cmp_numEva',`tbAsigDocSem_NumVeedores`='$cmp_numVee' WHERE `tbAsigDocSem_id`=".$cmp_idSem;        
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }     
    
    function editar_personalAsignado($cmp_idSemana,$cmp_idPersonal){    
        $this->query = "UPDATE `tb_semanaasignadapersonal` SET `tbSemAsigPer_idPersonal`= '$cmp_idPersonal' WHERE `tbSemAsigPer_idSemana`=".$cmp_idSemana;        
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }       
    
    function eliminar_semana($Cmp_codeSema){
        $this->query = "DELETE FROM `tb_asignaciondocentesemana` WHERE `tbAsigDocSem_id` =".$Cmp_codeSema;
        $this->execute_query();
    }     

    function eliminar_PERSONALasignado($Cmp_codeSemaASIG){
        $this->query = "DELETE FROM `tb_semanaasignadapersonal` WHERE `tbSemAsigPer_idSemana` =".$Cmp_codeSemaASIG;
        $this->execute_query();
    }  

}
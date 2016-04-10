<?php

require "../config-be/ClsConexion.php";

class ClsParticipante extends ClsConexion {

    //Para Listar Modulos
    function Get_listarParticipantes() {
        $this->query = "SELECT tb_parti_id,tb_parti_NombreApe,tb_parti_Cargo,tb_parti_InstitucionRe,tb_parti_correoElect,tb_parti_dniParti,tb_parti_telef2,tb_parti_descripcion,tb_parti_EstadoAsistencia,tb_parti_VerificarCertificado FROM tb_participantes";
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }

    function insert_participante($Cmp_nomParticipante,$Cmp_cargoParti,$Cmp_correoParti,$Cmp_institucionParti,$Cmp_dniParti,$Cmp_telfParti_2,$Cmp_descripParti){

        $this->query ="INSERT INTO `tb_participantes`(`tb_parti_NombreApe`, `tb_parti_Cargo`, `tb_parti_InstitucionRe`, `tb_parti_correoElect`, `tb_parti_dniParti`, `tb_parti_telef2`, `tb_parti_descripcion`, `tb_parti_EstadoAsistencia`, `tb_parti_VerificarCertificado`)
                       VALUES ('$Cmp_nomParticipante','$Cmp_cargoParti','$Cmp_institucionParti','$Cmp_correoParti','$Cmp_dniParti','$Cmp_telfParti_2','$Cmp_descripParti','FALTO','NO ENTREGADO')";        
        $this->execute_single_query();
        return json_encode('registro');
    }     

    function editar_Participante($cmp_AC_idParticipante,$Cmp_AC_nomParticipante,$Cmp_AC_cargoParti,$Cmp_AC_correoParti,$Cmp_AC_institucionParti,$Cmp_AC_dniParti,$Cmp_AC_telfParti_2,$Cmp_AC_descripParti){    
        $this->query = "UPDATE `tb_participantes` SET `tb_parti_NombreApe`='$Cmp_AC_nomParticipante',`tb_parti_Cargo`='$Cmp_AC_cargoParti',`tb_parti_InstitucionRe`='$Cmp_AC_institucionParti',`tb_parti_correoElect`='$Cmp_AC_correoParti',`tb_parti_dniParti`='$Cmp_AC_dniParti',`tb_parti_telef2`='$Cmp_AC_telfParti_2',`tb_parti_descripcion`='$Cmp_AC_descripParti' WHERE `tb_parti_id`=".$cmp_AC_idParticipante;        
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }     
    
    function eliminar_participante($Cmp_codeParti){
        $this->query = "DELETE FROM `tb_participantes` WHERE `tb_parti_id`=".$Cmp_codeParti;
        $this->execute_query();
    }     


}
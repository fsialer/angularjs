<?php

require "../config-be/ClsConexion.php";

class ClsUsuario extends ClsConexion {

    //Para Listar Modulos
    function Get_MostrarUsuarios() {
        $this->query = "SELECT tbUserS_id,tbUserS_fecha,tbUserS_nombreApe,tbUserS_dni,tbUserS_estado,tbUserS_tefl,tbUserS_tipo,tbUserS_user,tbUserS_password FROM tb_usuariossystem";
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }

    function insert_usuario($Cmp_peruser,$Cmp_dniU,$Cmp_estadoU,$Cmp_telfU,$Cmp_tipoU,$Cmp_userU,$Cmp_passU){
        $this->query ="INSERT INTO `tb_usuariossystem`(`tbUserS_fecha`, `tbUserS_nombreApe`, `tbUserS_dni`, `tbUserS_estado`, `tbUserS_tefl`, `tbUserS_tipo`, `tbUserS_user`, `tbUserS_password`)
                       VALUES (now(),'$Cmp_peruser','$Cmp_dniU','$Cmp_estadoU','$Cmp_telfU', '$Cmp_tipoU','$Cmp_userU','$Cmp_passU')";        
        $this->execute_single_query();
        return json_encode('registro');
    } 

    function seledInfouser($cmp_codeUser){
        $this->query = "SELECT tbUserS_id,tbUserS_fecha,tbUserS_nombreApe,tbUserS_dni,tbUserS_estado,tbUserS_tefl,tbUserS_tipo,tbUserS_user,tbUserS_password
                        FROM tb_usuariossystem WHERE tb_usuariossystem.tbUserS_id =".$cmp_codeUser;
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }     

    function editar_usuario($cmp_iduser,$cmp_usuario,$cmp_dni,$cmp_estado,$cmp_telf,$cmp_tipo,$cmp_user,$cmp_pass){    
        $this->query = "UPDATE `tb_usuariossystem` SET `tbUserS_nombreApe`= '$cmp_usuario',`tbUserS_dni`='$cmp_dni',`tbUserS_estado`='$cmp_estado',`tbUserS_tefl`= '$cmp_telf',`tbUserS_tipo`='$cmp_tipo',`tbUserS_user`='$cmp_user',`tbUserS_password`='$cmp_pass' WHERE `tbUserS_id`=".$cmp_iduser;        
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }     
    
    function  eliminar_user($Cmp_codeUSER){
        $this->query = "DELETE FROM `tb_usuariossystem` WHERE `tbUserS_id`=".$Cmp_codeUSER;
        $this->execute_query();
    }  

    function select_userVerificadoBD($cmp_passUser){
        $this->query = "SELECT tbUserS_nombreApe AS nombre,tbUserS_estado AS estado,tbUserS_tipo AS tipo,tbUserS_user AS `user`,tbUserS_password AS `password` FROM tb_usuariossystem
                        WHERE tbUserS_password =".$cmp_passUser;
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }       


}
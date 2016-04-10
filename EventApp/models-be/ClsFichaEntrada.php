<?php

require "../config-be/ClsConexion.php";

class ClsFichaEntrada extends ClsConexion {

    //Para Listar Modulos
    function Get_MostrarFichas() {
        $this->query = "SELECT tbFichRe_id,tbFichRe_fecha,tbFichRe_hora,tbFichRe_responsable,tbFichRe_dni FROM tb_ficharegistroentrada ORDER BY tbFichRe_id DESC";
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    } 

    function Get_MostrarCategoria() {
        $this->query = "SELECT tbCatego_id,tbCatego_Categoria,tbCatego_estado FROM tb_categoria WHERE tbCatego_estado = 'Activo' ";
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }    

    function Get_MostrarAlumnos() {
        $this->query = "SELECT tbAlum_id,tbAlum_idFichaEntrada,tbAlum_fechaRegistro,tbAlum_alumno,tbAlum_dni,tbAlum_categoria as idcategoria,tbCatego_Categoria,tbAlum_descripcion FROM tb_alumno
                        INNER JOIN tb_categoria ON tb_alumno.tbAlum_categoria = tb_categoria.tbCatego_id
                        ORDER BY tb_alumno.tbAlum_id DESC";
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }    

    function buscarCodigo($cmp_codigoBuscar) {
        $this->query = "SELECT tbAlum_id,tbAlum_codigoEspecial FROM tb_alumno WHERE tbAlum_codigoEspecial =".$cmp_codigoBuscar;
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }    

    function insert_FichaEntra($Cmp_FECHAexa,$Cmp_HORAexa,$Cmp_RESPONexa,$Cmp_DNIexa){
        $this->query ="INSERT INTO `tb_ficharegistroentrada`(`tbFichRe_fecha`, `tbFichRe_hora`, `tbFichRe_responsable`, `tbFichRe_dni`)
                       VALUES ('$Cmp_FECHAexa','$Cmp_HORAexa','$Cmp_RESPONexa','$Cmp_DNIexa')";        
        $this->execute_single_query();
        return json_encode('registro');
    }      

    function insert_AlumnoEva($Cmp_FECHA,$Cmp_idFichaRe,$Cmp_ALUMN0,$Cmp_DNI,$Cmp_CATEGORIA,$Cmp_CODIGOESPECIAL,$Cmp_DESCRIPCION){
        $this->query ="INSERT INTO `tb_alumno`(`tbAlum_idFichaEntrada`, `tbAlum_alumno`, `tbAlum_dni`, `tbAlum_categoria`, `tbAlum_codigoEspecial`, `tbAlum_descripcion`, `tbAlum_fechaRegistro`) 
                       VALUES ('$Cmp_idFichaRe','$Cmp_ALUMN0','$Cmp_DNI','$Cmp_CATEGORIA','$Cmp_CODIGOESPECIAL','$Cmp_DESCRIPCION','$Cmp_FECHA')";        
        $this->execute_single_query();
        return json_encode('registro');
    }     

    function editar_ficha($cmp_id,$cmp_fecha,$cmp_hora,$cmp_respon,$cmp_dni){    
        $this->query = "UPDATE `tb_ficharegistroentrada` SET `tbFichRe_fecha`='$cmp_fecha',`tbFichRe_hora`='$cmp_hora',`tbFichRe_responsable`='$cmp_respon',`tbFichRe_dni`='$cmp_dni' WHERE `tbFichRe_id`=".$cmp_id;        
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }     

    function editar_AlumnoEva($cmp_idEva,$cmp_alumEva,$cmp_dniEva,$cmp_cateEva,$cmp_descripEva){    
        $this->query = "UPDATE `tb_alumno` SET `tbAlum_alumno`='$cmp_alumEva',`tbAlum_dni`='$cmp_dniEva',`tbAlum_categoria`='$cmp_cateEva',`tbAlum_descripcion`='$cmp_descripEva' WHERE `tbAlum_id`=".$cmp_idEva;        
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    } 

    function  eliminar_Ficha($Cmp_codeFicha){
        $this->query = "DELETE FROM `tb_ficharegistroentrada` WHERE `tbFichRe_id` =".$Cmp_codeFicha;
        $this->execute_query();
    }     

    function  eliminar_Alum($Cmp_codeAlum){
        $this->query = "DELETE FROM `tb_alumno` WHERE `tbAlum_id` =".$Cmp_codeAlum;
        $this->execute_query();
    } 

    function  eliminar_AlumnosFicha($Cmp_codeFichaAlu) {
        $this->query = "DELETE FROM `tb_alumno` WHERE `tbAlum_idFichaEntrada` =".$Cmp_codeFichaAlu;
        $this->execute_query();
    }     

}
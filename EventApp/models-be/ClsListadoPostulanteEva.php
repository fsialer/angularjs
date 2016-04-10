<?php

require "../config-be/ClsConexion.php";

class ClsListadoPostulanteEva extends ClsConexion {

    //Para Listar Modulos
    function Get_MostrarlistarFichasEvaluadores() {
        $this->query = "SELECT tb_fichaevaluacion.tbFichEva_ID,tb_asignaciondocentesemana.tbAsigDocSem_Semana, tb_ficharegistroentrada.tbFichRe_fecha, Count(tb_alumno.tbAlum_alumno) AS NumeroPostulantes, tb_asignaciondocentesemana.tbAsigDocSem_id, tb_ficharegistroentrada.tbFichRe_id FROM tb_fichaevaluacion
                        INNER JOIN tb_asignaciondocentesemana ON tb_asignaciondocentesemana.tbAsigDocSem_id = tb_fichaevaluacion.tbFichEva_IDsemana
                        INNER JOIN tb_ficharegistroentrada ON tb_ficharegistroentrada.tbFichRe_id = tb_fichaevaluacion.tbFichEva_IDfichaEntrada
                        INNER JOIN tb_alumno ON tb_ficharegistroentrada.tbFichRe_id = tb_alumno.tbAlum_idFichaEntrada
                        GROUP BY tb_fichaevaluacion.tbFichEva_ID, tb_asignaciondocentesemana.tbAsigDocSem_Semana, tb_ficharegistroentrada.tbFichRe_fecha
                        ORDER BY tb_fichaevaluacion.tbFichEva_ID DESC";
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }

    function Get_listarSemanas() {
        $this->query = "SELECT tbAsigDocSem_id, tbAsigDocSem_Semana FROM tb_asignaciondocentesemana";
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);    
    }

    function Get_listarfichasEntradas() {
        $this->query = "SELECT tbFichRe_id,tbFichRe_fecha FROM tb_ficharegistroentrada";
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);    
    }

    function Get_listarcategorias() {
        $this->query = "SELECT tbCatego_id,tbCatego_Categoria FROM tb_categoria WHERE tb_categoria.tbCatego_estado = 'Activo' ";
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);    
    }

    function Get_listadoPostulantes() {
        $this->query = "SELECT tb_alumno.tbAlum_codigoEspecial,tb_categoria.tbCatego_Categoria,tb_ficharegistroentrada.tbFichRe_fecha,tb_asignaciondocentesemana.tbAsigDocSem_Semana,tb_asignaciondocentesemana.tbAsigDocSem_id,tb_alumno.tbAlum_id FROM tb_fichaevaluacion
                         INNER JOIN tb_asignaciondocentesemana ON tb_asignaciondocentesemana.tbAsigDocSem_id = tb_fichaevaluacion.tbFichEva_IDsemana
                         INNER JOIN tb_ficharegistroentrada ON tb_ficharegistroentrada.tbFichRe_id = tb_fichaevaluacion.tbFichEva_IDfichaEntrada
                         INNER JOIN tb_alumno ON tb_ficharegistroentrada.tbFichRe_id = tb_alumno.tbAlum_idFichaEntrada
                         INNER JOIN tb_categoria ON tb_categoria.tbCatego_id = tb_alumno.tbAlum_categoria
                         GROUP BY tb_alumno.tbAlum_alumno";
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);    
    }  


    function insert_fichaEvaluacion($Cmp_cmpIDSemana,$Cmp_cmpIDFichaEntrada){
        $this->query ="INSERT INTO `tb_fichaevaluacion`(`tbFichEva_IDsemana`, `tbFichEva_IDfichaEntrada`) 
                       VALUES ('$Cmp_cmpIDSemana','$Cmp_cmpIDFichaEntrada')";        
        $this->execute_single_query();
        return json_encode('registro');
    } 
    

    function editar_FichaEvaluacion($cmp_IDfichaEva,$cmp_IDsemana,$cmp_IDfichaEn){    
        $this->query = "UPDATE `tb_fichaevaluacion` SET `tbFichEva_IDsemana`= '$cmp_IDsemana',`tbFichEva_IDfichaEntrada`= '$cmp_IDfichaEn' WHERE `tbFichEva_ID`=".$cmp_IDfichaEva;        
        $this->execute_query();
        $data = $this->rows;
        return json_encode($data);
    }     

    function eliminar_FichaEvaluacion($Cmp_codeFichaEva){
        $this->query = "DELETE FROM `tb_fichaevaluacion` WHERE `tbFichEva_ID` =".$Cmp_codeFichaEva;
        $this->execute_query();
    }     


}
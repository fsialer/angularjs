<?php

require ('../components/fpdf17/fpdf.php');

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "bd_sienco";	

// $conn = new mysqli($servername, $username, $password, $dbname);
// if ($conn->connect_error) {
//     die("Conexion Fallada: " . $conn->connect_error);
// }
// $conn->query("SET NAMES utf8");



	$semana = $_GET['se'];
	// $categoria_1 = $_GET['c1'];
	// $categoria_2 = $_GET['c2'];
	// $categoria_3 = $_GET['c3'];

class PDF extends FPDF
{
	// Cabecera de página
	function Header()
	{
	    // Logo
	    $this->Image('../imagenes/lista.png',15,8,15);	    
	    // Arial bold 15
	    $this->SetFont('Arial','B',10);
	    // Movernos a la derecha
	    $this->Cell(30);
	    // Título    	    
	    $this->Cell(200,4,'GERENCIA REGIONAL DE TRANSPORTE Y COMUNICIONES',1,1,'C');
	    $this->Cell(50,10,'',0);
	    $this->SetFont('Arial','B',9);
	    $this->Cell(40,10,'.: SISTEMA DE ENCRIPTACION PARA CONDUCTORES :.',0);	
	    $this->Image('../imagenes/lista.png',180,8,15);    	    	    
	    // Salto de línea
	    $this->Ln(10);
	}

	// Pie de página
	function Footer()
	{
	    // Posición: a 1,5 cm del final
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Número de página
	    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}	
}
	// Creación del objeto de la clase heredada
	$pdf = new PDF('L','mm','A4');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','B',12);
	$pdf->ln(4.5);

	$pdf->Cell(275,10,':: CRONOGRAMA ASIGNADO A LOS EVALUADORES - '.$semana.' ::',1,1,'C');
	$pdf->ln(2);
	$pdf->SetFont('Times','',9);
	$pdf->Cell(275,10,'El siguiente cronograma muestra los dias que les corresponde realizar la evaluación a los postulantes por parte del personal evaluador',0,0,'C');	
	$pdf->Ln(10);

	$pdf->SetFont('Times','B',8);	

	$pdf->Cell(15,7,'ITEM',1,0,'C');
	$pdf->Cell(52,7,'LUNES',1,0,'C');
	$pdf->Cell(52,7,'MARTES',1,0,'C');
	$pdf->Cell(52,7,'MIERCOLES',1,0,'C');	
	$pdf->Cell(52,7,'JUEVES',1,0,'C');	
	$pdf->Cell(52,7,'VIERNES',1,0,'C');	
	$pdf->Ln(10);
	$pdf->SetFont('Times','',9);
	$pdf->Cell(15,7,'1',1,0,'C');
	$pdf->Cell(52,7,'Angel Joel Plaza Bustamante',1,0,'C');
	$pdf->Cell(52,7,'Angel Joel Plaza Bustamante',1,0,'C');
	$pdf->Cell(52,7,'Angel Joel Plaza Bustamante',1,0,'C');
	$pdf->Cell(52,7,'Angel Joel Plaza Bustamante',1,0,'C');
	$pdf->Cell(52,7,'Angel Joel Plaza Bustamante',1,0,'C');				
	
 //   //CONSULTA

 //    $ListaPostulantesFiltrados = $conn->query("SELECT tbFichRe_fecha,tbAlum_dni,tbAlum_codigoEspecial,tbCatego_Categoria FROM tb_fichaevaluacion
	// 											INNER JOIN tb_asignaciondocentesemana ON tb_asignaciondocentesemana.tbAsigDocSem_id = tb_fichaevaluacion.tbFichEva_IDsemana
	// 											INNER JOIN tb_ficharegistroentrada ON tb_ficharegistroentrada.tbFichRe_id = tb_fichaevaluacion.tbFichEva_IDfichaEntrada
	// 											INNER JOIN tb_alumno ON tb_ficharegistroentrada.tbFichRe_id = tb_alumno.tbAlum_idFichaEntrada
	// 											INNER JOIN tb_categoria ON tb_categoria.tbCatego_id = tb_alumno.tbAlum_categoria
	// 											WHERE tbFichRe_fecha = '".$fecha."' AND ((tbCatego_Categoria = '".$categoria_1."')or(tbCatego_Categoria = '".$categoria_2."')or(tbCatego_Categoria = '".$categoria_3."'))
	// 											ORDER BY RAND()");

	// $item = 0;

 //    while ($ListaPostulantesFiltradosNEW = $ListaPostulantesFiltrados->fetch_assoc()) {
 //    	$item = $item + 1;
	// 	$pdf->Cell(16);
	// 	$pdf->Cell(15,7,$item,1,0,'C');
	// 	$pdf->SetFont('Times','',10);
	// 	$pdf->Cell(50,7,$ListaPostulantesFiltradosNEW['tbAlum_codigoEspecial'],1,0,'C');
	// 	$pdf->SetFont('Times','',9);
	// 	$pdf->Cell(30,7,$ListaPostulantesFiltradosNEW['tbCatego_Categoria'],1,0,'C');		
	// 	$pdf->Cell(60,7,'',1,0,'C');
	// 	$pdf->Ln(6);

 //    }

	$pdf->Output();
	// $conn->close();
?>
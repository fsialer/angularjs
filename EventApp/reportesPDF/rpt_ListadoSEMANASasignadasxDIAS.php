<?php

require ('../components/fpdf17/fpdf.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_sienco";	

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexion Fallada: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8");



	$semana = $_GET['s'];
	$dia = $_GET['d'];	

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
	    $this->Cell(132,4,'GERENCIA REGIONAL DE TRANSPORTE Y COMUNICIONES',0,1,'C');
	    $this->Cell(30);
	    $this->SetFont('Arial','B',9);
	    $this->Cell(132,10,'.: SISTEMA DE ENCRIPTACION PARA CONDUCTORES :.',0,1,'C');	
	    $this->Image('../imagenes/lista.png',180,8,15);    	    	    
	    // Salto de línea    
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
	$pdf = new PDF('L','mm',array(150,210));
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','B',12);

	$pdf->Ln(2);
	$pdf->Cell(190,10,':: CRONOGRAMA ASIGNADO A LOS EVALUADORES - '.$semana.' - '.$dia.' ::',1,1,'C');
	$pdf->ln(2);
	$pdf->SetFont('Times','',9);
	$pdf->Cell(190,10,utf8_decode("El siguiente cronograma muestra los dias que les corresponde realizar la evaluación a los postulantes por parte del personal evaluador"),0,0,'C');	
	$pdf->Ln(10);	

	$pdf->Cell(15);
	$pdf->SetFont('Times','B',9);	
	$pdf->Cell(30,6,'ITEM',1,0,'C');
	$pdf->Cell(80,6,'PERSONA',1,0,'C');	
	$pdf->Cell(50,6,'TIPO',1,0,'C');	
	$pdf->Ln(10);

   //CONSULTA

   $ListaPersEva = $conn->query("SELECT tbEva_evaluador,tbEva_tipoPer FROM tb_semanaasignadapersonal
								 INNER JOIN tb_evaluador ON tb_evaluador.tbEva_id = tb_semanaasignadapersonal.tbSemAsigPer_idPersonal
								 INNER JOIN tb_asignaciondocentesemana ON tb_asignaciondocentesemana.tbAsigDocSem_id = tb_semanaasignadapersonal.tbSemAsigPer_idSemana
								 WHERE tb_asignaciondocentesemana.tbAsigDocSem_Semana = '".$semana."' AND tb_semanaasignadapersonal.tbSemAsigPer_dia = '".$dia."'");

   $item = 0;

    while ($ListaPersEvaNEW = $ListaPersEva->fetch_assoc()) {
    	$item = $item + 1;

    	$dataEva = $ListaPersEvaNEW['tbEva_evaluador'];
    	$datatipo = $ListaPersEvaNEW['tbEva_tipoPer'];

		$pdf->Cell(15);	
		$pdf->SetFont('Times','',9);
		$pdf->Cell(30,5,$item,0,0,'C');
		$pdf->Cell(80,5,utf8_decode($dataEva),0,0,'C');
		$pdf->Cell(50,5,utf8_decode($datatipo),0,0,'C');		
		$pdf->Ln(6);
    }

	$pdf->Output();
	$conn->close();
?>
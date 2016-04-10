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
	    $this->Cell(80);
	    // Título    	    
	    $this->Cell(30,4,'GERENCIA REGIONAL DE TRANSPORTE Y COMUNICIONES',0,1,'C');
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
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','B',12);
	$pdf->ln(4.5);
	$pdf->Cell(188,10,':: RESULTADOS OBTENIDOS ::',1,1,'C');
	$pdf->ln(4.5);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(40,10,utf8_decode("En la siguiente lista de muestra la relación de todos los postulantes con sus respectivos resultados, dicha evaluación se realizó el."),0);	
	$pdf->Ln(5);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(18,10,utf8_decode($_POST['fechaU']),0); // FECHA DEL REGISTRO DE LA FICHA
	$pdf->SetFont('Times','',10);
	$pdf->Cell(40,10,utf8_decode("del presente año."),0);
	$pdf->Ln(15);
	$pdf->SetFont('Times','B',8);	
	$pdf->Cell(15,7,'ITEM',1,0,'C');
	$pdf->Cell(50,7,'CODIGO DEL POSTULANTE',1,0,'C');
	$pdf->Cell(30,7,'CATEGORIA',1,0,'C');
	$pdf->Cell(30,7,'RESULTADO',1,0,'C');
	$pdf->Cell(63,7,'EVALUADOR',1,0,'C');
	$pdf->Ln(10);
	$pdf->SetFont('Times','B',8);
	
	//CONSULTA

    $ListaResultados = $conn->query("SELECT tbAlum_codigoEspecial,tbCatego_Categoria,tbAlum_Resultado,tbEva_evaluador FROM tb_alumno 
									 INNER JOIN tb_categoria ON tb_categoria.tbCatego_id = tb_alumno.tbAlum_categoria
									 INNER JOIN tb_evaluador ON tb_evaluador.tbEva_id = tb_alumno.tbAlum_Evaluador
									 WHERE tbAlum_fechaRegistro ='".$_POST['fechaU']."'");
	$item = 0;

    while ($ListaResultadosNEW = $ListaResultados->fetch_assoc()) {
    	$item = $item + 1;

    	$alumCodeEspe = $ListaResultadosNEW['tbAlum_codigoEspecial'];
    	$alumnoCate = $ListaResultadosNEW['tbCatego_Categoria'];
    	$alumnoresultado = $ListaResultadosNEW['tbAlum_Resultado'];
    	$alumnoevalaudor = $ListaResultadosNEW['tbEva_evaluador'];

    	$pdf->Cell(15,7,$item,0,0,'C');
		$pdf->Cell(50,7,utf8_encode($alumCodeEspe),0,0,'C');
		$pdf->Cell(30,7,utf8_encode($alumnoCate),0,0,'C');
		$pdf->Cell(30,7,utf8_encode($alumnoresultado),0,0,'C');	
		$pdf->Cell(75,7,utf8_encode($alumnoevalaudor),0,0,'C');
		$pdf->Ln(6);

    }

    $pdf->Ln(10);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(188,10,utf8_encode(":: RESPONSABLES DE LA EVALUACIÓN ::"),1,1,'C');
	$pdf->Ln(5);
	$pdf->SetFont('Times','B',8);
	$pdf->Cell(10,7,'',0,0,'C');
	$pdf->Cell(74,7,'Evaluadores',0,0,'C');
	$pdf->Cell(40,7,'DNI',0,0,'C');
	$pdf->Cell(40,7,'Firma',0,0,'C');	
	$pdf->Ln(15);

    $listaEvaluadores = $conn->query("SELECT tbAlum_fechaRegistro, tbEva_evaluador, tbEva_dni FROM tb_alumno 
    								  INNER JOIN tb_evaluador ON tb_evaluador.tbEva_id = tb_alumno.tbAlum_Evaluador
    								  WHERE tbAlum_fechaRegistro = '".$_POST['fechaU']."' 
    								  GROUP BY tb_alumno.tbAlum_Evaluador");

	while ( $listaEvaluadoresNew = $listaEvaluadores->fetch_assoc()) {
			$pdf->Cell(10,7,'',0,0,'C');
			$pdf->Cell(74,7,$listaEvaluadoresNew['tbEva_evaluador'],0,0,'C');
			$pdf->Cell(40,7,$listaEvaluadoresNew['tbEva_dni'],0,0,'C');
			$pdf->Cell(40,7,'--------------------------------------',0,0,'C');				
			$pdf->Ln(10);
	    }    
   	
	$pdf->Output();
	$conn->close();
?>
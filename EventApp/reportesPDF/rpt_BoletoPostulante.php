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


$ID_POSTULANTE = $_GET['idfechaRegistrado'];

//consulta mysql
    $datoPostulante = $conn->query("SELECT tbAlum_id, tbFichRe_fecha, tbFichRe_hora,tbFichRe_responsable,tbFichRe_dni,tbAlum_codigoEspecial,tbCatego_Categoria FROM tb_alumno
									INNER JOIN tb_ficharegistroentrada ON tb_ficharegistroentrada.tbFichRe_id = tb_alumno.tbAlum_idFichaEntrada
									INNER JOIN tb_categoria ON tb_categoria.tbCatego_id = tb_alumno.tbAlum_categoria
									WHERE tb_alumno.tbAlum_id = '".$ID_POSTULANTE."'");


	    while ($datoPostulanteNEW = $datoPostulante->fetch_assoc()) {  	

	    	$fechaRegistro = $datoPostulanteNEW['tbFichRe_fecha'];
	    	$horaRegistro = $datoPostulanteNEW['tbFichRe_hora'];
	    	$responsableRegistro = $datoPostulanteNEW['tbFichRe_responsable'];
	    	$dniRespon = $datoPostulanteNEW['tbFichRe_dni'];

	    	$categoria = $datoPostulanteNEW['tbCatego_Categoria'];
	    	$codigoEspecial = $datoPostulanteNEW['tbAlum_codigoEspecial'];
	    }    


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
	$pdf = new PDF('L','mm',array(150,210));
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->SetFont('Times','B',12);
	$pdf->ln(4.5);
	$pdf->Cell(188,10,utf8_decode(":: BOLETO DE INCRIPCIÓN PARA LA EVALUACIÓN ::"),1,1,'C');
	$pdf->ln(4.5);

	$pdf->SetFont('Times','',10);
	$pdf->Cell(20,7,'Fecha:',0,0,'C');
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(40,7,$fechaRegistro. " | ".$horaRegistro ,0,0,'C');

	$pdf->Cell(2);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(29,7,'Registrado por:',0,0,'C');
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(45,7,utf8_encode($responsableRegistro),0,0,'C');

	$pdf->Cell(2);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(20,7,'DNI:',0,0,'C');
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(30,7,$dniRespon,0,0,'C');

	$pdf->ln(13);
	$pdf->Cell(80);
	$pdf->Cell(30,4,':: DATOS DEL POSTULANTE ::',0,1,'C');
	$pdf->Cell(80);
	$pdf->Cell(30,4,'--------------------------------------------------------------',0,1,'C');
	$pdf->ln(2);

	$pdf->Cell(4);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(30,10,'Categoria:',1,0,'C');
	$pdf->SetFont('Times','B',20);
	$pdf->Cell(58,10,$categoria,1,0,'C');

	$pdf->Cell(2);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(30,10,'Codigo:',1,0,'C');
	$pdf->SetFont('Times','B',20);
	$pdf->Cell(58,10,$codigoEspecial,1,0,'C');

	$pdf->ln(13);
	$pdf->Cell(80);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(30,4,utf8_decode(":: DATOS DEL RESULTADO DE LA EVALUACIÓN ::"),0,1,'C');
	$pdf->Cell(80);
	$pdf->Cell(30,4,'--------------------------------------------------------------',0,1,'C');
	$pdf->ln(2);

	$pdf->Cell(4);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(30,10,'Evaluador:',1,0,'C');
	$pdf->SetFont('Times','',10);
	$pdf->Cell(58,10,'',1,0,'C');

	$pdf->Cell(2);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(30,10,'Resultado:',1,0,'C');
	$pdf->SetFont('Times','B',20);
	$pdf->Cell(58,10,'',1,0,'C');	


	$pdf->Output();
	$conn->close();
?>
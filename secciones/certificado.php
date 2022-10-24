<?php

// Libreria FPDF
require('../librerias/fpdf/fpdf.php');

// Recuperando los datos de la DB, para poder agregarlos al DOC. PDF
include_once('../configuraciones/conexion.php');
$conexionDB = DB::crearInstancia(); // Conexion a la DB



function agregarTexto($pdf, $texto, $x, $y, $align='L', $fuente, $size=20, $r=0,$g=0,$b=0){
        $pdf->SetFont($fuente,"", $size);
        $pdf->SetXY($x, $y);
        $pdf->SetTextColor($r,$g,$b);
        $pdf->Cell(0, 10, $texto, 0,0, $align);
}

function agregarImagen($pdf, $imagen, $x, $y){
        $pdf->Image($imagen, $x, $y, 0);
}



$id_curso = isset($_GET['id_curso']) ? $_GET['id_curso']:'';
$id_alumno = isset($_GET['id_alumno']) ? $_GET['id_alumno']:'';

$sql = "SELECT alumnos.nombre, alumnos.apellidos, cursos.nombre_curso 
        FROM alumnos, cursos WHERE alumnos.id=:id_alumno AND cursos.id=:id_curso";
$consulta = $conexionDB->prepare($sql);
$consulta->bindParam(':id_alumno', $id_alumno);
$consulta->bindParam(':id_curso', $id_curso);
$consulta->execute();
$alumno = $consulta->fetch(PDO::FETCH_ASSOC);



// Genaracion del PDF - Creacion del certificado
$pdf = new FPDF("L", "mm", array(350, 190));
$pdf->AddPage();
$pdf->SetFont('Arial','B', 16);
agregarImagen($pdf, "../src/certificado.jpg",0,0);
agregarTexto($pdf, ucwords(utf8_decode($alumno['nombre']." ".$alumno['apellidos'])), 108,55, 'L', 'Helvetica', 35,0,84,115);
agregarTexto($pdf, $alumno['nombre_curso'], -375,100, 'C', 'Helvetica', 27,0,84,115);
agregarTexto($pdf, date('d/m/Y'), -390,158, 'C', 'Helvetica', 17,0,84,115);
$pdf->Output();



?>
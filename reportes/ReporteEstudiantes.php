<?php
    //Se inserta código del archivo php para la conexión de la base de datos.
    require '../php/ConexionBD.php';
    //Se inserta código del archivo php para hacer uso de la libreria fpdf.
    require '../libreria/fpdf/fpdf.php';
    //Se obtiene el id del profesor.
    $idProfesor = $_GET['idProfesor'];
    $pdf = new FPDF();
    class pdf extends FPDF{
        //Encabezado de la página
        public function header(){
            $this->SetFont('Arial','B',15);
            $this->Cell(0,10,utf8_decode("AHORCADO PARA LA EDUCACIÓN"),0,0,'C');
            $this->Image('../imagenes/logo.png',10,5,20,20,'png');
        }
        //Pie de página
        public function footer(){
            $this->SetFont('Arial','B',10);
            $this->SetY(-15);
            $this->Write(5,utf8_decode("Ahorcado para la educación"));
            $this->SetX(-38);
            $this->AliasNbPages('tpagina');
            $this->write(5,$this->PageNo().'/tpagina');
        }
    }
    //Se crea el tamaño de la hoja y la orientación
    $pdf = new PDF('L','mm','letter',true);
    $pdf->AddPage("LANDSCAPE","letter");
    $pdf->SetMargins(10,20,20,20);
    $pdf->SetY(30);
    $pdf->SetFont('Arial','',18);
    $pdf->SetTextColor(0,0,0);
    //Titulo del reporte
    $pdf->Cell(0,0,utf8_decode('REPORTE DE ESTUDIANTES PARTICIPANTES'),0,0,'C');
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(20);
    //Información del profesor
    $buscar=mysqli_query($conn,"SELECT nombre, apPaterno, apMaterno, email FROM Profesor WHERE idProfesor = '".$idProfesor."'");
    $filas=mysqli_fetch_array($buscar);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(20,5,utf8_decode('Información del Profesor'));
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Cell(40,5,utf8_decode('IDProfesor:'));
    $pdf->Cell(20,5,utf8_decode($idProfesor));
    $pdf->Ln();
    $pdf->Cell(40,5,utf8_decode('Nombre:'));
    $pdf->Cell(20,5,utf8_decode($filas['nombre']));
    $pdf->Ln();
    $pdf->Cell(40,5,utf8_decode('Apellido Paterno: '));
    $pdf->Cell(20,5,utf8_decode($filas['apPaterno']));
    $pdf->Ln();
    $pdf->Cell(40,5,utf8_decode('Apellido Materno: '));
    $pdf->Cell(20,5,utf8_decode($filas['apMaterno']));
    $pdf->Ln();
    $pdf->Cell(40,5,utf8_decode('E-mail: '));
    $pdf->Cell(20,5,utf8_decode($filas['email']));
    $pdf->Ln(10);
    //Información de los estudiantes 
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(20,5,utf8_decode('Lista de estudiantes participantes en los juegos'));
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->SetFillColor(255,171,24);
    $pdf->SetTextColor(40,40,40);
    $pdf->SetDrawColor(255,255,255);
    $pdf->MultiAlignCell( 40, 10, 'Matricula',0,0,'C',1);
    $pdf->MultiAlignCell( 50, 10,utf8_decode('Nombre'),0,0,'C',1);
    $pdf->MultiAlignCell( 50, 10,utf8_decode('Paterno'),0,0,'C',1);
    $pdf->MultiAlignCell( 50, 10,utf8_decode('Materno'),0,0,'C',1);
    $pdf->MultiAlignCell( 70, 10,utf8_decode('E-mail'),0,0,'C',1);
    //Query que extrae los datos de los estudiantes que han participado en las partidas.
    $sentencia="SELECT Estudiante.Matricula,Nom, Paterno, Materno, CorreoElectronico FROM Estudiante INNER JOIN
    Equipo on Equipo.Matricula = Estudiante.Matricula INNER JOIN Partida on Equipo.idPartida = Partida.idPartida
    INNER JOIN Juego on Juego.idJuego = Partida.idJuego WHERE Juego.idProfesor = '".$idProfesor."' GROUP BY Estudiante.Matricula";
    $resultado=mysqli_query($conn,$sentencia);
    $pdf->SetFillColor(202,202,202);
    $pdf->SetTextColor(40,40,40);
    $pdf->SetDrawColor(255,255,255);
    $pdf->Ln(15);
    //Se imprimen los datos obtenidos.
    while($filas=mysqli_fetch_assoc($resultado)){
        $pdf->MultiAlignCell( 40, 10,utf8_decode($filas['Matricula']),1,0,'C',1);
        $pdf->MultiAlignCell( 50, 10,utf8_decode($filas['Nom']),1,0,'C',1);
        $pdf->MultiAlignCell( 50, 10,utf8_decode($filas['Paterno']),1,0,'C',1);
        $pdf->MultiAlignCell( 50, 10,utf8_decode($filas['Materno']),1,0,'C',1);
        $pdf->MultiAlignCell( 70, 10,utf8_decode($filas['CorreoElectronico']),1,0,'C',1);
        $pdf->Ln(20);
    }
    $pdf->Output();//Se muestra el reporte.
    mysqli_close($conn); //Se cierra la conexión de la bd.
?>
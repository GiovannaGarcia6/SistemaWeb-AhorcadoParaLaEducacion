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
    $pdf->Cell(0,0,utf8_decode('REPORTE DE LOS JUEGOS CREADOS'),0,0,'C');
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
    //Información de los juegos 
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(20,5,utf8_decode('Información de los juegos'));
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetDrawColor(88,88,88);
    $pdf->MultiAlignCell( 30, 7, 'IDJuego',0,0,'C',1);
    $pdf->MultiAlignCell( 50, 7,utf8_decode('Titulo'),0,0,'C',1);
    $pdf->MultiAlignCell( 50, 7,utf8_decode('Palabras'),0,0,'C',1);
    $pdf->MultiAlignCell( 60, 7,utf8_decode('Pistas'),0,0,'C',1);
    $pdf->MultiAlignCell( 20, 7,utf8_decode('N° de Equipos'),0,0,'C',1);
    $pdf->MultiAlignCell( 50, 7,utf8_decode('Categoria'),0,0,'C',1);
    $pdf->SetDrawColor(255,171,24);
    $pdf->SetLineWidth(2);
    $pdf->Line(11,$pdf->GetX()-155,270,$pdf->GetY()+15);
    //Query que extrae los datos de los juegos creados
    $sentencia="SELECT idJuego, Titulo,Palabras, Pistas, numEquipos, NomCategoria FROM Juego 
    INNER JOIN Categoria ON Categoria.idCategoria = Juego.idCategoria WHERE Juego.idProfesor = '".$idProfesor."'";
    $resultado=mysqli_query($conn,$sentencia);
    $pdf->Ln(20);
    //Se imprimen los datos obtenidos.
    while($filas=mysqli_fetch_assoc($resultado)){
        $pdf->MultiAlignCell( 30, 7, utf8_decode($filas['idJuego']),0);
        $pdf->MultiAlignCell( 50, 7, utf8_decode($filas['Titulo']));
        $pdf->MultiAlignCell( 60, 7, utf8_decode($filas['Palabras']), 0);
        $pdf->MultiAlignCell( 55, 7, utf8_decode($filas['Pistas']), 0);
        $pdf->MultiAlignCell( 20, 7, utf8_decode($filas['numEquipos']), 0);
        $pdf->MultiAlignCell( 40, 7, utf8_decode($filas['NomCategoria']), 0);
        $pdf->Ln(20);
    }
    $pdf->Output();//Se muestra el reporte.
    mysqli_close($conn); //Se cierra la conexión de la bd.
?>
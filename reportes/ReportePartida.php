<?php
    //Se inserta código del archivo php para la conexión de la base de datos.
    require '../php/ConexionBD.php';
    //Se inserta código del archivo php para hacer uso de la libreria fpdf.
    require '../libreria/fpdf/fpdf.php';
    //Se obtiene el id de la partida.
    $idPartida = $_GET['idPartida'];
    //Query para obtener el id del juego del que se creo la partida.
    $sql = "SELECT idJuego WHERE id = '".$idPartida."'";
    $buscar=mysqli_query($conn,"SELECT idJuego FROM Partida WHERE idPartida='".$idPartida."' ");
    $filas=mysqli_fetch_array($buscar);
    $idJuego = $filas['idJuego'];
    $pdf = new FPDF();
    class pdf extends FPDF{
        //Encabezado de la página.
        public function header(){
            $this->SetFont('Arial','B',15);
            $this->Cell(0,0,utf8_decode("AHORCADO PARA LA EDUCACIÓN"),0,0,'C');
            $this->Image('../imagenes/logo.png',190,5,20,20,'png');
        }
        //Pie de página.
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
    $pdf = new PDF('P','mm','letter',true);
    $pdf->AddPage("PORTRAIT","letter");
    $pdf->SetMargins(10,20,20,20);
    $pdf->SetY(30);
    $pdf->SetFont('Arial','',18);
    $pdf->SetTextColor(0,0,0);
    //Titulo del reporte
    $pdf->Cell(0,0,utf8_decode('REPORTE DE PARTIDA'),0,0,'C');
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(20);//Salto de línea.
    //Información del juego
    $buscar=mysqli_query($conn,"SELECT Titulo,Palabras, Pistas, numEquipos, NomCategoria FROM Juego 
    INNER JOIN Categoria ON Categoria.idCategoria = Juego.idCategoria WHERE idJuego = '".$idJuego."'");
    $filas=mysqli_fetch_array($buscar);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(20,5,utf8_decode('Información del Juego'));
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Cell(20,5,utf8_decode('IDJuego:'));
    $pdf->Cell(20,5,utf8_decode($idJuego));
    $pdf->Ln();
    $pdf->Cell(20,5,utf8_decode('Titulo:'));
    $pdf->Cell(20,5,utf8_decode($filas['Titulo']));
    $pdf->Ln();
    $pdf->Cell(20,5,utf8_decode('Palabras: '));
    $pdf->Cell(20,5,utf8_decode($filas['Palabras']));
    $pdf->Ln();
    $pdf->Cell(20,5,utf8_decode('Pistas: '));
    $pdf->Cell(20,5,utf8_decode($filas['Pistas']));
    $pdf->Ln();
    $pdf->Cell(30,5,utf8_decode('N° de Equipos: '));
    $pdf->Cell(20,5,utf8_decode($filas['numEquipos']));
    $pdf->Ln();
    $pdf->Cell(20,5,utf8_decode('Categoria: '));
    $pdf->Cell(40,5,utf8_decode($filas['NomCategoria']));
    $pdf->Ln(10);

    //Query que extrae los datos obtenidos de la partida(Palabras correctas, incorrectas y la fecha de creación).
    $buscar=mysqli_query($conn,"SELECT Correctas, Incorrectas, FechaCreacion FROM Partida WHERE idPartida = '".$idPartida."'");
    $filas=mysqli_fetch_array($buscar);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(20,5,utf8_decode('Información de la Partida'));
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->Cell(20,5,utf8_decode('IDPartida: '));
    $pdf->Cell(20,5,utf8_decode($idPartida));
    $pdf->Ln();
    $pdf->Cell(40,5,utf8_decode('Fecha de Creación: '));
    $pdf->Cell(20,5,utf8_decode($filas['FechaCreacion']));
    $pdf->Ln();
    $pdf->Cell(40,5,utf8_decode('Palabras Correctas: '));
    $pdf->Cell(20,5,utf8_decode($filas['Correctas']));
    $pdf->Ln();
    $pdf->Cell(43,5,utf8_decode('Palabras Incorrectas: '));
    $pdf->Cell(20,5,utf8_decode($filas['Incorrectas']));
    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',12);
    //Información de los equipos participantes.
    $pdf->Cell(20,5,utf8_decode('Equipos Participantes'));
    $pdf->SetFont('Arial','',12);
    $pdf->Ln(10);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetDrawColor(88,88,88);
    $pdf->Cell(20,10,'Avatar',0,0,'C',1);
    $pdf->Cell(50,10,'Nombre',0,0,'C',1);
    $pdf->Cell(30,10,'Puntaje',0,0,'C',1);
    $pdf->Cell(40,10,'Matricula',0,0,'C',1);
    //Creación de la linea.
    $pdf->SetDrawColor(255,171,24);
    $pdf->SetLineWidth(2);
    $pdf->Line(11,$pdf->GetX(),205,$pdf->GetY()+10);
    $pdf->SetFillColor(202,202,202);
    $pdf->SetTextColor(40,40,40);
    $pdf->SetDrawColor(255,255,255);
    //Query que obtiene los datos de los equipos participantes.
    $sentencia="SELECT avatar,nomEquipo,puntaje,matricula FROM Equipo WHERE idPartida = '".$idPartida."' ORDER BY Puntaje DESC";
    $resultado=mysqli_query($conn,$sentencia);
    $pdf->Ln(15);//Salto de línea.
    //Se imprimen los datos obtenidos.
    while($filas=mysqli_fetch_assoc($resultado)){
        $pdf->Cell(20,0, $pdf->Image('../imagenes/Equipos/'.$filas['avatar'], $pdf->GetX(),$pdf->GetY(),15),1,0,'C',1);
        $pdf->Cell(50,20,utf8_decode($filas['nomEquipo']),1,0,'C',1);
        $pdf->Cell(30,20,$filas['puntaje'],1,0,'C',1);
        $pdf->Cell(65,20,utf8_decode($filas['matricula']),1,0,'C',1);
        $pdf->Ln(20);
    }
    $pdf->Output();//Se muestra el reporte.
    mysqli_close($conn);//Se cierra la conexión de la bd.
?>
<?php
  session_start();
  //Se inicia la sesión.
  //Se verifica que exista la variable de sesión.
  if(isset($_SESSION['username'])){
    //Se obtiene el id de la partida.
    $idPartida=$_GET['idPartida'];
    //Requerimos del archivo para realizar la conexión.
    require '../php/ConexionBD.php';
    //Se crea un query para obtener el id del juego.
    $buscar=mysqli_query($conn,"SELECT idJuego FROM Partida where idPartida = '".$idPartida."'");
    $filas=mysqli_fetch_array($buscar);
    $idJuego = $filas['idJuego'];
    //Se crea un query para obtener las palabras y pistas del juego
    $sql=mysqli_query($conn,"SELECT palabras,pistas FROM Juego where idJuego = '".$idJuego."'");
    $filas=mysqli_fetch_array($sql);
    $palabras = $filas['palabras'];  
    $pistas = $filas['pistas']; 
    mysqli_close($conn); //Se cierra la conexión de la bd.
  }else{
    header("Location: InicioSesion.php");//Se dirige al inicio de sesión en caso de que no exista la variable de sesión.
  }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- Meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap-CSS -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/Estilos_JuegoAhorcado.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <!--Js para ajax-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Profesor</title>
    </head>
    <body class="grid-container">
        <header class="header">
        <a href="#" class="enlace">
            <img src="../imagenes/logo2.png" alt="" class="logo">
            <span>Ahorcado para la educación</span> 
        </a>
        </header>
        <nav class="Equipos">
            <?php
                //Requerimos del archivo para realizar la conexión.
                require '../php/ConexionBD.php';
                //Creamos un query para obtener a los equipos participantes con su respectivo nombre y avatar.
                $sentencia="SELECT * FROM Equipo where idPartida = '".$idPartida."'";
                $resultado=mysqli_query($conn,$sentencia);
                while($avatar=mysqli_fetch_assoc($resultado)){
                    echo "<div class='avatar'>";
                    echo "<img src='../imagenes/Equipos/$avatar[Avatar]' width='50px'>";
                    echo "<br>";
                    echo $avatar['NomEquipo']; 
                    echo "<br>";
                    echo "</div>" ;

                }
                mysqli_close($conn); //Se cierra la conexión con la bd.
            ?>
            <br>
            <div id="">
                <form method="POST" onsubmit="puntosEnviar();">
                <div id="input" class="input-group flex-nowrap">
                    <span class="input-group-text" id=""><i class="fas fa-users"></i></span>
                    <select class="" id="Equipos" name="Equipos" aria-label="Username" required>
                        <option value="Categoria">Seleccione un equipo</option>
                        <?php
                            require '../php/ConexionBD.php';
                            $sentencia="SELECT * FROM Equipo inner join Partida on Equipo.idPartida = Partida.idPartida where Equipo.idPartida ='".$idPartida."'";
                            $resultado=mysqli_query($conn,$sentencia);
                            while ($equipos = mysqli_fetch_assoc($resultado)) {
                                echo '<option value="'.$equipos['idEquipo'].'">'.$equipos['NomEquipo'].'</option>';
                            }
                            mysqli_close($conn); //Se cierra la conexión con la bd.
                        ?>
                    </select>
                    <select class="" id="Puntos" name="Puntos" aria-label="Username" required>
                        <option selected value="Puntaje">Asignar Puntos</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="60">60</option>
                        <option value="70">70</option>
                        <option value="80">80</option>
                        <option value="90">90</option>
                        <option value="100">100</option>
                    </select>
                    <button class="btn-lg btn-block" id="agregarPuntos" type="submit">Agregar</button>      
                </div>
            </form>
            </div>
        </nav>
        <div class="btnPistas">
        <form action="../php/PalabrasCI.php" method="POST">
            <input type="hidden" name="idPartida" id="idPartida" value="<?php echo $idPartida?>" >
            <input type="hidden" name="palabrasCorrectas" id="palabrasCorrectas" value="">
            <input type="hidden" name="palabrasIncorrectas" id="palabrasIncorrectas" value=""> 
            <button class="btn btn-lg btn-block" id="btnTerminarJuego" type="submit">Terminar Juego</button>
        </form>
        <!-- El boton que nos sirve para recargar la pagina y asi generar una nueva palabra -->
        <button class="btn btn-lg btn-block"  id="btn"  onclick="pistas()" >Pista</button>
    </div>
    <nav class="navbar" id="Pistas" style = "display: none">
      <div id="textoPista"></div>
    </nav>
    <section class="main">
        <input type="hidden" id="palabrasArray" value="<?php echo $palabras?>">
        <input type="hidden" id="pistasArray" value="<?php echo $pistas?>"> 
        <canvas id="pantalla" width="900px" height="600px"> <!-- etiqueta del canvas con sus medidas en la pantalla -->
            Tu navegador no soporta Canvas.
        </canvas>
        <script>
            /* Variables */
            var ctx;
            var canvas;
            var palabra;
            var letras = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
            var colorTecla = "#FBB034";
            var colorMargen = "#FF7F0E";
            var inicioX = 80;
            var inicioY = 400;
            var lon = 35;
            var margen = 10;
            var pistaText = "";
            var mostrarBoton = false;
            var btn = document.getElementById("agregarPuntos");
            mostrarBtnPuntos();
            /* Arreglos */
            var teclas_array = new Array();
            var letras_array = new Array();
            var palabras_array = new Array();
            var palabras_pistas = new Array();
            var correctas_palabras =[];
            var incorrectas_palabras = []; 

            if(localStorage.getItem("correctas_palabras")===null){
                localStorage.setItem('correctas_palabras', JSON.stringify(correctas_palabras));
            }else{
                var correctas = localStorage.getItem('correctas_palabras');
                correctas = JSON.parse(correctas);
                correctas_palabras = correctas;
            }

            if(localStorage.getItem('incorrectas_palabras')===null){
                localStorage.setItem('incorrectas_palabras', JSON.stringify(incorrectas_palabras));
            }else{
                var incorrectas = localStorage.getItem('incorrectas_palabras');
                incorrectas = JSON.parse(incorrectas);
                incorrectas_palabras = incorrectas;
            }
              
            /* Variables de control */
            var aciertos = 0;
            var errores = 0;
            

            /* Palabras */
            var array = document.getElementById("palabrasArray").value.toUpperCase();
            palabras_array  = array.split(','); 
            palabras_pistas = array.split(',');

            /*Pistas*/
            var array2 = document.getElementById("pistasArray").value.toUpperCase();
            pistas_array  = array2.split('.'); 

            /* Objetos */
            function Tecla(x, y, ancho, alto, letra){
                this.x = x;
                this.y = y;
                this.ancho = ancho;
                this.alto = alto;
                this.letra = letra;
                this.dibuja = dibujaTecla;
            }
            
            function Letra(x, y, ancho, alto, letra){
                this.x = x;
                this.y = y;
                this.ancho = ancho;
                this.alto = alto;
                this.letra = letra;
                this.dibuja = dibujaCajaLetra;
                this.dibujaLetra = dibujaLetraLetra;
            }
           
            /* Funciones */

            /* Dibujar Teclas*/
            function dibujaTecla(){
                ctx.fillStyle = colorTecla;
                ctx.strokeStyle = colorMargen;
                ctx.fillRect(this.x, this.y, this.ancho, this.alto);
                ctx.strokeRect(this.x, this.y, this.ancho, this.alto);
                
                ctx.fillStyle = "white";
                ctx.font = "bold 20px courier";
                ctx.fillText(this.letra, this.x+this.ancho/2-5, this.y+this.alto/2+5);
            }
            
            /* Dibua la letra y su caja */
            function dibujaLetraLetra(){
                var w = this.ancho;
                var h = this.alto;
                ctx.fillStyle = "black";
                ctx.font = "bold 25px Courier";
                ctx.fillText(this.letra, this.x+w/2-12, this.y+h/2+14);
            }
            function dibujaCajaLetra(){
                ctx.fillStyle = "white";
                ctx.strokeStyle = "black";
                ctx.fillRect(this.x, this.y, this.ancho, this.alto);
                ctx.strokeRect(this.x, this.y, this.ancho, this.alto);
            }
            /// Funcion para dar una pista la usuario ////
            function pistaFunction(palabra){
                var pista = '';
                var elemento = palabra;
                var idx = palabras_pistas.indexOf(elemento);
                console.log(idx);
                console.log(pistas_array[idx]);
                pista = pistas_array[idx];
                document.getElementById('textoPista').innerHTML=' '+pista;
            }
            /* Distribuir el teclado con sus letras respectivas*/
            function teclado(){
                var ren = 0;
                var col = 0;
                var letra = "";
                var miLetra;
                var x = inicioX;
                var y = inicioY;
                for(var i = 0; i < letras.length; i++){
                    letra = letras.substr(i,1);
                    miLetra = new Tecla(x, y, lon, lon, letra);
                    miLetra.dibuja();
                    teclas_array.push(miLetra);
                    x += lon + margen;
                    col++;
                    if(col==15){
                        col = 0;
                        ren++;
                        if(ren==2){
                            x = 100;
                        } else {
                            x = inicioX;
                        }
                    }
                    y = inicioY + ren * 50;
                }
            }
            /* Aqui obtenemos la palabra aleatoriamente y la dividimos en letras */
            function pintaPalabra(){
                palabra = noRepetir();
                //En caso de que se retorne un null significa que el juego a terminado.
                if(palabra === null){
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.fillStyle = "black";
                    ctx.font = "bold 30px Courier";
                    ctx.fillText("Juego terminado", 300, 200);
                    localStorage.removeItem('correctas_palabras');
                    localStorage.removeItem('incorrectas_palabras');
                    console.log('Termino el juego');
                }else{
                    pistaFunction(palabra);
                    var w = canvas.width;
                    var len = palabra.length;
                    var ren = 0;
                    var col = 0;
                    var y = 250;
                    var lon = 50;
                    var x = (w + 200 - (lon+margen) *len)/2;
                    for(var i=0; i<palabra.length; i++){
                        letra = palabra.substr(i,1);
                        miLetra = new Letra(x, y, lon, lon, letra);
                        miLetra.dibuja();
                        letras_array.push(miLetra);
                        x += lon + margen;
                    }
                } 
            }
            /*Función para no repetir las palabras y que se genere siempre una diferente.*/
            function noRepetir(){
                var bandera=0;
                do{
                    var p = Math.floor(Math.random()*palabras_array.length);
                    palabra = palabras_array[p];
                    document.getElementById('palabrasCorrectas').value=correctas_palabras;
                    document.getElementById('palabrasIncorrectas').value=incorrectas_palabras;
                    console.log(correctas_palabras);
                    var todasPalabras = new Array();
                    for (var i = 0; i < correctas_palabras.length; i++) {
                        todasPalabras.push(correctas_palabras[i]);
                    }
                    Array.prototype.push.apply(todasPalabras,incorrectas_palabras);
                    console.log(todasPalabras);
                    console.log(correctas_palabras);
                    console.log('arreglo');
                    console.log(palabras_array);
                    todasPalabras.sort();
                    palabras_array.sort();  
                    console.log( correctas_palabras);
                    console.log(palabras_array);
                    if((JSON.stringify(todasPalabras) === JSON.stringify(palabras_array))===true ){
                        return null;
                    }else{
                        if(correctas_palabras.includes(palabra)===true || incorrectas_palabras.includes(palabra)===true){
                            bandera=1;
                        }else{
                            bandera=0;
                        }
                    } 
                }while(bandera==1);
                return palabra; 
            }
            /* dibujar cadalzo y partes del pj segun sea el caso */
            function horca(errores){
                var imagen = new Image();
                imagen.src = "../imagenes/Ahorcado/"+errores+".png";
                imagen.onload = function(){
                    ctx.drawImage(imagen, 30,100, 180, 200);
                }
            }
            /* Ajustar coordenadas */
            function ajusta(xx, yy){
                var posCanvas = canvas.getBoundingClientRect();
                var x = xx-posCanvas.left;
                var y = yy-posCanvas.top;
                return{x:x, y:y}
            }
            /* Detecta tecla clickeada y la compara con las de la palabra ya elegida al azar */
            function selecciona(e){
                var pos = ajusta(e.clientX, e.clientY);
                var x = pos.x;
                var y = pos.y;
                var tecla;
                var bandera = false;
                for (var i = 0; i < teclas_array.length; i++){
                    tecla = teclas_array[i];
                    if (tecla.x > 0){
                        if ((x > tecla.x) && (x < tecla.x + tecla.ancho) && (y > tecla.y) && (y < tecla.y + tecla.alto)){
                            break;
                        }
                    }
                }
                if (i < teclas_array.length){
                    for (var i = 0 ; i < palabra.length ; i++){ 
                        letra = palabra.substr(i, 1);
                        if (letra == tecla.letra){ /* comparamos y vemos si acerto la letra */
                            caja = letras_array[i];
                            caja.dibujaLetra();
                            aciertos++;
                            bandera = true;
                        }
                    }
                    if (bandera == false){ /* Si falla aumenta los errores y checa si perdio para mandar a la funcion gameover */
                        errores++;
                        horca(errores);
                        if (errores == 6) gameOver(errores);
                    }
                    /* Borra la tecla que se a presionado */
                    ctx.clearRect(tecla.x - 1, tecla.y - 1, tecla.ancho + 2, tecla.alto + 2);
                    tecla.x - 1;
                    /* checa si se gano y manda a la funcion gameover */
                    if (aciertos == palabra.length) gameOver(errores);
                }
            }
            /* Borramos las teclas y la palabra con sus cajas y mandamos msj segun el caso si se gano o se perdio */
            function gameOver(errores){
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.fillStyle = "black";

                ctx.font = "bold 30px Courier";
                if (errores < 6){
                    ctx.fillText("Muy bien, la palabra es: ", 300, 200);
                    mostrarBoton = true;
                    mostrarBtnPuntos();
                    correctas_palabras.push(palabra);
                    localStorage.setItem('correctas_palabras', JSON.stringify(correctas_palabras));
                } else {
                    ctx.fillText("Lo sentimos, la palabra era: ", 300, 200);
                    window.location.reload();
                    incorrectas_palabras.push(palabra);
                    localStorage.setItem('incorrectas_palabras', JSON.stringify(incorrectas_palabras));
                }
                ctx.font = "bold 50px Courier";
                lon = (canvas.width + 100 - (palabra.length*48))/2;
                ctx.fillText(palabra, lon, 300);
                horca(errores);
            }
            function mostrarBtnPuntos() {
                if (mostrarBoton ^= true) {
                    btn.style.display = "none"; // hide
                } else {
                    btn.style.display = ''; // show
                }
            } 
            /* Detectar si se a cargado el canvas, iniciamos las funciones necesarias para jugar o se le manda msj de error segun sea el caso */
            window.onload = function(){
                canvas = document.getElementById("pantalla");
                if (canvas && canvas.getContext){
                    ctx = canvas.getContext("2d");
                    if(ctx){
                        teclado();
                        pintaPalabra();
                        horca(errores);
                        canvas.addEventListener("click", selecciona, false);
                    } else {
                        alert ("Error al cargar el contexto!");
                    }
                }
            }
        </script>
    </section>
    <footer class="footer"></footer>
    <script type="text/javascript">
        var mostrar = false;
        var div = document.getElementById("Pistas");
        /*Funcion para mostrar las pistas en pantalla */
        function pistas() {
            if (mostrar ^= true) {
                div.style.display = "block"; // display      
            } else {
                div.style.display = "none"; // hide
            }
        } 
        /*Función para registrar los puntos que se vayan asignando a los equipos*/
        function puntosEnviar(){
            var equipo = document.getElementById('Equipos').value;
            var asignarPuntos = document.getElementById('Puntos').value;
            var dataen = 'equipo='+equipo+'&asignarPuntos='+asignarPuntos;
            $.ajax({
                type: 'POST',
                url: '../php/AgregarPuntos.php',
                data: dataen,
                success: function(resp){
                    $("#respa").html(resp);
                }
            });
            return false;
        }
    </script>
  </body>
</html>

# Sistema web "Ahorcado para la educación"
## Definición del problema
Es una realidad habitual que los estudiantes se aburran en clase, sobre todo en aquellas
asignaturas teóricas que requieren de memorizar las unidades de aprendizaje lo cual
ocasiona que no todos puedan comprender con facilidad todos los conceptos que se
imparten en cada clase y esto se ve reflejado en un bajo desempeño escolar. Estamos tan
acostumbrados a este hecho que no le damos más importancia, poco a poco nos hemos
convencido de que aburrirse en clase es lo normal, que aprender es aburrido. Todavía
existen profesores que las materias las llevan de forma tradicional donde solo manejan
dictado, resúmenes, ensayos por mencionar algunos.

## Objetivos
#### General
- Desarrollar un sistema web para crear un juego de ahorcado que sea educativo e
interactivo.
#### Específicos
- Gestionar a los ahorcados y a los profesores.
- Implementar la opción de pistas en el ahorcado y el número de oportunidades.
- Identificar a los equipos por medio de un avatar.

## Justificación
El desarrollar un sistema web que permita la gestión del administrador y el profesor. El administrador podrá realizar altas, bajas, consultas y modificaciones de los profesores. Para los profesores se creará un backend donde pueda gestionar sus juegos del ahorcado, por lo tanto, podrá crear, modificar y eliminar los juegos.
Cada juego tendrá sus propias palabras o frases en la que los estudiantes formarán equipos para poder adivinarla, así mismo se contará con algunas pistas para ayudar a los equipos.
Debido a que el profesor es quien tendrá el control del juego, este debe permitir que vea en todo momento:
- Qué letras ha adivinado correctamente, cuántas le faltan, y en qué posición.
- Qué letras incorrectas ha seleccionado.
- El número de oportunidades que le quedan a los equipos antes de perder.
- Una imagen que representa el estado actual del monito siendo “ahorcado".

Cada equipo contará con un avatar para diferenciarlos, el número máximo de equipos es 8.
El profesor podrá generar reportes de acuerdo a las estadísticas de cada juego que él haya usado en clase, esto para permitirle tener una mejor visión de las fallas más recurrentes en los estudiantes y que así pueda tomar en cuenta una nueva explicación en cuanto a esos conceptos.


## Alcances
- La aplicación web deberá mostrar el número de oportunidades que le queda al
equipo antes de perder.
- Deberá mostrar las letras que ya ha seleccionado, adivinado correctamente, cuántas
le faltan, y en qué posición.
- Permitirá identificar a los equipos por medio de un avatar.
- Deberá permitir al profesor organizar sus juegos de ahorcado.
- El profesor podrá realizar altas, bajas y modificaciones de los juegos creados.
- El administrador podrá realizar altas, bajas y modificaciones de los profesores.
- El profesor podrá insertar sus palabras y pistas para el juego.
- El profesor podrá visualizar las estadísticas de los juegos y generar reportes.

## Limitaciones
- El sistema no podrá asegurar ser responsive.
- Se utilizarán frameworks.
- Para los juegos solo se podrá participar un máximo de 8 equipos.
- Para poder crear juegos del ahorcado será necesario un inicio de sesión.

## Tecnologias utilizadas
<p align="left">
  <a href="https://www.w3.org/html/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original-wordmark.svg" alt="html5" width="40" height="40"/> </a>
  <a href="https://www.w3schools.com/css/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-original-wordmark.svg" alt="css3" width="40" height="40"/> </a> 
  <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg" alt="javascript" width="40" height="40"/> </a> 
  <a href="https://www.mysql.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" alt="mysql" width="40" height="40"/> </a> 
    <a href="https://www.php.net" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" alt="php" width="40" height="40"/> </a>
  <a href="https://getbootstrap.com" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/bootstrap/bootstrap-plain-wordmark.svg" alt="bootstrap" width="40" height="40"/> </a>
  
</p>

## Funcionamiento

#####  RF.FN.1 Inicio de sesión
Cuando se requiera ingresar al sistema se solicita llenar el registro correspondiente que se basa en un usuario y contraseña.

![Captura de pantalla 2023-06-09 163819](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/d17597b5-8a55-4af4-9069-de38f5373c83)
> Figura 1. Ingreso de datos al login.

![Captura de pantalla 2023-06-09 163832](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/70cd036c-9b48-4e42-8c9f-ef375a5b7b5c)

> Figura 2. Menú del profesor.

##### RF.FN.2 Registro de usuarios
En caso de no contar con una cuenta, se solicita al usuario la clave, nombre, correo y contraseña.

![Captura de pantalla 2023-06-09 170540](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/fb6be601-dcf3-45d8-86f8-637eea4c85b7)

> Figura 3. Ingreso de datos para registro de un nuevo usuario.

![Captura de pantalla 2023-06-09 170625](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/b0ee623c-203e-4ef2-94c6-220e957cd9fb)

> Figura 4. Mensaje de registro exitoso.

##### RF.FN.3 Gestión del profesor
Permite que el administrador gestione a los profesores, es decir, que pueda crear, modificar, consultar o eliminar.

![Captura de pantalla 2023-06-09 171927](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/00c1ef24-cf42-4e5c-b08c-c3649d99d749)
> Figura 5. Agregar un profesor.

![Captura de pantalla 2023-06-09 171940](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/18992b81-be70-4de1-ad4f-b42249946e78)
> Figura 6. Mensaje de alerta de usuario existente.

![Captura de pantalla 2023-06-09 172003](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/a564fb86-7769-40b5-9257-46a6beef04b4)
> Figura 7. Tabla de registros que se pueden modificar.

![Captura de pantalla 2023-06-09 172407](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/8e25d981-7b61-4b1c-96c6-f9abe8c30e0d)
> Figura 8. Modificación de los datos del registro.

![Captura de pantalla 2023-06-09 172503](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/db4f1e10-a2b8-43d0-8639-4870068695e3)
> Figura 9. Tabla con los datos actualizados. 

![Captura de pantalla 2023-06-09 172628](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/e8549b3a-e96a-4f7a-bb9c-33d406a04404)
> Figura 10. Confirmación de la eliminación de un profesor.

![Captura de pantalla 2023-06-09 171659](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/10c7b208-b855-4c4c-badb-bb4674d1d638)
> Figura 11. Consultar profesor por clave.

![Captura de pantalla 2023-06-09 171718](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/99bda626-d455-41b2-ab44-73b1e26872f6)
> Figura 12. Resultados de la consulta.

##### RF.FN.4 Gestión del juego
Permite el profesor gestionar los juegos de ahorcado, es decir, que puede crear, modificar, consultar o eliminar.

![Captura de pantalla 2023-06-09 172807](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/66b4789f-4575-423b-9c87-4943f4130321)
> Figura 13. Eliminación de un juego.

![Captura de pantalla 2023-06-09 172839](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/65fc45dd-21f1-4dc3-9efc-6d8785ef5f10)
> Figura 14. Consulta de un juego.

![Captura de pantalla 2023-06-09 172855](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/ecdd368a-471c-4e1d-9c07-1b22851ea449)
> Figura 15. Modificación de un juego.

##### RF.FN.5 Clasificación de juegos
Permite al profesor categorizar los juegos creados para llevar una mejor organización.

![Captura de pantalla 2023-06-09 173042](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/ced98ba6-9420-480c-8834-722e55bec79f)
> Figura 16. Creación de una nueva categoria.

##### RF.FN.6 Crear juego
El profesor podrá insertar las palabras, las pistas y el número de equipos participantes.

![Captura de pantalla 2023-06-09 173215](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/e92e2c38-b7e2-4768-a58a-01280d6a7eb0)
> Figura 17. Creación de un nuevo juego.

##### RF.FN.7 Jugar
Permite al estudiante poder nombrar y seleccionar el avatar de su equipo participante a apartir de que el profesor les proporcione un código.

![Captura de pantalla 2023-06-09 173301](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/7b35cef8-5dcc-46d7-ae86-50d04f4f4a98)
> Figura 18. Código de partida.

![Captura de pantalla 2023-06-09 173409](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/ef080569-b08a-4eda-a922-a75cc4159e73)
> Figura 19. Registro de equipo.

##### RF.FN.8 Oportunidades
La aplicación deberá disminuir los intentos cuando el equipo se equivoque, esto se verá representado con las imágenes del monito siendo ahorcado.

![Captura de pantalla 2023-06-09 173552](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/fdbb2320-fcc7-4785-9b60-1637369c9109)
> Figura 20. Interfaaz del juego.

![Captura de pantalla 2023-06-09 173617](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/591fe62c-3cc5-4bed-9aac-ef83a46a81b4)
> Figura 21. Fallos y aciertos de la palabra.

##### RF.FN.9 Generar reportes
El profesor podrá generar el reporte en formado PDF del juego para visualizar las estadísticas que se obtuvieron.

![Captura de pantalla 2023-06-09 174047](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/66c4d510-6d95-4620-9516-e3170421dc37)
> Figura 22. Generación del reporte en PDF.

##### RF.FN.10 Consultar cantidad de juegos creados por profesor
El administrador podrá consultar cuantos juegos ha creado cada profesor.

![Captura de pantalla 2023-06-09 174108](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/23395f23-006c-4b69-88d5-2abddebf3459)
> Figura 23. Consultar cantidad de juegos por profesor.

##### RF.FN.11 Consultar estudiantes y cantidad de partidas ganadas.
El profesor puede consultar cuantas partidas ha ganado cada estudiante.

![Captura de pantalla 2023-06-09 174131](https://github.com/GiovannaGarcia6/SistemaWeb-AhorcadoParaLaEducacion/assets/121702527/8bf8b2e2-808d-4b08-a562-19f5d5ead247)
> Figura 24. Consultar estudiante y cantidad de partidas ganadas.



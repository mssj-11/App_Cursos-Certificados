# App Web Cursos & Certificaciones




##  Login de Sesión
<p aling="center">
    <img src="readme-img/1.png" alt="">
</p>

##  Inicio
<p aling="center">
    <img src="readme-img/2.png" alt="">
</p>

##  Tabla Alumnos
<p aling="center">
    <img src="readme-img/3.png" alt="">
</p>

##  Tabla Cursos
<p aling="center">
    <img src="readme-img/4.png" alt="">
</p>

##  Certificado del alumno **Diego Orlando Magañez** en el curso **Desarrollo web con PHP**
<p aling="center">
    <img src="readme-img/5.png" alt="">
</p>

##  Certificado del alumno **Diego Orlando Magañez** en el curso **Curso GO Desde Cero**
<p aling="center">
    <img src="readme-img/6.png" alt="">
</p>



## Base de Datos
La DB se encontrara en la carpeta **DB**.

## Relacion Tablas
La relacion en la **llave foranea** (on delete: **CASCADE** & on update: **CASCADE**).<br>
Para cada vez que se elimine un registro y cada actualizacion en las tablas **cursos** y **alumnos** se aplicaran a la tabla **alumnos_cursos** que tiene relacion con ambas tablas mencionadas.

<p aling="center">
    <img src="./preview/db_relation.png">
</p>

## Libreria: [FPDF](http://www.fpdf.org/)
Permitira generar documentos en formato PDF.
# App Web Cursos & Certificaciones


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

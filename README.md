# gesthispania
Aplicación web de prueba para GestHispania sobre asignaturas y matriculaciones

## Instalación

Para instalar la aplicación sigue los siguientes pasos

- clona o copia este proyecto en un servidor
- crea una base de datos e importa el archivo sql que hay en el proyecto
- modifica los datos de acceso a la BBDDen app/conexion.php

La aplicación ya estará lista con algunos datos de muestra en la BBDD

## Login de administrador
usuario: admin@admin.es

contraseña: admin1234_ 

## Requisitos de la APP
### REQ-USU-01
La aplicación web contará con una página para la visualización de los datos del
usuario, en la que aparecerá un botón para poder editarlos.

### REQ-USU-02
La página principal mostrará una lista de asignaturas agrupadas por cursos en las que
el usuario podrá inscribirse.

### REQ-USU-03
La aplicación web contará con un formulario donde poder editar todos los datos del
propio usuario.

### REQ-LOG-01
La aplicación web contará con una página que será la principal, en la que poder
introducir los datos usuario y contraseña y acceder al panel de usuario. Esta página
también contará con un enlace al registro.

### REQ-REG-01
La aplicación web contará con un formulario de registro, donde introducirá:
- Nombre
- Apellidos
- Email
- Contraseña (con verificación)

### REQ-CUR-01
La aplicación contará con un formulario donde añadir cursos. Un curso contará con los
campos:

- Curso (Primero, Segundo….)
- Titulación
- Duración en meses
- Año académico

### REQ-CUR-02
La aplicación web contará con una página donde se listen los cursos.

### REQ-CUR-03
La aplicación permitirá añadir asignaturas a cursos, para ello se mostrará un botón en
el listado de cursos donde te permitirá editar las asignaturas que contiene el curso
(añadir o eliminar).

### REQ-ASG-01
La aplicación contará con un formulario donde añadir asignaturas. Una asignatura
tiene los campos:
- Nombre
- Créditos
- Duración (anual o cuatrimestral)

### REQ-ASG-02
La aplicación web contará con una página donde se listen las asignaturas.

## Algunas mejoras que podrían hacerse
Al tratarse de una prueba no he ido más allá de lo que solicitaban, pero se pueden hacer lás siguiente mejoras.

- crear un recordar contraseña
- hacer que el admin pueda modificar el nombre de cursos, titulaciones y asignaturas (no venía como requisito y por tiempo no lo he añadido, los updates de modificación de datos se encuentran en la modificación de usuario, supongo que por ello no estan)
- posibilidad de crear expedientes de los alumnos o de contar los creditos de matriculacion por cursos, marcando mínimos para acceder a becas o el maximo anual

 
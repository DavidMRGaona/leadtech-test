# Prueba Técnica para Leadtech

Este repositorio contiene la solución a la prueba técnica solicitada por Leadtech.

## Estructura del Proyecto

- `fizzBuzz.php`: Contiene la implementación de la función `fizzBuzz` que genera una secuencia de FizzBuzz hasta un 
número dado.
- `longestConsecutiveSequence.php`: Contiene la implementación de la función `longestConsecutive` que encuentra la 
secuencia consecutiva más larga en un array de números.
- `Task3.md`: Documento con recomendaciones de mejora para el `UserController`.

## Uso

### FizzBuzz

Para ejecutar la función `fizzBuzz`:

1. Abre el archivo `fizzBuzz.php`.
2. Modifica la variable `$n` con el número hasta el cual deseas generar la secuencia de FizzBuzz.
3. Ejecuta el archivo en la línea de comandos o en tu entorno de desarrollo.

```sh
php fizzBuzz.php
```

### Longest Consecutive Sequence

Para ejecutar la función `longestConsecutive`:

1. Abre el archivo `longestConsecutiveSequence.php`.
2. Modifica la variable `$input` con el array de números que deseas analizar.
3. Ejecuta el archivo en la línea de comandos o en tu entorno de desarrollo.

```sh
php longestConsecutiveSequence.php
```

## Mejora de Código

El archivo `Task3.md` contiene una serie de recomendaciones para mejorar el código del `UserController`, incluyendo el 
uso de PDO o MySQLi, inyección de dependencias, protección contra SQL Injection, y más.

## Nota

El primer commit de este repositorio se realizó dentro del límite de 3 minutos, lo cual puede ser verificado mediante 
la hora del commit.

----

## Mejoras implementadas tras la prueba de 30 minutos:

- Se ha agregado la segunda parte de la pregunta 3. Se encuentra en la carpeta `task_three_refactor`. Dentro de esta se 
encuentra un archivo `assumptions-and-notes.md` con una rápida explicación de mejoras implementadas.
- Se han agregado pruebas adicionales para `longestConsecutiveSequence.php` y para `fizzBuzz.php`. Además, las pruebas 
han sido puestas a un fichero independiente. Ahora las pruebas se ejecutan de la siguiente manera:

   - Para `fizzBuzz.php`:
     ```bash
     php run_tests.php fizzBuzz
     ```
     
    - Para `longestConsecutiveSequence.php`:
     ```bash
     php run_tests.php longestConsecutive
     ```
  Para agregar más pruebas simplemente se debe agregar a la variable correspondiente dentro del archivo `run_tests.php`.
  Respetando el formato de las pruebas ya existentes.
- Se han corregido errores tipográficos en el archivo README.md así como en el nombre del archivo 
`longestConsecutiveSequence.php`.

# Asunciones y notas adicionales:

_Tal y como se indica en el documento entregado el código no es funcional. Es una aproximación conceptual dónde se 
asume la correcta implementación de ciertas mejoras que se reflejan en este código. Se ha decidido mantener el código 
lo más agnóstico posible para poder ser utilizado en diferentes entornos. Aún así, sería fácil adaptarlo a un framework 
como Symfony o Laravel, aprovechando las ventajas que estos ofrecen en términos de seguridad, rendimiento y 
mantenimiento._

-----

### Estructura de archivos

```
src/
├── Controller/
│   └── UserController.php
├── Database/
│   └── DatabaseConnection.php
├── Email/
│   └── EmailService.php
└── Request/
    └── Request.php
tests/
├── Controller/
│   └── UserControllerTest.php
├── Database/
│   └── DatabaseConnectionTest.php
└── Email/
    └── EmailServiceTest.php
phpunit.xml
composer.json
.env
```

### Dependencias

Este código asume que PHPMailer, PHPUnit, BypassFinals y PHPDotenv par está instalado a través de Composer se incluye 
el archivo composer.json con las dependencias necesarias.

```json
{
    "require": {
        "phpmailer/phpmailer": "^6.9",
        "vlucas/phpdotenv": "^5.6"
    },
    "require-dev": {
        "phpunit/phpunit": "^11.3",
        "dg/bypass-finals": "^1.8"
    }
}
```

Para instalar las dependencias se debe ejecutar el siguiente comando:

```bash
composer require phpmailer/phpmailer
composer require --dev phpunit/phpunit
composer require --dev dg/bypass-finals
```
## Mejoras implementadas

### Estructura de Código

Se sigue una estructura básica de inyección de dependencias, separando las responsabilidades en diferentes clases.
Y a su vez en diferentes métodos en caso de ser necesario

### Uso de constantes

Se utilizan constantes para almacenar las credenciales de la base de datos y algunos valores del correo. Se podría 
agregar tantas cosas como sea necesario.

### Manejo de Errores

Se implementa manejo básico de excepciones en la clase EmailService, en la conexión a la base de datos y 
en el controlador.

### Seguridad

Se utiliza PDO con declaraciones preparadas para prevenir inyecciones SQL y se sanitizan los datos de entrada.

### Formato de código y legibilidad

Se ha seguido un formato de código consistente y se han añadido comentarios para mejorar la legibilidad del código. 
Intentando seguir las recomendaciones de PSR-12.

### Pruebas Unitarias

Se incluyen pruebas unitarias para las clases EmailService, DatabaseConnection y UserController. Se utilizan mocks para 
simular el comportamiento de las clases que dependen de otras clases. Y se utiliza la librería BypassFinals para poder 
hacer mocks de clases finales.

-----

## Posibles Mejoras Futuras

_**Nota**: Estas mejoras no están implementadas en el código actual, pero podrían ser consideradas para futuras iteraciones.
Además, únicamente se tienen en aspectos relacionados con el backend._

- Se podría considerar implementar un sistema de secrets a nivel de infraestructura (por ejemplo, AWS Secrets Manager).
- Implementar un flag para utilizar diferentes servicios de correo electrónico y bases de datos. Permitiendo cambiar 
dependiendo el entorno de desarrollo, pruebas o producción.
- Implementar un sistema de log para registrar errores y eventos importantes. Mejorando la monitorización y depuración.
- Mejorar la validación de los datos de entrada y el manejo de excepciones.
- Sistema de plantillas para los correos electrónicos, permitiendo personalizar los mensajes de forma más sencilla.
- Se podría implementar una mejora en las pruebas para usar una base de datos en memoria para las pruebas unitarias, 
evitando así la necesidad de una base de datos real. Esto mejoraría la velocidad de las pruebas y la independencia de 
las mismas.
- Se podría implementar algun ORM para facilitar la interacción con la base de datos. Por ejemplo, Doctrine o Eloquent.

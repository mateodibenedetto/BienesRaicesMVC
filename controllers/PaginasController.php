<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;


class PaginasController {
    public static function index( Router $router ) {

        $propiedades = Propiedad::get(3); // Muestra solo 3 propiedades

        $router->render('paginas/index', [
            'inicio' => true,
            'propiedades' => $propiedades
        ]);
    }

    public static function nosotros( Router $router ) {
        $router->render('paginas/nosotros');
    }

    public static function propiedades( Router $router ) {

        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router) {
        $id = validarORedireccionar('/propiedades');

        // Obtener los datos de la propiedad
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog( Router $router ) {
        $router->render('paginas/blog');
    }

    public static function entrada1( Router $router ) {
        $router->render('paginas/entrada1');
    }

    public static function entrada2( Router $router ) {
        $router->render('paginas/entrada2');
    }

    public static function entrada3( Router $router ) {
        $router->render('paginas/entrada3');
    }

    public static function entrada4( Router $router ) {
        $router->render('paginas/entrada4');
    }


    public static function contacto( Router $router ) {
        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar 
            $respuestas = $_POST['contacto'];
        
            // Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            // Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'c60b2de73a4d12';
            $mail->Password = '1e09aaaaa5dc50';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            // Configurar el contenido del email
            $mail->setFrom('admin@bienesraices.com', $respuestas['nombre']); // quien envia el email
            $mail->addAddress('admin@bienesraices.com', 'Bienes Raices'); // a quien le llega el email
            $mail->Subject = 'Tienes un Nuevo Email de BieneRaices'; // asunto de email

            
            // Habilitar HTML 
            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8'; 

            // Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p><strong>Has Recibido un email:</strong></p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . ' </p>';

            // Enviar de forma condicional algunos campos de email o telefono
            if($respuestas['contacto'] === 'telefono') {
                // Es telefono, entonces agregamos el campo de telefono
                $contenido .= "<p>Eligió ser Contactado por Teléfono:</p>";
                $contenido .= "<p>Su teléfono es: " .  $respuestas['telefono'] ." </p>";
                $contenido .= "<p>En la Fecha y hora: " . $respuestas['fecha'] . " - " . $respuestas['hora']  . " Horas</p>";
            } else {
                // Es email, entonces agregamos el campo de email
                $contenido .= "<p>Eligio ser Contactado por Email:</p>";
                $contenido .= "<p>Su Email  es: " .  $respuestas['email'] ." </p>";
            }

            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . ' </p>';
            $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . ' </p>';
            $contenido .= '<p>Presupuesto o Precio: $' . $respuestas['precio'] . ' </p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            // Enviar el mail
            if(!$mail->send()){
                $mensaje = 'Hubo un Error... intente de nuevo';
            } else {
                $mensaje = 'Email Enviado Correctamente';
            }

        }
        
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}
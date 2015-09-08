<?php

/*
 * Info:
 * Registrar API keys en https://www.google.com/recaptcha/admin
 * Example: 
 */

// Cargar libreria ReCaptcha Google
require_once __DIR__ . '/library/recaptcha-v2/autoload.php';

// Clave del sitio
$captchaSitekey = 'YOUR_CODE_SITE_KEY';

// Clave secreta
$captchaSecret = 'YOUR_CODE_SECRET';


// Validar Codigos Captcha
if ($captchaSitekey === '' || $captchaSecret === '') {
  // Codigos Captcha no válidos
  echo "error";
} elseif (isset($_POST['g-recaptcha-response'])) {

  // Si el envío del formulario incluye el campo "g-recaptcha-response"
  // Crear una instancia del servicio usando tu $captchaSecret
  $recaptcha = new \ReCaptcha\ReCaptcha($captchaSecret);

  $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

  if ($resp->isSuccess()) {
    echo "success";
  } else {
    echo "error";
    foreach ($resp->getErrorCodes() as $code) {
      echo  $code  ;
    }
  }
}


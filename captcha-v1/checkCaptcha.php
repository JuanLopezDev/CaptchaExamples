<?php

// Cargar libreria ReCaptcha 1.11 Google
require_once __DIR__ . "/library/recaptcha-v1.11/recaptchalib.php";

// Registrar API keys en https://www.google.com/recaptcha/admin

// Clave del sitio
$captchaSitekey = 'YOUR_CODE_SITE_KEY';
// Clave secreta
$captchaSecret = 'YOUR_CODE_SECRET';

// reCaptcha busca el POST para confirmar
$resp = recaptcha_check_answer ($captchaSecret,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

// Si el código introducido es correcto devuelve verdadero ( o falso)
if ($resp->is_valid) {
  echo "true";
} else {
  echo "false";
}
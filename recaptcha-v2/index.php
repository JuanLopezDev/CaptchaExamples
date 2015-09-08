<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title>ReCaptcha v2</title>

    <style>
      body {
        font-family: "Arial";
        font-size: 12px;
      }

      #form-contact {
        display: block;
        width: 300px;
        padding: 10px;
      }

      input {
        width: 100%;
        height: 30px;
      }

      button {
        display: block;
        width: 200px;
        height: 30px;
        margin: 0 auto;
      }

      .g-recaptcha {
        width: 100%;
      }
    </style>

    <?php
    // Clave pública
    $captchaSitekey = 'YOUR_CODE_SITE_KEY';
    // Lenguaje ( https://developers.google.com/recaptcha/docs/language)
    $lang = 'es';
    ?>

  </head>
  <body>
    <form id="form-contact">
      <h1>
        Complete el formulario:
      </h1>

      <input type="text" placeholder="Ingrese nombres" id="txtname" name="txtname"> 
      <br><br>
      <input type="text" placeholder="Ingrese apellidos" id="txtlastname" name="txtlastname">
      <br><br>

      <!-- ReCaptcha -->
      <div class="g-recaptcha" data-sitekey="<?php echo $captchaSitekey; ?>"></div>
      <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang; ?>"></script>
      <span id="captcha-message" style="margin-left:100px;color:red"></span>
      <!-- /ReCaptcha -->

      <div id="message"></div>

      <br>

      <button>Enviar</button>
    </form>

    <script src="assets/vendor/jquery-1.9.1.min.js"></script>
    <script src="assets/vendor/jquery.validate.min.js"></script>
    <script src="assets/main.js"></script>
  </body>
</html>

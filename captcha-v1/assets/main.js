$(function () {
  
  // ID element for Captcha
  var captcha_id = "captcha";
  
  // Public Key
  var public_key = "YOUR_CODE_SITE_KEY";
  
  Recaptcha.create(public_key, captcha_id, {
    theme: "custom",
    custom_theme_widget: captcha_id,
    callback: Recaptcha.focus_response_field
  });

  // Add reCaptcha validator to form validation
  jQuery.validator.addMethod("checkCaptcha", (function () {
    var isCaptchaValid;
    isCaptchaValid = false;

    $.ajax({
      url: "checkCaptcha.php",
      type: "POST",
      async: false,
      data: {
        recaptcha_challenge_field: Recaptcha.get_challenge(),
        recaptcha_response_field: Recaptcha.get_response()
      },
      success: function (resp) {
        if (resp === "true") {
          isCaptchaValid = true;
        } else {
          Recaptcha.reload();
        }
      }
    });
    return isCaptchaValid;
  }), "");

  // Validation
  $("#form-contact").validate({
    rules: {
      "txtname": { required: true },
      "txtlastname": { required: true },
      "recaptcha_response_field": {
        required: true,
        checkCaptcha: true
      }
    },
    messages: {
      "txtname": {required: 'Ingrese nombres'},
      "txtlastname": {required: 'Ingrese apellidos'},
      "recaptcha_response_field": {
        required: "Ingrese el captcha",
        checkCaptcha: "Su respuesta Captcha era incorrecta. Intente nuavamente."
      }
    },
    onkeyup: false,
    onfocusout: false,
    onclick: false,
    highlight: function (element, errorClass, validClass) {
      $(element).addClass(errorClass);
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass(errorClass);
    },
    submitHandler: function () {
      $("#message").text("Enviado!");
    }
  });

});
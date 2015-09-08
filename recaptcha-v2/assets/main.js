$(function () {

  $("#form-contact").validate({
    rules: {
      txtname: {required: true},
      txtlastname: {required: true}
    },
    messages: {
      "txtname": {required: 'Ingrese nombres'},
      "txtlastname": {required: 'Ingrese apellidos'}
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass(errorClass);
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass(errorClass);
    },
    submitHandler: function () {
      validateReCaptcha(function (e) {
         if (e === "empty") {
           $("#message").text("El Captcha se encuentra vacío");
         } else if (e === "success") {
           alert("Enviar formulario");
         } else {
           alert("Error");
         }
      });
      return false;
    }
  });

  function validateReCaptcha(callback) {
    var rpta = "empty";
    
    var captchaResponse = grecaptcha.getResponse();

    if (captchaResponse.length != 0) {
      $.ajax({
        url: "checkCaptcha.php",
        type: "POST",
        data: {
          "g-recaptcha-response": captchaResponse
        },
        success: function (res) {
          rpta = res;
          if (typeof callback === "function") {
            callback(rpta);
          } else {
            throw new Error("El parametro ingresado no es una función");
          }
        }
      });
    } else {
      callback(rpta);
    }

    return rpta;
  }

});
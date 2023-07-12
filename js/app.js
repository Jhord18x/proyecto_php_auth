// import path from 'path'
// const rutaActual = path.resolve('./../');
$(document).ready(function() {
  // Submit form data using AJAX
  $("#loginForm").submit(function(event) {
    // Prevent default action from happening
    event.preventDefault();
    
    // Serialize form data
    var formData = $(this).serialize();
    
    $.ajax({
      type: "POST",
      url: "servidor/login/logear.php",
      data: formData,
      dataType: "json"
    }).done(function(response) {
      if (response.status == true) {
        alert("Bienvenido!");
        window.location = "inicio.php";
        alert(window.location);
      } else {
        // Load the "error.php" file
        $.ajax({
          url: "error.php",
          dataType: "html"
        }).done(function(data) {
          $("#error").html(data);
        });
      }
    });
  });
});
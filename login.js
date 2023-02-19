// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            alert(event);
          }
  
          form.classList.add('was-validated')
        }, false)
      })
  })()

  var dtToday = new Date();
  var month = dtToday.getMonth() + 1;
  var day = dtToday.getDate();
  var year = dtToday.getFullYear();
  var maxYear = year - 18;
  if(month < 10)
      month = '0' + month.toString();
  if(day < 10)
      day = '0' + day.toString();
      alert ("Reminder: Only 18 above can register.")
  var maxDate = maxYear + '-' + month + '-' + day;
  var minYear = year - 80;
  var minDate = minYear + '-' + month + '-' + day;
  document.querySelectorAll("#txtDate")[0].setAttribute("max",maxDate);

  document.querySelectorAll("#txtDate")[0].setAttribute("min",minDate);
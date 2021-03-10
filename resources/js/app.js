document.addEventListener("turbolinks:request-start", function(event) {
    var xhr = event.data.xhr
    xhr.withCredentials = true
});

var toggleInputContainer = function (input) {
    if (input.value != "") {
        input.classList.add('filled');
    } else {
        input.classList.remove('filled');
    }
}

var labels = document.querySelectorAll('.label');
for (var i = 0; i < labels.length; i++) {
    labels[i].addEventListener('click', function () {
        this.previousElementSibling.focus();
    });
}

window.addEventListener("turbolinks:load", function () {
    var inputs = document.getElementsByClassName("input");
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener('keyup', function () {
            toggleInputContainer(this);
        });
        inputs[i].addEventListener('change', function () {
            toggleInputContainer(this);
        });
        toggleInputContainer(inputs[i]);
    }
});

window.addEventListener("turbolinks:load", function () {
    var button = document.getElementById('menu-toggle');
    var menu = document.getElementById('menu');
    button.addEventListener('click', function(){
        menu.classList.toggle('hidden');
    });
});

var countDownDate = new Date("June 10, 2020 23:59:59").getTime();

var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    document.getElementById("countdown").innerHTML = "Noch "+ days + " Tage " + hours + " Stunden "
    + minutes + " Minuten ";

    // If the count down is finished, write some text
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("countdown").innerHTML = "Die Freundschaftslauf Wochen 2020 sind vorbei. Danke an alle Läufer und Sponsoren";
    }
  }, 1000);



var Turbolinks = require("turbolinks")
Turbolinks.start()

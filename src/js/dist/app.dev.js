"use strict";

// Menu De Hamburguesa
document.addEventListener('DOMContentLoaded', function () {
  addEventListeners();
});

function addEventListeners() {
  var mobileMenu = document.querySelector('.mobile-menu');
  mobileMenu.addEventListener('click', navegacionResponsive); // Muestra campos condicionales

  var metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
  metodoContacto.forEach(function (input) {
    return input.addEventListener('click', mostrarMetodoContacto);
  });
}

function navegacionResponsive() {
  var navegacion = document.querySelector('.navegacion');
  navegacion.classList.toggle('mostrar');
}

function mostrarMetodoContacto(e) {
  var contactoDiv = document.querySelector('#contacto');

  if (e.target.value === 'telefono') {
    contactoDiv.innerHTML = "  \n        <br> \n        <label for=\"telefono\">Numero de tel\xE9fono</label>\n        <input type=\"tel\" placeholder=\"Tu Tel\xE9fono\" id=\"telefono\" name=\"contacto[telefono]\">\n        <p>Elija la fecha y la hora para la llamada</p>\n            \n        <label for=\"fecha\">Fecha:</label>\n        <input type=\"date\" id=\"fecha\" name=\"contacto[fecha]\">\n\n        <label for=\"hora\">Hora:</label>\n        <input type=\"time\" id=\"hora\" min=\"09:00\" max=\"18:00\" name=\"contacto[hora]\">\n        ";
  } else {
    contactoDiv.innerHTML = "\n        <br> \n        <label for=\"email\">E-mail</label>\n        <input type=\"text\" placeholder=\"Tu Email\" id=\"email\" name=\"contacto[email]\" >\n        ";
  }
} // Leer preferencias del usuario si es que ya tiene el navegador en dark mode o no


var prefereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
var prefereLightMode = window.matchMedia('(prefers-color-scheme: light)'); // if(prefereDarkMode.matches) {
//     document.body.classList.add('dark');
//     // btnSwitch.classList.remove('active');
// } else {
//     document.body.classList.remove('dark');
//     // btnSwitch.classList.add('active');  
// }

var btnSwitch = document.querySelector('#switch'); // Si cambia el dark mode del navegador mientras esta en la pagina este codigo hace que el sitio se de cuenta y cambie automaticamente

prefereDarkMode.addEventListener('change', function () {
  if (prefereDarkMode.matches) {
    btnSwitch.classList.remove('active');
    document.body.classList.add('dark');
  } else {
    document.body.classList.remove('dark');
    btnSwitch.classList.add('active');
  }

  console.log(prefereDarkMode);
}); // Boton dark mode 

btnSwitch.addEventListener('click', function () {
  document.body.classList.toggle('dark');
  btnSwitch.classList.toggle('active');
});
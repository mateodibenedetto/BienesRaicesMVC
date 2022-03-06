// Menu De Hamburguesa

document.addEventListener('DOMContentLoaded', () => {
    addEventListeners();
});

function addEventListeners () {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);

    // Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');

    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodoContacto));

}

function navegacionResponsive () {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar');
}

function mostrarMetodoContacto(e) {
    const contactoDiv = document.querySelector('#contacto');

    if(e.target.value === 'telefono') {
        contactoDiv.innerHTML = `  
        <br> 
        <label for="telefono">Numero de teléfono</label>
        <input data-cy="input-telefono" type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]">
        <p>Elija la fecha y la hora para la llamada</p>
            
        <label for="fecha">Fecha:</label>
        <input data-cy="input-fecha" type="date" id="fecha" name="contacto[fecha]">

        <label for="hora">Hora:</label>
        <input data-cy="input-hora" type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
        <br> 
        <label for="email">E-mail</label>
        <input data-cy="input-email" type="text" placeholder="Tu Email" id="email" name="contacto[email]" >
        `;
    }
}



// Leer preferencias del usuario si es que ya tiene el navegador en dark mode o no
const prefereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
const prefereLightMode = window.matchMedia('(prefers-color-scheme: light)');

// if(prefereDarkMode.matches) {
//     document.body.classList.add('dark');
//     // btnSwitch.classList.remove('active');
// } else {
//     document.body.classList.remove('dark');
//     // btnSwitch.classList.add('active');  
// }

const btnSwitch = document.querySelector('#switch');

// Si cambia el dark mode del navegador mientras esta en la pagina este codigo hace que el sitio se de cuenta y cambie automaticamente
prefereDarkMode.addEventListener('change', () => {
    if(prefereDarkMode.matches) {
        btnSwitch.classList.remove('active');
        document.body.classList.add('dark');
    } else {
        document.body.classList.remove('dark');
        btnSwitch.classList.add('active');        
    }
    console.log(prefereDarkMode);
});


// Boton dark mode 
btnSwitch.addEventListener('click', ()=> {
    document.body.classList.toggle('dark');
    btnSwitch.classList.toggle('active');
});


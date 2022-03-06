/// <reference types="cypress" />

describe ('Prueba el Formulario de Contacto', () => {
    it('Prueba la página de contacto y el envio de emails', () => {
      cy.visit('/contacto');

      // Heading
      cy.get('[data-cy="heading-contacto"]').should('exist');
      cy.get('[data-cy="heading-contacto"]').invoke('text').should('equal', 'Contacto');
      cy.get('[data-cy="heading-contacto"]').invoke('text').should('not.equal', 'Formulario de Contacto');

      cy.get('[data-cy="heading-formulario"]').should('exist');
      cy.get('[data-cy="heading-formulario"]').invoke('text').should('equal', 'Llene el formulario de contacto');
      cy.get('[data-cy="heading-formulario"]').invoke('text').should('not.equal', 'Formulario Contacto');

    });

    it('Llena los campos del formulario', () => {
      
      // Formulario
      cy.get('[data-cy="input-nombre"]').type('Juan');
      cy.get('[data-cy="input-mensaje"]').type('Deseo comprar una casa');
      cy.get('[data-cy="input-opciones"]').select('Compra'); // checkbox
      cy.get('[data-cy="input-precio"]').type('290000');
      cy.get('[data-cy="forma-contacto"]').eq(1).check(); // radio
      
      cy.wait(3000)

      cy.get('[data-cy="forma-contacto"]').eq(0).check();

      cy.get('[data-cy="input-telefono"]').type('1234567891');
      cy.get('[data-cy="input-fecha"]').type('2022-03-30'); // date
      cy.get('[data-cy="input-hora"]').type('12:30'); // hora

      cy.get('[data-cy="formulario-contacto"]').submit(); // sumbit

      cy.get('[data-cy="alerta-envio-formulario"]').should('exist');
      cy.get('[data-cy="alerta-envio-formulario"]').invoke('text').should('equal', 'Email Enviado Correctamente');
      cy.get('[data-cy="alerta-envio-formulario"]').should('have.class', 'alerta').and('have.class', 'exito')
      .and('not.have.class', 'error'); // .and() evalua varias clases


        
    });
});
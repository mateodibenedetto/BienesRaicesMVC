/// <reference types="cypress" />

describe ('Prueba la Autenticacion', () => {
    it('Prueba la autenticacion en /login', () => {
      cy.visit('/login');

      // *** Heading ***
      cy.get('[data-cy="heading-login"]').should('exist');
      cy.get('[data-cy="heading-login"]').should('have.text', 'Iniciar Sesión');

      // *** Formulario ***
      cy.get('[data-cy="formulario-login"]').should('exist');
       
      // Ambos campos son obligatorios
      cy.get('[data-cy="formulario-login"]').submit();
      cy.get('[data-cy="alerta-login"]').should('exist');
      cy.get('[data-cy="alerta-login"]').eq(0).should('have.class', 'error').and('have.class', 'alerta');
      cy.get('[data-cy="alerta-login"]').eq(0).should('have.text', 'El email es obligatorio');

      cy.get('[data-cy="alerta-login"]').eq(1).should('have.class', 'error').and('have.class', 'alerta');
      cy.get('[data-cy="alerta-login"]').eq(1).should('have.text', 'El password es obligatorio');



      // El usuario exista

      // Verificar el password
        
    });
});
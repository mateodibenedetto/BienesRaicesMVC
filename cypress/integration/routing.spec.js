/// <reference types="cypress"/>

describe('Prueba la navegación y Routing del Header y Footer', () => {
    it('Prueba la navegación del Header', () => {
        cy.visit('/');

        cy.get('[data-cy="navegacion-header"]').should('exist');
        cy.get(' [data-cy="navegacion-header"]').find('a').should('have.length', 5);
        cy.get('[data-cy="navegacion-header"]').find ('a').should('not.have.length', 6);

       // Revisar que los enlaces sean correctos
        cy.get('[data-cy="navegacion-header"]').find('a').eq(0).invoke('attr', 'href').should('equal', '/public/nosotros'); // eq(indice) por si tenemos una lista
        cy.get('[data-cy="navegacion-header"]').find('a').eq(0).invoke('text').should('equal', 'Nosotros');

        cy.get('[data-cy="navegacion-header"]').find('a').eq(1).invoke('attr', 'href').should('equal', '/public/propiedades'); // eq(indice) por si tenemos una lista
        cy.get('[data-cy="navegacion-header"]').find('a').eq(1).invoke('text').should('equal', 'Propiedades');

        cy.get('[data-cy="navegacion-header"]').find('a').eq(2).invoke('attr', 'href').should('equal', '/public/blog'); // eq(indice) por si tenemos una lista
        cy.get('[data-cy="navegacion-header"]').find('a').eq(2).invoke('text').should('equal', 'Blog');

        cy.get('[data-cy="navegacion-header"]').find('a').eq(3).invoke('attr', 'href').should('equal', '/public/contacto'); // eq(indice) por si tenemos una lista
        cy.get('[data-cy="navegacion-header"]').find('a').eq(3).invoke('text').should('equal', 'Contacto');
    });

    it('Prueba la navegación del Footer', () => {
        cy.get('[data-cy="navegacion-footer"]').should('exist');
        cy.get('[data-cy="navegacion-footer"]').should('have.prop', 'class').should('equals', 'navegacion2');
        cy.get(' [data-cy="navegacion-footer"]').find('a').should('have.length', 4);
        cy.get('[data-cy="navegacion-footer"]').find ('a').should('not.have.length', 6);

       // Revisar que los enlaces sean correctos
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(0).invoke('attr', 'href').should('equal', '/public/nosotros'); // eq(indice) por si tenemos una lista
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(0).invoke('text').should('equal', 'Nosotros');

        cy.get('[data-cy="navegacion-footer"]').find('a').eq(1).invoke('attr', 'href').should('equal', '/public/propiedades'); // eq(indice) por si tenemos una lista
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(1).invoke('text').should('equal', 'Propiedades');

        cy.get('[data-cy="navegacion-footer"]').find('a').eq(2).invoke('attr', 'href').should('equal', '/public/blog'); // eq(indice) por si tenemos una lista
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(2).invoke('text').should('equal', 'Blog');

        cy.get('[data-cy="navegacion-footer"]').find('a').eq(3).invoke('attr', 'href').should('equal', '/public/contacto'); // eq(indice) por si tenemos una lista
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(3).invoke('text').should('equal', 'Contacto');

        cy.get('[data-cy="copyright"]').should('have.prop', 'class').should('equals', 'copyright');
        
    });
});
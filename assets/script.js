// js pour le burger button de la version mobile
const getBurgerButton = document.getElementById('burgerButton');
const getBurger = document.getElementById('burger');
const getBurgerNavbar = document.getElementById('navbar');
const getBody = document.querySelector('body');

// lors du click sur le burger button > rajout si non présent/retrait si déjà présent de la classe "active" et noScroll sur le body pour empecher le scroll d l'arriere plan
getBurgerButton.addEventListener('click', function() {
    getBurger.classList.toggle('active');
    getBurgerNavbar.classList.toggle('active');
    getBody.classList.toggle('noScroll')
})
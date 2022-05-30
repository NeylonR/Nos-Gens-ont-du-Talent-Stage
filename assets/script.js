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

const getFilter = document.querySelectorAll('.filterForm input');
const getResetButton = document.querySelector('.filterForm .reset');
if(getFilter.length > 1){
    getResetButton.addEventListener('click', (e) => {
        e.preventDefault();
        getFilter.forEach(input => {
            input.checked = false;
        });
    })
}

const getNavAbout = document.querySelector('.navAbout');
const getNavProject = document.querySelector('.navProject');
const getNavAgency = document.querySelector('.navAgency');
const getNavContact = document.querySelector('.navContact');
const getNavCompany = document.querySelector('.navCompany');
const getNavTalent = document.querySelector('.navTalent');
const getProfileNavLi = document.querySelectorAll('.profileNav [data-status]');
const getProfileContainer = document.querySelectorAll('div[data-status]');

function renderProfileDom(e, profileString){
            getProfileNavLi.forEach(element => {
                element.dataset.status = "unselected"
            });
            e.target.dataset.status = "selected";

            getProfileContainer.forEach(element => {
                element.dataset.status = "hidden";
            });
            const targetElement = document.querySelectorAll('[data-link='+ profileString +']');
            targetElement[1].dataset.status = "visible";
}

getNavAbout.addEventListener('click', function(e){
    renderProfileDom(e, 'description');
});
if(getNavProject){
   getNavProject.addEventListener('click', function(e){
    renderProfileDom(e, 'project');
});}

if(getNavAgency){
    getNavAgency.addEventListener('click', function(e){
    renderProfileDom(e, 'agency');
});}

if(getNavContact){
    getNavContact.addEventListener('click', function(e){
    renderProfileDom(e, 'contact');
});}

if(getNavCompany){
    getNavCompany.addEventListener('click', function(e){
        renderProfileDom(e, 'company');
});}

if(getNavTalent){
    getNavTalent.addEventListener('click', function(e){
        renderProfileDom(e, 'talent');
});}
// const getProjectPaginator = document.querySelectorAll('.projectContainer .navigation a');
// console.log(getProjectPaginator);
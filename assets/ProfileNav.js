/**
 * @property {HTMLElement} navTalent
 * @property {HTMLElement} navProject
 * @property {HTMLElement} navAgency
 * @property {HTMLElement} navCompany
 * @property {HTMLElement} navAbout
 * @property {HTMLElement} navContact
 * @property {HTMLElement} profileNav
 * @property {HTMLElement} testest
 * @property {HTMLFormElement} form
 */
 export default class ProfileNav{

    /**
     * @param {HTMLElement|null} element 
     */
    constructor(element) {
        if(element === null) {
            return;
        }
        this.profileNav = element.querySelector('.profileNav');
        this.navTalent = element.querySelector('.navTalent');
        this.navProject = element.querySelector('.navProject');
        this.navAgency = element.querySelector('.navAgency');
        this.navCompany = element.querySelector('.navCompany');
        this.navAbout = element.querySelector('.navAbout');
        this.navContact = element.querySelector('.navContact');
        this.testest = element.querySelector('.testest');
        this.bindEvents();
    }

    bindEvents(){
        this.navProject.addEventListener('click', this.loadForm.bind(this));

        // this.pagination.addEventListener('click', aClickListener);
    }

    async loadForm(){
        console.log(this.navProject.innerText)
        const data = this.navProject.innerText;
        const url = new URL(window.location.href);
        const params = new URLSearchParams();
        // data.forEach((value, key) => {
        //     params.append(key, value);
        // })
        return this.loadUrl(url.pathname + '?' + data.toString());
    }

    async loadUrl(url) {
        const ajaxUrl = url + '&ajax=1';
        const response = await fetch(ajaxUrl, {
            headers: {
                'X-Requested-With' : 'XMLHttpRequest'
            }
        })

        if(response.status >= 200 && response.status < 300){
            const data = await response.json();
            console.log(data)
            this.testest.innerHTML = data.content;
            // this.pagination.innerHTML = data.pagination;
            history.replaceState({}, '', url);
        } else{
            console.error(response)
        }
    }
}
/**
 * @property {HTMLElement} projectContainer
 * @property {HTMLElement} profileNav
 * @property {HTMLElement} agencyContainer
 * @property {HTMLElement} companyContainer
 * @property {HTMLElement} talentContainer
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
        this.projectContainer = element.querySelector('.projectContainer');
        this.agencyContainer = element.querySelector('.agencyContainer');
        this.companyContainer = element.querySelector('.companyContainer');
        this.talentContainer = element.querySelector('.talentContainer');
        this.bindEvents();
    }

    bindEvents(){
        const aClickListener = e => {
            this.loadUrl(e.target.getAttribute('href'))
        }

        if(this.projectContainer){
            this.projectContainer.addEventListener('click', function(e){
                if(e.target.classList.contains("ajax")){
                    e.preventDefault();
                    aClickListener(e);
                }
            })
        }

        if(this.agencyContainer){
            this.agencyContainer.addEventListener('click', function(e){
                if(e.target.classList.contains("ajax")){
                    e.preventDefault();
                    aClickListener(e);
                }
            })
        }

        if(this.talentContainer){
            this.talentContainer.addEventListener('click', function(e){
                if(e.target.classList.contains("ajax")){
                    e.preventDefault();
                    aClickListener(e);
                }
            })
        }

        if(this.companyContainer){
            this.companyContainer.addEventListener('click', function(e){
                if(e.target.classList.contains("ajax")){
                    e.preventDefault();
                    aClickListener(e);
                }
            })
        }
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
            // console.log(data);
            if(this.projectContainer && url.includes('pageProjects')){
                this.projectContainer.innerHTML = data.project;
            }
            if(this.agencyContainer && url.includes('pageAgency')){
                this.agencyContainer.innerHTML = data.agency;
            }
            if(this.companyContainer && url.includes('pageCompany')){
                this.companyContainer.innerHTML = data.company;
            }
            if(this.talentContainer && url.includes('pageTalents')){
                this.talentContainer.innerHTML = data.talent;
            }
            history.replaceState({}, '', url);
        } else{
            console.error(response)
        }
    }
}
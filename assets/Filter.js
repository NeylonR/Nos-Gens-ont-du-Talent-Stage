/**
 * @property {HTMLElement} pagination
 * @property {HTMLElement} cardContainer
 * @property {HTMLElement} reset
 * @property {HTMLFormElement} form
 */
export default class Filter{

    /**
     * @param {HTMLElement|null} element 
     */
    constructor(element) {
        if(element === null) {
            return;
        }
        this.pagination = element.querySelector('.navigation');
        this.cardContainer = element.querySelector('.cardContainer');
        this.form = element.querySelector('.filterForm');
        this.reset = element.querySelector('.filterForm .reset');
        this.bindEvents();
    }

    bindEvents(){
        // const aClickListener = e => {
        //     if (e.target.tagName === 'A') {
        //       e.preventDefault()
        //       this.loadUrl(e.target.getAttribute('href'))
        //     }
        //   };
        this.form.querySelectorAll('input[type=checkbox]').forEach(input => {
            input.addEventListener('change', this.loadForm.bind(this));
        });

        this.reset.addEventListener('click', this.loadForm.bind(this));

        // this.pagination.addEventListener('click', aClickListener);
    }

    async loadForm(){
        const data = new FormData(this.form);
        const url = new URL(this.form.getAttribute('action') || window.location.href);
        const params = new URLSearchParams();
        data.forEach((value, key) => {
            params.append(key, value);
        })
        return this.loadUrl(url.pathname + '?' + params.toString());
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
            this.cardContainer.innerHTML = data.content;
            this.pagination.innerHTML = data.pagination;
            history.replaceState({}, '', url);
        } else{
            console.error(response)
        }
    }
}
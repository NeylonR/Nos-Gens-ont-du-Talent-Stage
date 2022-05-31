import {Flipper, spring} from 'flip-toolkit';
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
        this.form.querySelectorAll('input[type=checkbox]').forEach(input => {
            input.addEventListener('change', this.loadForm.bind(this));
        });

        this.reset.addEventListener('click', this.loadForm.bind(this));
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
            // this.cardContainer.innerHTML = data.content;
            this.flipContent(data.content);
            this.pagination.innerHTML = data.pagination;
            history.replaceState({}, '', url);
        } else{
            console.error(response)
        }
    }
    /**
     * 
     * @param {string} content 
     */
    flipContent(content){
        const exitSpring = function(element, index, removeElement){
            spring({
                config: "stiff",
                values: {
                    opacity: [1, 0],
                    scale: [1,0]
                },
                onUpdate: ({opacity, scale}) => {
                    element.style.opacity = opacity;
                    element.style.transform = `scaleX(${scale})`;
                },
                onComplete: removeElement
            })
        }
        const appearSpring = function(element, index){
            spring({
                config: "stiff",
                values: {
                    opacity: [0, 1],
                    scale: [0,1]
                },
                onUpdate: ({opacity, scale}) => {
                    element.style.opacity = opacity;
                    element.style.transform = `scaleX(${scale})`;
                },

            })
        }
        const flipper = new Flipper({
            element: this.cardContainer
        })

        Array.from(this.cardContainer.children).forEach(element => {
            flipper.addFlipped({
                element,
                spring: "stiff",
                flipId: element.id,
                shouldFlip: false,
                onExit: exitSpring
            })
        })
        flipper.recordBeforeUpdate();

        this.cardContainer.innerHTML = content;
        Array.from(this.cardContainer.children).forEach(element => {
            flipper.addFlipped({
                element,
                spring: "stiff",
                flipId: element.id,
                onAppear: appearSpring
            })
        })
        flipper.update();
    }
}
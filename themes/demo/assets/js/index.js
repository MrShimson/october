class App {
    popovers = document.querySelectorAll('[data-bs-toggle="popover"]');
    carousels = document.querySelectorAll('.fancybox-default');
    phoneInputs = document.querySelectorAll('input[type="tel"]');
    burgerFixed = document.querySelector('.burger-fixed');

    constructor() {
        this.initPopovers();
        this.initSliders();
        this.initPhoneMask();
        this.initAOS();
        this.initSidebar();
        this.initHandlers();
    }

    initPopovers() {
        this.popovers.forEach((popover) => {
            new bootstrap.Popover(popover);
        });
    }

    initSliders() {
        this.carousels.forEach((carousel) => {
            new Carousel(carousel, {
                infinite: true,
                buttons: [false, false],
                Autoplay: {
                    timeout: 3000,
                },
                Navigation: {}
            }, {Autoplay});
        })

        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });
    }

    initPhoneMask() {
        this.phoneInputs.forEach((input) => {
            IMask(input, {mask: '+{7}(000)000-00-00'});
        });
    }

    initAOS() {
        AOS.init();
    }

    initSidebar() {
        const wrapper = document.querySelector('.sidebar');
        const backdrop = wrapper.querySelector('.sidebar__backdrop');
        const btnClose = wrapper.querySelector('.sidebar__close-btn');
        const links = wrapper.querySelectorAll('.sidebar__nav-link');
        const burger = document.querySelector('.burger-icon');

        const close = () => {
            wrapper.classList.add('d-none');
        };

        const show = () => {
            wrapper.classList.remove('d-none');
        };

        this.burgerFixed.addEventListener('click', show);
        burger.addEventListener('click', show);
        backdrop.addEventListener('click', close);
        btnClose.addEventListener('click', close);
        links.forEach((link) => {
            link.addEventListener('click', close);
        });
    }

    initHandlers() {
        window.addEventListener('scroll', this.windowScrollHandler.bind(this));
    }

    windowScrollHandler() {
        if (window.scrollY > 100) {
            this.burgerFixed.classList.remove('opacity-0');
        } else {
            this.burgerFixed.classList.add('opacity-0');
        }
    }
}

new App();

import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';

Alpine.plugin(intersect);
window.Alpine = Alpine;

Alpine.data('slider', () => ({
    currentSlide: 0,
    totalSlides: 0,
    autoplay: null,
    init() {
        this.totalSlides = this.$refs.slides?.children.length || 0;
        this.startAutoplay();
    },
    next() {
        this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
    },
    prev() {
        this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
    },
    goTo(index) {
        this.currentSlide = index;
    },
    startAutoplay() {
        this.autoplay = setInterval(() => this.next(), 5000);
    },
    stopAutoplay() {
        clearInterval(this.autoplay);
    },
}));

Alpine.data('mobileMenu', () => ({
    open: false,
    toggle() { this.open = !this.open; },
    close() { this.open = false; },
}));

Alpine.data('scrollAnimation', () => ({
    shown: false,
    init() {
        const observer = new IntersectionObserver(
            ([entry]) => { if (entry.isIntersecting) this.shown = true; },
            { threshold: 0.1 }
        );
        observer.observe(this.$el);
    },
}));

Alpine.data('counter', (target, duration = 2000) => ({
    current: 0,
    target: target,
    init() {
        const observer = new IntersectionObserver(([entry]) => {
            if (entry.isIntersecting) {
                this.animate();
                observer.disconnect();
            }
        }, { threshold: 0.5 });
        observer.observe(this.$el);
    },
    animate() {
        const step = this.target / (duration / 16);
        const timer = setInterval(() => {
            this.current += step;
            if (this.current >= this.target) {
                this.current = this.target;
                clearInterval(timer);
            }
        }, 16);
    },
}));

Alpine.start();

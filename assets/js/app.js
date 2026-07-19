document.addEventListener('DOMContentLoaded', () => {
  const root = document.getElementById('app');
  const portfolio = JSON.parse(root.dataset.portfolio);

  Vue.createApp({
    data() {
      return {
        portfolio,
        menuOpen: false,
        isScrolled: false,
        nav: [
          { label: 'Home', href: '#home' },
          { label: 'About', href: '#about' },
          { label: 'Services', href: '#services' },
          { label: 'Expertise', href: '#expertise' },
          { label: 'Contact', href: '#contact' },
        ],
      };
    },
    mounted() {
      this.onScroll();
      window.addEventListener('scroll', this.onScroll, { passive: true });
    },
    unmounted() {
      window.removeEventListener('scroll', this.onScroll);
    },
    methods: {
      onScroll() {
        this.isScrolled = window.scrollY > 12;
      },
    },
  }).mount('#app');
});

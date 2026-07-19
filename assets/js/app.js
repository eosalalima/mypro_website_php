document.addEventListener('DOMContentLoaded', () => {
  const root = document.getElementById('app');
  const site = JSON.parse(root.dataset.site);

  const SectionHeader = {
    props: ['eyebrow', 'title', 'text'],
    template: `
      <header class="section-header">
        <p class="kicker">{{ eyebrow }}</p>
        <h2>{{ title }}</h2>
        <p>{{ text }}</p>
      </header>
    `,
  };

  const ServiceCard = {
    props: ['item'],
    template: `
      <article class="service-card">
        <div class="service-icon">{{ item.icon }}</div>
        <h3>{{ item.title }}</h3>
        <p>{{ item.shortDescription }}</p>
        <ul>
          <li v-for="benefit in item.benefits.slice(0, 4)" :key="benefit">✓ {{ benefit }}</li>
        </ul>
      </article>
    `,
  };

  Vue.createApp({
    components: { SectionHeader, ServiceCard },
    data() {
      return {
        site,
        company: site.company,
        menuOpen: false,
        isScrolled: false,
        nav: [
          { label: 'About', href: '#about' },
          { label: 'Solutions', href: '#solutions' },
          { label: 'Expertise', href: '#expertise' },
          { label: 'Products', href: '#products' },
          { label: 'Projects', href: '#projects' },
          { label: 'Insights', href: '#insights' },
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
        this.isScrolled = window.scrollY > 10;
      },
      categoryFor(index) {
        if (index < 6) return 'Infrastructure & Security';
        if (index < 12) return 'Hardware & Software';
        return 'Managed & Data Center Services';
      },
    },
  }).mount('#app');
});

<?php $site = require __DIR__ . '/data.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($site['company']['brandName']) ?> | <?= htmlspecialchars($site['company']['tagline']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($site['company']['description']) ?>">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script defer src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    <script defer src="assets/js/app.js"></script>
</head>
<body>
<div id="app" data-site='<?= htmlspecialchars(json_encode($site), ENT_QUOTES, 'UTF-8') ?>' v-cloak>
    <header class="navbar" :class="{ 'navbar--scrolled': isScrolled }">
        <a href="#home" class="logo"><span class="logo-mark">MY</span><span>PRO</span></a>
        <button class="mobile-menu" @click="menuOpen = !menuOpen" :aria-expanded="menuOpen.toString()" aria-controls="main-menu">Menu</button>
        <nav id="main-menu" :class="{ open: menuOpen }" aria-label="Primary navigation">
            <a v-for="item in nav" :key="item.href" :href="item.href" @click="menuOpen = false">{{ item.label }}</a>
            <a class="nav-pill" href="#admin" @click="menuOpen = false">Admin CMS</a>
            <a class="nav-cta" href="#contact" @click="menuOpen = false">Contact</a>
        </nav>
    </header>

    <main>
        <section id="home" class="hero page-section">
            <div class="hero-content">
                <p class="kicker">{{ company.brandName }} · {{ company.tagline }}</p>
                <h1>{{ company.headline }}</h1>
                <p class="lead">{{ company.description }}</p>
                <div class="actions">
                    <a class="button button-primary" href="#solutions">Explore Solutions</a>
                    <a class="button button-secondary" href="#contact">Contact Us</a>
                </div>
            </div>
            <aside class="hero-visual">
                <div class="logo-panel">MYPRO</div>
                <h2>Integrated IT Solutions</h2>
                <p>Infrastructure · Security · Cloud-ready operations · Managed expertise</p>
            </aside>
        </section>

        <section id="about" class="page-section two-column">
            <div>
                <p class="kicker">About MyPro</p>
                <h2>Consultancy and systems integration for changing technology needs.</h2>
            </div>
            <div class="copy-stack">
                <p>{{ company.mission }}</p>
                <p>{{ company.vision }}</p>
                <div class="tag-row"><span v-for="value in company.values" :key="value">{{ value }}</span></div>
            </div>
        </section>

        <section id="solutions" class="page-section section-muted">
            <section-header eyebrow="Solutions and services" title="Integrated IT solutions for modern organizations" text="MyPro covers the full lifecycle of business technology from consulting and design to deployment, support, and improvement."></section-header>
            <div class="card-grid cards-five">
                <service-card v-for="service in site.services" :key="service.slug" :item="service"></service-card>
            </div>
        </section>

        <section id="expertise" class="page-section">
            <section-header eyebrow="Expertise" title="Practical capabilities across infrastructure, security, hardware, software, and operations" text="The portfolio highlights hands-on delivery expertise for the technology foundations businesses depend on."></section-header>
            <div class="expertise-grid">
                <article v-for="(item, index) in site.expertise" :key="item" class="expertise-card">
                    <span>{{ categoryFor(index) }}</span>
                    <h3>{{ item }}</h3>
                    <p>Practical expertise in {{ item.toLowerCase() }} for reliable, secure, and scalable IT operations.</p>
                </article>
            </div>
        </section>

        <section id="products" class="page-section section-muted">
            <section-header eyebrow="Products and partners" title="Strategic product lines for complete delivery" text="MyPro pairs services with relevant products and partner ecosystems so customers can source, implement, and support solutions through one technology partner."></section-header>
            <div class="product-grid">
                <article v-for="product in site.productLines" :key="product.title" class="product-card">
                    <div class="placeholder">Logo Placeholder</div>
                    <p class="card-meta">{{ product.category }}</p>
                    <h3>{{ product.title }}</h3>
                    <p>{{ product.description }}</p>
                    <div class="brand-row"><span v-for="brand in product.partnerBrands" :key="brand">{{ brand }}</span></div>
                </article>
            </div>
        </section>

        <section id="projects" class="page-section">
            <section-header eyebrow="Projects" title="Sample solution delivery stories" text="These CMS-ready placeholders mirror the source repository structure for future project case studies."></section-header>
            <div class="story-grid">
                <article v-for="(project, index) in site.projects" :key="project" class="story-card">
                    <span>{{ ['Infrastructure', 'Cybersecurity', 'Data Center', 'Digital Transformation'][index % 4] }} · {{ ['Enterprise', 'SME', 'Corporate', 'Retail'][index % 4] }}</span>
                    <h3>{{ project }}</h3>
                    <p>MyPro assessed requirements, designed the technical approach, supplied compatible products, and implemented the solution with documentation and support.</p>
                    <strong>Result: improved reliability, operational visibility, and readiness for future growth.</strong>
                </article>
            </div>
        </section>

        <section id="insights" class="page-section section-muted">
            <section-header eyebrow="Insights" title="Technology guidance for growing organizations" text="Use this area for CMS-managed articles, company news, and customer education."></section-header>
            <div class="blog-grid">
                <article v-for="(post, index) in site.blogPosts" :key="post" class="blog-card">
                    <p class="card-meta">{{ ['Infrastructure', 'Managed Services', 'Cybersecurity', 'Digital Transformation'][index] }} · 2026-0{{ index + 1 }}-15</p>
                    <h3>{{ post }}</h3>
                    <p>Practical insights from MyPro Solutions on {{ post.toLowerCase() }}.</p>
                    <a href="#contact">Read insight →</a>
                </article>
            </div>
        </section>

        <section id="admin" class="page-section cms-band">
            <div>
                <p class="kicker">Admin CMS</p>
                <h2>Content-ready structure without a PHP framework.</h2>
                <p>Company profile, services, expertise, products, projects, blog posts, and testimonials are centralized in PHP data arrays so they can later be connected to a CMS or database.</p>
            </div>
            <div class="cms-modules"><span v-for="module in ['Company', 'Services', 'Expertise', 'Products', 'Projects', 'Blog', 'Testimonials']" :key="module">{{ module }}</span></div>
        </section>

        <section id="contact" class="page-section contact-section">
            <div>
                <p class="kicker">Ready to simplify IT?</p>
                <h2>Let’s simplify your IT requirements.</h2>
                <p>Talk to MyPro Solutions about infrastructure, cybersecurity, managed services, products, and digital transformation.</p>
                <ul class="contact-list">
                    <li>{{ company.email }}</li>
                    <li v-for="phone in company.phoneNumbers" :key="phone">{{ phone }}</li>
                    <li>{{ company.website }}</li>
                </ul>
            </div>
            <form class="contact-form" method="post" action="contact.php">
                <label>Name<input name="name" required autocomplete="name"></label>
                <label>Email<input type="email" name="email" required autocomplete="email"></label>
                <label>Message<textarea name="message" rows="5" required></textarea></label>
                <button class="button button-primary" type="submit">Send inquiry</button>
            </form>
        </section>
    </main>

    <footer class="footer">
        <div><a href="#home" class="logo logo-light"><span class="logo-mark">MY</span><span>PRO</span></a><p>{{ company.description }}</p></div>
        <div><h3>Explore</h3><a v-for="item in nav" :key="item.href" :href="item.href">{{ item.label }}</a></div>
        <div><h3>Contact</h3><p>{{ company.email }}</p><p v-for="phone in company.phoneNumbers" :key="phone">{{ phone }}</p><p>{{ company.website }}</p></div>
        <p class="copyright">© 2026 {{ company.companyName }}. All rights reserved.</p>
    </footer>
</div>
</body>
</html>

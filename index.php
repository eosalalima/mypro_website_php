<?php $portfolio = require __DIR__ . '/data.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($portfolio['brand']) ?> | <?= htmlspecialchars($portfolio['tagline']) ?></title>
  <meta name="description" content="<?= htmlspecialchars($portfolio['company']) ?> portfolio website for IT infrastructure, cybersecurity, computing devices, and systems integration.">
  <link rel="preconnect" href="https://unpkg.com">
  <link rel="stylesheet" href="assets/css/styles.css">
  <script defer src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
  <script defer src="assets/js/app.js"></script>
</head>
<body>
  <div id="app" data-portfolio='<?= htmlspecialchars(json_encode($portfolio), ENT_QUOTES, 'UTF-8') ?>' v-cloak>
    <header class="site-header" :class="{scrolled: isScrolled}">
      <a class="brand" href="#home" aria-label="MyPro home"><span>My</span>Pro</a>
      <button class="nav-toggle" @click="menuOpen = !menuOpen" :aria-expanded="menuOpen.toString()" aria-controls="primary-nav">☰</button>
      <nav id="primary-nav" :class="{open: menuOpen}">
        <a v-for="item in nav" :key="item.href" :href="item.href" @click="menuOpen = false">{{ item.label }}</a>
      </nav>
    </header>

    <main>
      <section id="home" class="hero section-pad">
        <div class="hero-copy">
          <p class="eyebrow">{{ portfolio.company }}</p>
          <h1>{{ portfolio.tagline }}</h1>
          <p>{{ portfolio.intro }}</p>
          <div class="hero-actions">
            <a class="btn primary" href="#contact">Start a project</a>
            <a class="btn ghost" href="#services">Explore services</a>
          </div>
        </div>
        <div class="hero-card" aria-label="Portfolio highlights">
          <span class="card-label">Portfolio 2026</span>
          <strong>Integrated IT Solutions</strong>
          <p>Infrastructure • Security • Devices • Cabling • Integration</p>
        </div>
      </section>

      <section id="about" class="section-pad split">
        <div><p class="eyebrow">Who we are</p><h2>Specialized IT consultancy and systems integration.</h2></div>
        <div><p>{{ portfolio.promise }}</p><div class="chips"><span v-for="market in portfolio.markets" :key="market">{{ market }}</span></div></div>
      </section>

      <section id="services" class="section-pad services">
        <p class="eyebrow">Solutions and services overview</p>
        <h2>Built for modern business operations.</h2>
        <div class="service-grid">
          <article v-for="service in portfolio.services" :key="service.title" class="service-card">
            <i :class="['fa-solid', 'fa-' + service.icon]"></i>
            <h3>{{ service.title }}</h3>
            <p>{{ service.summary }}</p>
          </article>
        </div>
      </section>

      <section id="expertise" class="section-pad expertise">
        <div class="panel"><p class="eyebrow">Our key expertise</p><h2>From planning to deployment and support.</h2><p>MyPro combines product sourcing, project delivery, network design, security planning, endpoint deployment, and integration support so customers can keep pace with technology change.</p></div>
        <div class="value-list"><div v-for="(value, index) in portfolio.values" :key="value"><span>{{ String(index + 1).padStart(2, '0') }}</span><strong>{{ value }}</strong></div></div>
      </section>

      <section id="contact" class="section-pad contact">
        <div><p class="eyebrow">Contact</p><h2>Ready to modernize your IT environment?</h2><p>Tell us about your infrastructure, security, device, or integration requirements.</p></div>
        <form class="contact-form" method="post" action="contact.php">
          <label>Name<input name="name" required></label>
          <label>Email<input type="email" name="email" required></label>
          <label>Message<textarea name="message" rows="4" required></textarea></label>
          <button class="btn primary" type="submit">Send inquiry</button>
        </form>
      </section>
    </main>

    <footer><strong>{{ portfolio.brand }}</strong><span>{{ portfolio.contact.email }} · {{ portfolio.contact.phone }} · {{ portfolio.contact.location }}</span></footer>
  </div>
</body>
</html>

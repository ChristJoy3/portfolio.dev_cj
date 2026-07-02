<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>About Me — Christ Joy Macuto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config={theme:{extend:{colors:{lime:{400:'#00b0ff',500:'#0090d0'}}}}}
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
      :root{--accent:#00b0ff;--bg:#111827;--panel:rgba(31,41,55,.55);--border:rgba(255,255,255,.07);--text:#e5e7eb;--muted:#9ca3af;--heading:#fff}
      body.light{--bg:#f3f4f6;--panel:#ffffff;--border:rgba(0,0,0,.07);--text:#374151;--muted:#6b7280;--heading:#111827}
      body{background:var(--bg);color:var(--text);transition:background-color .3s ease,color .3s ease}
      .heading{color:var(--heading)}
      .muted{color:var(--muted)}

      /* Top bar controls (same pattern as the home page) */
      .theme-toggle{position:fixed;top:1.25rem;right:4.25rem;z-index:60;background:none;border:none;cursor:pointer;color:var(--heading);transition:transform .25s ease}
      .theme-toggle:hover{transform:scale(1.15) rotate(12deg)}
      .menu-toggle{position:fixed;top:1.45rem;right:1.5rem;z-index:70;width:26px;height:20px;background:none;border:none;cursor:pointer;display:flex;flex-direction:column;justify-content:space-between;padding:0}
      .menu-toggle span{display:block;height:3px;width:100%;border-radius:2px;background:var(--heading);transition:transform .3s ease,opacity .3s ease,width .3s ease}
      .menu-toggle:hover span:nth-child(2){width:70%}
      .menu-toggle.open span:nth-child(1){transform:translateY(8.5px) rotate(45deg)}
      .menu-toggle.open span:nth-child(2){opacity:0}
      .menu-toggle.open span:nth-child(3){transform:translateY(-8.5px) rotate(-45deg)}
      .nav-menu{position:fixed;top:4rem;right:1.5rem;z-index:69;min-width:12.5rem;background:var(--panel);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);border:1px solid rgba(0,176,255,.25);border-radius:.9rem;box-shadow:0 20px 45px -18px rgba(0,0,0,.6);padding:.5rem;opacity:0;transform:translateY(-8px) scale(.97);pointer-events:none;transition:opacity .25s ease,transform .25s ease}
      .nav-menu.open{opacity:1;transform:translateY(0) scale(1);pointer-events:auto}
      .nav-menu a{display:flex;align-items:center;gap:.7rem;padding:.7rem .95rem;border-radius:.6rem;color:var(--text);font-weight:600;font-size:.9rem;text-decoration:none;transition:background-color .2s ease,color .2s ease,transform .2s ease}
      .nav-menu a:hover{background:rgba(0,176,255,.14);color:var(--accent);transform:translateX(3px)}
      .nav-menu a i{width:1.15rem;text-align:center;color:var(--accent)}

      .back-link{position:fixed;top:1.25rem;left:1.5rem;z-index:60;display:inline-flex;align-items:center;gap:.55rem;padding:.55rem 1.1rem;border-radius:9999px;background:var(--panel);border:1px solid rgba(0,176,255,.25);color:var(--text);font-size:.85rem;font-weight:600;text-decoration:none;backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);transition:transform .25s ease,color .25s ease,box-shadow .25s ease}
      .back-link:hover{transform:translateY(-2px);color:var(--accent);box-shadow:0 10px 24px -10px rgba(0,176,255,.5)}

      /* Hero photo frame */
      .about-figure{position:relative}
      .about-figure::before{content:'';position:absolute;inset:-16px;border-radius:1.75rem;background:linear-gradient(135deg,rgba(0,176,255,.5),transparent 45%,transparent 60%,rgba(0,176,255,.25));filter:blur(20px);opacity:.75;z-index:0}
      .about-frame{position:relative;z-index:1;border-radius:1.25rem;overflow:hidden;border:1px solid rgba(0,176,255,.35);background:var(--panel);box-shadow:0 25px 50px -20px rgba(0,0,0,.55)}
      .about-frame img{display:block;width:100%}
      .about-frame::before,.about-frame::after{content:'';position:absolute;width:2.75rem;height:2.75rem;border:3px solid var(--accent);z-index:2;pointer-events:none}
      .about-frame::before{top:0;left:0;border-right:none;border-bottom:none;border-top-left-radius:1.25rem}
      .about-frame::after{bottom:0;right:0;border-left:none;border-top:none;border-bottom-right-radius:1.25rem}

      .eyebrow{display:inline-flex;align-items:center;gap:.65rem;color:var(--accent);font-size:.78rem;font-weight:700;letter-spacing:.28em;text-transform:uppercase}
      .eyebrow::before{content:'';width:2.5rem;height:2px;background:var(--accent);display:inline-block}

      .card{background:var(--panel);border:1px solid var(--border);border-radius:1rem;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);transition:transform .3s cubic-bezier(.2,.6,.2,1),box-shadow .3s ease,border-color .3s ease}
      .card:hover{transform:translateY(-6px);border-color:rgba(0,176,255,.45);box-shadow:0 16px 32px -14px rgba(0,0,0,.5),0 0 26px -8px rgba(0,176,255,.45)}
      .card-icon{display:inline-flex;align-items:center;justify-content:center;width:3rem;height:3rem;border-radius:.85rem;background:rgba(0,176,255,.12);color:var(--accent);font-size:1.3rem}

      .hero-btn{position:relative;display:inline-flex;align-items:center;gap:.6rem;padding:.8rem 1.9rem;font-weight:700;border-radius:9999px;overflow:hidden;text-decoration:none;transition:transform .3s cubic-bezier(.2,.6,.2,1),box-shadow .3s ease,color .3s ease,background-color .3s ease}
      .hero-btn:hover{transform:translateY(-3px)}
      .hero-btn--primary{background:linear-gradient(135deg,#00b0ff,#0090d0);color:#fff;box-shadow:0 4px 18px -4px rgba(0,176,255,.55)}
      .hero-btn--primary:hover{box-shadow:0 12px 30px -6px rgba(0,176,255,.75)}
      .hero-btn--ghost{background:transparent;border:2px solid var(--accent);color:var(--accent)}
      .hero-btn--ghost:hover{background:var(--accent);color:#000}

      .reveal{opacity:0;transform:translateY(30px);transition:opacity .6s ease,transform .6s ease}
      .reveal.visible{opacity:1;transform:translateY(0)}
    </style>
  </head>
  <body>
    <script>if(localStorage.getItem('theme')==='light'){document.body.classList.add('light');}</script>

    <a href="{{ url('/') }}" class="back-link"><i class="fa-solid fa-arrow-left"></i>Back to Home</a>

    <button id="themeToggle" class="theme-toggle" aria-label="Toggle light and dark theme" title="Toggle theme">
      <span id="themeIcon"></span>
    </button>
    <button id="menuToggle" class="menu-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="navMenu">
      <span></span><span></span><span></span>
    </button>
    <nav id="navMenu" class="nav-menu" aria-label="Site menu">
      <a href="{{ route('about') }}"><i class="fa-solid fa-user"></i>About</a>
      <a href="{{ route('cv') }}"><i class="fa-solid fa-file-lines"></i>CV / Resume</a>
    </nav>

    <main class="max-w-5xl mx-auto px-6 pt-28 pb-20">

      <!-- Intro -->
      <section class="flex flex-col md:flex-row gap-14 items-center mb-20 reveal">
        <div class="md:w-1/3 flex-shrink-0 w-full">
          <div class="about-figure mx-auto max-w-xs">
            <div class="about-frame">
              <img src="{{ asset('storage/assets/cjsheesh.png') }}" alt="Christ Joy Macuto" />
            </div>
          </div>
        </div>
        <div class="md:w-2/3">
          <span class="eyebrow mb-3">About Me</span>
          <h1 class="heading text-4xl md:text-5xl font-bold mb-5">Christ Joy Macuto</h1>
          <p class="heading text-lg font-semibold leading-relaxed mb-4">
            A passionate Full-Stack Web Developer dedicated to building creative and innovative digital solutions.
          </p>
          <p class="leading-relaxed mb-4">
            I'm a web developer based in the Philippines with a strong focus on the PHP and JavaScript ecosystems. I build responsive, user-friendly, and scalable web applications with MySQL as my go-to database — covering everything from schema design and RESTful APIs on the backend to clean, interactive interfaces on the frontend.
          </p>
          <p class="leading-relaxed">
            What drives me is turning real problems into working software. I've built projects from scratch across a range of domains — personal projects, government-related systems, and school management systems — and each one has sharpened how I design, build, test, and ship. As a growing developer, I treat every project as a chance to level up my craft.
          </p>
        </div>
      </section>

      <!-- What I Do -->
      <section class="mb-20">
        <div class="text-center mb-10 reveal">
          <span class="eyebrow justify-center mb-3">What I Do</span>
          <h2 class="heading text-3xl font-bold">Full-Stack, End to End</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="card p-7 reveal">
            <div class="card-icon mb-4"><i class="fa-solid fa-code"></i></div>
            <h3 class="heading text-lg font-bold mb-2">Frontend Development</h3>
            <p class="muted text-sm leading-relaxed">Responsive, accessible interfaces built with HTML, CSS, JavaScript, and React — translating mockup designs into pixel-faithful, interactive web apps.</p>
          </div>
          <div class="card p-7 reveal">
            <div class="card-icon mb-4"><i class="fa-solid fa-server"></i></div>
            <h3 class="heading text-lg font-bold mb-2">Backend Development</h3>
            <p class="muted text-sm leading-relaxed">Robust application logic and RESTful APIs with PHP and Laravel, plus Node/Express — with attention to security, validation, and maintainability.</p>
          </div>
          <div class="card p-7 reveal">
            <div class="card-icon mb-4"><i class="fa-solid fa-database"></i></div>
            <h3 class="heading text-lg font-bold mb-2">Database & Deployment</h3>
            <p class="muted text-sm leading-relaxed">MySQL schema design, query optimization, and shipping to production — from cPanel hosting to modern deployment workflows with Git and GitHub.</p>
          </div>
        </div>
      </section>

      <!-- Experience Highlights -->
      <section class="mb-20">
        <div class="text-center mb-10 reveal">
          <span class="eyebrow justify-center mb-3">Experience</span>
          <h2 class="heading text-3xl font-bold">Projects Built From Scratch</h2>
        </div>
        <div class="space-y-5">
          <div class="card p-7 flex flex-col sm:flex-row gap-5 items-start reveal">
            <div class="card-icon flex-shrink-0"><i class="fa-solid fa-landmark"></i></div>
            <div>
              <h3 class="heading text-lg font-bold mb-1">Government-Related Systems</h3>
              <p class="muted text-sm leading-relaxed">Developed web-based systems supporting local government processes — focusing on reliable record management, clear reporting, and interfaces that non-technical staff can use with confidence.</p>
            </div>
          </div>
          <div class="card p-7 flex flex-col sm:flex-row gap-5 items-start reveal">
            <div class="card-icon flex-shrink-0"><i class="fa-solid fa-school"></i></div>
            <div>
              <h3 class="heading text-lg font-bold mb-1">School Management Systems</h3>
              <p class="muted text-sm leading-relaxed">Built management systems for schools covering student records, enrollment workflows, and administrative dashboards — designed around the day-to-day needs of teachers and staff.</p>
            </div>
          </div>
          <div class="card p-7 flex flex-col sm:flex-row gap-5 items-start reveal">
            <div class="card-icon flex-shrink-0"><i class="fa-solid fa-rocket"></i></div>
            <div>
              <h3 class="heading text-lg font-bold mb-1">Personal Projects & Freelance Work</h3>
              <p class="muted text-sm leading-relaxed">From this portfolio to WordPress sites for local businesses, I use personal and freelance projects to explore new tools, refine my workflow, and keep growing as a developer.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- CTA -->
      <section class="text-center reveal">
        <h2 class="heading text-3xl font-bold mb-3">Let's Build Something Together</h2>
        <p class="muted mb-8 max-w-xl mx-auto">Interested in working together, or want the full rundown of my background? Check out my CV or send me a message.</p>
        <div class="flex flex-wrap justify-center gap-4">
          <a href="{{ route('cv') }}" class="hero-btn hero-btn--primary"><i class="fa-solid fa-file-lines"></i><span>View CV / Resume</span></a>
          <a href="mailto:christjoy@gmail.com" class="hero-btn hero-btn--ghost"><i class="fa-solid fa-envelope"></i><span>Email Me</span></a>
        </div>
      </section>

    </main>

    <footer class="border-t px-6 py-6 text-center" style="border-color:var(--border)">
      <p class="muted text-sm">&copy; {{ date('Y') }} Christ Joy Macuto. All rights reserved.</p>
    </footer>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        // Scroll reveal
        const revealEls = document.querySelectorAll('.reveal');
        const revealObs = new IntersectionObserver((entries) => {
          entries.forEach((e) => {
            if (e.isIntersecting) {
              e.target.classList.add('visible');
              revealObs.unobserve(e.target);
            }
          });
        }, { threshold: 0.15 });
        revealEls.forEach((el) => revealObs.observe(el));

        // Theme toggle (shared localStorage key with the home page)
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const sunSVG = `<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><line x1="12" y1="2" x2="12" y2="4"/><line x1="12" y1="20" x2="12" y2="22"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="2" y1="12" x2="4" y2="12"/><line x1="20" y1="12" x2="22" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>`;
        const moonSVG = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>`;
        const applyTheme = (theme) => {
          const light = theme === 'light';
          document.body.classList.toggle('light', light);
          themeIcon.innerHTML = light ? sunSVG : moonSVG;
        };
        applyTheme(localStorage.getItem('theme') || 'dark');
        themeToggle.addEventListener('click', () => {
          const next = document.body.classList.contains('light') ? 'dark' : 'light';
          localStorage.setItem('theme', next);
          applyTheme(next);
        });

        // Hamburger nav menu
        const menuToggle = document.getElementById('menuToggle');
        const navMenu = document.getElementById('navMenu');
        const setMenu = (open) => {
          menuToggle.classList.toggle('open', open);
          navMenu.classList.toggle('open', open);
          menuToggle.setAttribute('aria-expanded', open);
        };
        menuToggle.addEventListener('click', (e) => {
          e.stopPropagation();
          setMenu(!navMenu.classList.contains('open'));
        });
        document.addEventListener('click', (e) => {
          if (!navMenu.contains(e.target)) setMenu(false);
        });
        document.addEventListener('keydown', (e) => {
          if (e.key === 'Escape') setMenu(false);
        });
      });
    </script>
  </body>
</html>

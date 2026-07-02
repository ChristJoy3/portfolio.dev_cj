<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profile Card — Clone</title>
    <!-- Quick Tailwind via CDN for preview -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config={theme:{extend:{colors:{lime:{400:'#00b0ff',500:'#0090d0'}}}}}
    </script>
    <!-- Devicons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
      /* Palette: black, white, gray, electric blue accent */
      :root{--accent:#00b0ff;--bg:#000;--panel:#0b0b0b;--muted:#9ca3af}
      body{background:var(--bg);color:#fff}
      /* electric blue accents */
      .accent { background-color:var(--accent)!important }
      .accent-text { color:var(--accent)!important }
      .ring-accent { box-shadow: 0 0 0 6px rgba(0,176,255,0.08), 0 4px 18px rgba(0, 176, 240, 1); }
      .bg-accent { background-color:var(--accent)!important }
      .border-accent { border: 3px solid var(--accent) !important }
      .progress-badge{width:44px;height:44px;border-radius:9999px;display:flex;align-items:center;justify-content:center;position:relative;background:transparent}
      .progress-badge .inner{width:36px;height:36px;border-radius:9999px;background:#0f0f10;display:flex;align-items:center;justify-content:center;font-weight:600;color:#fff;font-size:0.78rem;line-height:1}
      /* Floating animation for skill icons */
      @keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-6px)}}
      /* Scroll reveal */
      .reveal{opacity:0;transform:translateY(30px);transition:opacity .6s ease,transform .6s ease}
      .reveal.visible{opacity:1;transform:translateY(0)}
      .reveal-left{opacity:0;transform:translateX(-40px);transition:opacity .6s ease,transform .6s ease}
      .reveal-left.visible{opacity:1;transform:translateX(0)}
      .reveal-right{opacity:0;transform:translateX(40px);transition:opacity .6s ease,transform .6s ease}
      .reveal-right.visible{opacity:1;transform:translateX(0)}
      /* Timeline line grow */
      .timeline-line{height:0;transition:height 1.2s ease}
      .timeline-line.grow{height:100%}
      /* ── Enhanced Skill cards ── */
      .skill-card{position:relative;background:rgba(31,41,55,.45);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.06);overflow:hidden;text-decoration:none;transition:transform .3s cubic-bezier(.2,.6,.2,1),box-shadow .3s ease,border-color .3s ease}
      .skill-card:hover{transform:translateY(-6px);border-color:color-mix(in srgb,var(--accent) 55%,transparent);box-shadow:0 16px 32px -14px rgba(0,0,0,.65),0 0 26px -6px color-mix(in srgb,var(--accent) 60%,transparent)}
      .skill-card::after{content:'';position:absolute;inset:0;background:radial-gradient(130px circle at var(--mx,50%) var(--my,50%),color-mix(in srgb,var(--accent) 26%,transparent),transparent 70%);opacity:0;transition:opacity .3s ease;pointer-events:none}
      .skill-card:hover::after{opacity:1}
      .skill-icon-wrap{position:relative;z-index:1;display:flex;align-items:center;justify-content:center;height:3rem;animation:float 3s ease-in-out infinite;animation-delay:calc(var(--i,0)*.25s)}
      .skill-icon{width:3rem;height:3rem;object-fit:contain;transition:transform .3s cubic-bezier(.2,.6,.2,1),filter .3s ease}
      .skill-icon-fa{font-size:3rem;line-height:1;transition:transform .3s cubic-bezier(.2,.6,.2,1),filter .3s ease}
      .skill-card:hover .skill-icon,.skill-card:hover .skill-icon-fa{transform:scale(1.18) translateY(-2px);filter:drop-shadow(0 0 14px var(--accent))}
      .skill-name{position:relative;z-index:1;color:#9ca3af;transition:color .3s ease,transform .3s ease}
      .skill-card:hover .skill-name{color:var(--accent);transform:translateY(-1px)}
      .skill-reveal{transition-delay:calc(var(--i,0)*60ms)}
      /* ── Enhanced Contact form ── */
      .contact-card{position:relative;background:rgba(17,24,39,.55);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);border:1px solid rgba(255,255,255,.07);border-radius:1.25rem;box-shadow:0 20px 50px -20px rgba(0,0,0,.6)}
      .contact-card::before{content:'';position:absolute;inset:0;border-radius:1.25rem;padding:1px;background:linear-gradient(135deg,rgba(0,176,255,.5),transparent 40%,transparent 60%,rgba(0,176,255,.3));-webkit-mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);-webkit-mask-composite:xor;mask-composite:exclude;pointer-events:none}
      .input-wrap{position:relative}
      .field-icon{position:absolute;left:1rem;top:50%;transform:translateY(-50%);color:#6b7280;font-size:.95rem;pointer-events:none;transition:color .25s ease}
      .input-wrap--top .field-icon{top:1.05rem;transform:none}
      .input-field{width:100%;padding:.85rem 1rem .85rem 2.75rem;background:rgba(31,41,55,.6);border:1px solid rgba(255,255,255,.08);border-radius:.75rem;color:#fff;transition:border-color .25s ease,box-shadow .25s ease,background-color .25s ease}
      .input-field::placeholder{color:#6b7280}
      .input-field:focus{outline:none;border-color:#00b0ff;background:rgba(31,41,55,.85);box-shadow:0 0 0 4px rgba(0,176,255,.12)}
      .input-wrap:focus-within .field-icon{color:#00b0ff}
      .contact-btn{position:relative;overflow:hidden;background:linear-gradient(135deg,#00b0ff,#0090d0);transition:transform .25s ease,box-shadow .25s ease}
      .contact-btn:hover{transform:translateY(-2px);box-shadow:0 12px 28px -8px rgba(0,176,255,.5)}
      .contact-btn::after{content:'';position:absolute;top:0;left:-75%;width:50%;height:100%;background:linear-gradient(120deg,transparent,rgba(255,255,255,.35),transparent);transform:skewX(-20deg);pointer-events:none}
      .contact-btn:hover::after{animation:cardShine .8s ease}
      .social-btn{display:inline-flex;align-items:center;justify-content:center;width:3rem;height:3rem;border-radius:9999px;background:rgba(31,41,55,.6);border:1px solid rgba(255,255,255,.08);color:#9ca3af;transition:transform .25s ease,color .25s ease,border-color .25s ease,box-shadow .25s ease}
      .social-btn:hover{transform:translateY(-4px);color:#00b0ff;border-color:rgba(0,176,255,.5);box-shadow:0 0 20px -4px rgba(0,176,255,.5)}
      body.light .contact-card{background:rgba(255,255,255,.75);border-color:rgba(0,0,0,.06)}
      body.light .input-field{background:rgba(255,255,255,.85);border-color:rgba(0,0,0,.1);color:#1f2937}
      body.light .social-btn{background:rgba(255,255,255,.85);border-color:rgba(0,0,0,.08)}
      /* Project card image zoom */
      .project-card img{transition:transform .4s ease}
      .project-card:hover img{transform:scale(1.05)}
      /* Project card buttons slide up */
      .project-buttons{transform:translateY(8px);opacity:0;transition:transform .3s ease,opacity .3s ease}
      .project-card:hover .project-buttons{transform:translateY(0);opacity:1}
      /* Button glow */
      .btn-glow:hover{box-shadow:0 0 15px rgba(0,176,255,.4)}
      /* ── Enhanced Project cards ── */
      .project-card{position:relative;background:rgba(31,41,55,.5);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,.07);transition:transform .35s cubic-bezier(.2,.6,.2,1),box-shadow .35s ease,border-color .35s ease}
      .project-card:hover{transform:translateY(-8px);border-color:transparent;box-shadow:0 22px 45px -14px rgba(0,0,0,.65),0 0 34px rgba(0,176,255,.14)}
      /* animated gradient glow border */
      .project-card::before{content:'';position:absolute;inset:0;border-radius:1rem;padding:1px;background:linear-gradient(135deg,rgba(0,176,255,.7),transparent 45%,transparent 55%,rgba(0,176,255,.4));-webkit-mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);-webkit-mask-composite:xor;mask-composite:exclude;opacity:0;transition:opacity .35s ease;pointer-events:none;z-index:3}
      .project-card:hover::before{opacity:1}
      /* cursor spotlight */
      .project-card::after{content:'';position:absolute;inset:0;background:radial-gradient(240px circle at var(--mx,50%) var(--my,50%),rgba(0,176,255,.15),transparent 65%);opacity:0;transition:opacity .35s ease;pointer-events:none;z-index:1}
      .project-card:hover::after{opacity:1}
      .project-body{position:relative;z-index:2}
      /* image gradient overlay + shine sweep */
      .project-media{position:relative}
      .project-media::after{content:'';position:absolute;inset:0;background:linear-gradient(to top,rgba(11,18,32,.9),transparent 55%);opacity:.55;transition:opacity .4s ease;z-index:1;pointer-events:none}
      .project-card:hover .project-media::after{opacity:.3}
      .project-media::before{content:'';position:absolute;top:0;left:-75%;width:55%;height:100%;background:linear-gradient(120deg,transparent,rgba(255,255,255,.22),transparent);transform:skewX(-20deg);z-index:2;pointer-events:none}
      .project-card:hover .project-media::before{animation:cardShine .85s ease}
      @keyframes cardShine{from{left:-75%}to{left:135%}}
      /* tag chips */
      .project-tag{transition:transform .25s ease,background-color .25s ease,box-shadow .25s ease}
      .project-card:hover .project-tag{background-color:rgba(0,176,255,.16)}
      .project-tag:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(0,176,255,.3)}
      /* staggered entrance */
      .project-reveal{transition-delay:calc(var(--i,0)*140ms)}
      body.light .project-card{background:rgba(255,255,255,.7)}
      body.light .project-media::after{background:linear-gradient(to top,rgba(255,255,255,.55),transparent 60%)}
      /* Particle container */
      #particle-sections{position:relative;background:#111827}
      #particle-sections .content-layer>*{background-color:transparent!important}
      #shapegrid{position:fixed;inset:0;z-index:0;pointer-events:none;opacity:0;transition:opacity 1s ease;display:block;width:100%;height:100%;border:none}
      @media(min-width:768px){#shapegrid{left:20rem}}
      #shapegrid.visible{opacity:1}

      /* ── LogoLoop (React Bits <LogoLoop /> ported to vanilla JS) ── */
      .logoloop{position:relative;overflow:hidden;--logoloop-gap:32px;--logoloop-logoHeight:28px;--logoloop-fadeColorAuto:#111827}
      .logoloop__track{display:flex;width:max-content;will-change:transform;user-select:none;position:relative;z-index:0}
      .logoloop__list{display:flex;align-items:center;margin:0;padding:0;list-style:none}
      .logoloop__item{flex:0 0 auto;margin-right:var(--logoloop-gap);font-size:var(--logoloop-logoHeight);line-height:1}
      .logoloop__item:last-child{margin-right:var(--logoloop-gap)}
      .logoloop__node{display:inline-flex;align-items:center;transition:transform .3s cubic-bezier(.4,0,.2,1)}
      .logoloop__node svg{width:1em;height:1em;display:block}
      .logoloop__item img{height:var(--logoloop-logoHeight);width:auto;display:block;object-fit:contain;-webkit-user-drag:none;pointer-events:none;transition:transform .3s cubic-bezier(.4,0,.2,1)}
      .logoloop--scale-hover{padding-top:calc(var(--logoloop-logoHeight)*.15);padding-bottom:calc(var(--logoloop-logoHeight)*.15)}
      .logoloop--scale-hover .logoloop__item{overflow:visible}
      .logoloop--scale-hover .logoloop__item:hover img,.logoloop--scale-hover .logoloop__item:hover .logoloop__node{transform:scale(1.2);transform-origin:center center}
      .logoloop__link{display:inline-flex;align-items:center;text-decoration:none;border-radius:4px;transition:opacity .2s ease;color:inherit}
      .logoloop__link:hover{opacity:.85}
      .logoloop__link:focus-visible{outline:2px solid currentColor;outline-offset:2px}
      .logoloop--fade::before,.logoloop--fade::after{content:'';position:absolute;top:0;bottom:0;width:clamp(24px,8%,120px);pointer-events:none;z-index:10}
      .logoloop--fade::before{left:0;background:linear-gradient(to right,var(--logoloop-fadeColor,var(--logoloop-fadeColorAuto)) 0%,rgba(0,0,0,0) 100%)}
      .logoloop--fade::after{right:0;background:linear-gradient(to left,var(--logoloop-fadeColor,var(--logoloop-fadeColorAuto)) 0%,rgba(0,0,0,0) 100%)}
      .logoloop-band{position:relative;z-index:1;background:#0b1220;border-top:1px solid rgba(0,176,255,.18);border-bottom:1px solid rgba(0,176,255,.18);box-shadow:inset 0 0 60px rgba(0,176,255,.05);--logoloop-fadeColor:#0b1220}
      body.light .logoloop-band{background:#ffffff;border-color:#e5e7eb;box-shadow:none;--logoloop-fadeColor:#ffffff}
      @media(prefers-reduced-motion:reduce){.logoloop__track{transform:translate3d(0,0,0)!important}.logoloop__item img,.logoloop__node{transition:none!important}}
        /* Transparent scrollbar tracks and subtle thumb using accent */
        /* WebKit browsers */
        .overflow-auto::-webkit-scrollbar { width: 10px; height: 10px; }
        .overflow-auto::-webkit-scrollbar-track { background: transparent; }
        .overflow-auto::-webkit-scrollbar-thumb { background: rgba(0,176,255,0.18); border-radius: 9999px; border: 2px solid transparent; background-clip: padding-box; }
        /* Firefox */
        .overflow-auto { scrollbar-width: thin; scrollbar-color: rgba(0,176,255,0.18) transparent; }

      /* ── Hero typewriter ── */
      .typed-cursor{display:inline-block;width:2px;height:1.05em;background:var(--accent);margin-left:3px;vertical-align:text-bottom;animation:blinkCursor .8s step-end infinite}
      @keyframes blinkCursor{0%,100%{opacity:1}50%{opacity:0}}

      /* ── Hero buttons ── */
      .hero-btn{position:relative;display:inline-flex;align-items:center;gap:.6rem;padding:.8rem 1.9rem;font-weight:700;border-radius:9999px;overflow:hidden;transition:transform .3s cubic-bezier(.2,.6,.2,1),box-shadow .3s ease,color .3s ease,background-color .3s ease}
      .hero-btn i{transition:transform .3s ease}
      .hero-btn:hover{transform:translateY(-3px)}
      .hero-btn:hover i{transform:scale(1.15) rotate(-8deg)}
      .hero-btn:active{transform:translateY(-1px) scale(.97)}
      .hero-btn--primary{background:linear-gradient(135deg,#00b0ff,#0090d0);color:#fff;box-shadow:0 4px 18px -4px rgba(0,176,255,.55)}
      .hero-btn--primary:hover{box-shadow:0 12px 30px -6px rgba(0,176,255,.75)}
      .hero-btn--primary::after{content:'';position:absolute;top:0;left:-75%;width:50%;height:100%;background:linear-gradient(120deg,transparent,rgba(255,255,255,.4),transparent);transform:skewX(-20deg);pointer-events:none}
      .hero-btn--primary:hover::after{animation:cardShine .8s ease}
      .hero-btn--ghost{background:rgba(255,255,255,.05);border:2px solid var(--accent);color:var(--accent);backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px)}
      .hero-btn--ghost:hover{background:var(--accent);color:#000;box-shadow:0 12px 30px -6px rgba(0,176,255,.6)}

      /* ── Enhanced About section ── */
      .about-figure{position:relative}
      .about-figure::before{content:'';position:absolute;inset:-16px;border-radius:1.75rem;background:linear-gradient(135deg,rgba(0,176,255,.5),transparent 45%,transparent 60%,rgba(0,176,255,.25));filter:blur(20px);opacity:.75;z-index:0;transition:opacity .4s ease}
      .about-figure:hover::before{opacity:1}
      .about-frame{position:relative;z-index:1;border-radius:1.25rem;overflow:hidden;border:1px solid rgba(0,176,255,.35);background:rgba(17,24,39,.6);box-shadow:0 25px 50px -20px rgba(0,0,0,.7)}
      .about-frame img{display:block;width:100%;transition:transform .5s cubic-bezier(.2,.6,.2,1)}
      .about-figure:hover .about-frame img{transform:scale(1.05)}
      /* accent corner brackets */
      .about-frame::before,.about-frame::after{content:'';position:absolute;width:2.75rem;height:2.75rem;border:3px solid var(--accent);z-index:2;pointer-events:none;transition:width .3s ease,height .3s ease}
      .about-frame::before{top:0;left:0;border-right:none;border-bottom:none;border-top-left-radius:1.25rem}
      .about-frame::after{bottom:0;right:0;border-left:none;border-top:none;border-bottom-right-radius:1.25rem}
      .about-figure:hover .about-frame::before,.about-figure:hover .about-frame::after{width:3.5rem;height:3.5rem}
      .about-badge{position:absolute;z-index:3;bottom:-1.1rem;left:50%;transform:translateX(-50%);display:inline-flex;align-items:center;gap:.5rem;padding:.55rem 1.15rem;border-radius:9999px;background:linear-gradient(135deg,#00b0ff,#0090d0);color:#fff;font-size:.8rem;font-weight:700;box-shadow:0 10px 25px -8px rgba(0,176,255,.65);white-space:nowrap}
      .about-eyebrow{display:inline-flex;align-items:center;gap:.65rem;color:var(--accent);font-size:.78rem;font-weight:700;letter-spacing:.28em;text-transform:uppercase;margin-bottom:.85rem}
      .about-eyebrow::before{content:'';width:2.5rem;height:2px;background:var(--accent);display:inline-block}
      .tech-chip{display:inline-flex;align-items:center;gap:.45rem;padding:.45rem .95rem;border-radius:9999px;background:rgba(0,176,255,.08);border:1px solid rgba(0,176,255,.28);color:#67d3ff;font-size:.8rem;font-weight:600;transition:transform .25s ease,background-color .25s ease,box-shadow .25s ease}
      .tech-chip:hover{transform:translateY(-2px);background:rgba(0,176,255,.16);box-shadow:0 6px 16px -6px rgba(0,176,255,.5)}
      body.light .about-frame{background:#fff;box-shadow:0 25px 50px -25px rgba(0,0,0,.25)}
      body.light .tech-chip{background:rgba(0,144,208,.07);color:#0284c7;border-color:rgba(2,132,199,.3)}

      /* ── Hamburger menu (beside theme toggle) ── */
      .menu-toggle{position:fixed;top:1.45rem;right:1.5rem;z-index:70;width:26px;height:20px;background:none;border:none;cursor:pointer;display:flex;flex-direction:column;justify-content:space-between;padding:0}
      .menu-toggle span{display:block;height:3px;width:100%;border-radius:2px;background:#fff;transition:transform .3s ease,opacity .3s ease,width .3s ease}
      .menu-toggle:hover span:nth-child(2){width:70%}
      .menu-toggle.open span:nth-child(1){transform:translateY(8.5px) rotate(45deg)}
      .menu-toggle.open span:nth-child(2){opacity:0}
      .menu-toggle.open span:nth-child(3){transform:translateY(-8.5px) rotate(-45deg)}
      .nav-menu{position:fixed;top:4rem;right:1.5rem;z-index:69;min-width:12.5rem;background:rgba(17,24,39,.92);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);border:1px solid rgba(0,176,255,.25);border-radius:.9rem;box-shadow:0 20px 45px -18px rgba(0,0,0,.75);padding:.5rem;opacity:0;transform:translateY(-8px) scale(.97);pointer-events:none;transition:opacity .25s ease,transform .25s ease}
      .nav-menu.open{opacity:1;transform:translateY(0) scale(1);pointer-events:auto}
      .nav-menu a{display:flex;align-items:center;gap:.7rem;padding:.7rem .95rem;border-radius:.6rem;color:#e5e7eb;font-weight:600;font-size:.9rem;text-decoration:none;transition:background-color .2s ease,color .2s ease,transform .2s ease}
      .nav-menu a:hover{background:rgba(0,176,255,.14);color:#00b0ff;transform:translateX(3px)}
      .nav-menu a i{width:1.15rem;text-align:center;color:#00b0ff}
      body.light .nav-menu{background:rgba(255,255,255,.95);border-color:rgba(0,0,0,.08);box-shadow:0 20px 45px -22px rgba(0,0,0,.3)}
      body.light .nav-menu a{color:#374151}

      /* ── Theme toggle button (top center) ── */
      .theme-toggle{
        position:fixed; top:1.25rem; right:4.25rem;
        z-index:60; background:none; border:none;
        cursor:pointer; color:#ffffff;
        transition:transform .25s ease;
      }
      .theme-toggle:hover{transform:scale(1.15) rotate(12deg)}
      .theme-toggle svg{display:block}

      /* ── Light theme overrides ── */
      body.light{background:#f3f4f6;color:#1f2937}
      body.light .theme-toggle{color:#ffffff}
      body.light .bg-gray-900{background-color:#f3f4f6!important}
      body.light .bg-gray-800{background-color:#ffffff!important}
      body.light .bg-\[\#0f0f10\]{background-color:#ffffff!important}
      body.light .bg-gray-700{background-color:#e5e7eb!important}
      body.light #particle-sections{background:#e5e7eb!important}
      body.light .text-white{color:#111827!important}
      body.light .text-gray-200,
      body.light .text-gray-300,
      body.light .text-gray-400{color:#374151!important}
      body.light .text-gray-500{color:#6b7280!important}
      /* Hero sits on a dark photo in both themes — keep its text light */
      body.light #hero .text-white{color:#ffffff!important}
      body.light #hero .text-gray-300{color:#e5e7eb!important}
      body.light .border-gray-700{border-color:#d1d5db!important}
      body.light hr.border-gray-700{border-color:#d1d5db!important}
      body.light .progress-badge .inner{background:#ffffff;color:#111827}
      body.light .skill-card{background:rgba(255,255,255,.7);border-color:rgba(0,0,0,.06)}
      body.light .skill-name{color:#6b7280}
    </style>
  </head>
  <body class="bg-gray-900 text-gray-200 min-h-screen">
    <script>if(localStorage.getItem('theme')==='light'){document.body.classList.add('light');}</script>
    <!-- Light / Dark theme toggle (top center) -->
    <button id="themeToggle" class="theme-toggle" aria-label="Toggle light and dark theme" title="Toggle theme">
      <span id="themeIcon"></span>
    </button>

    <!-- Hamburger menu (beside theme toggle) -->
    <button id="menuToggle" class="menu-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="navMenu">
      <span></span><span></span><span></span>
    </button>
    <nav id="navMenu" class="nav-menu" aria-label="Site menu">
      <a href="{{ route('about') }}"><i class="fa-solid fa-user"></i>About</a>
      <a href="{{ route('cv') }}"><i class="fa-solid fa-file-lines"></i>CV / Resume</a>
    </nav>

    <!-- Fixed left profile on md+ screens, stacked on small screens -->
    <aside class="bg-[#0f0f10] shadow-lg md:fixed md:inset-y-0 md:w-[20rem] w-full flex md:flex-col flex-col">
      <!-- Header (fixed within sidebar) -->
      <div class="p-6 flex-shrink-0 flex flex-col items-center text-center bg-gray-800">
        <div class="relative">
          <img src="{{ asset('storage/assets/cjsheesh.png') }}" alt="Profile" class="w-24 h-24 rounded-full object-contain border-4 border-gray-900" />
          <span class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-green-400 ring-2 ring-gray-900"></span>
        </div>
        <div class="mt-3">
          <h3 class="text-white font-semibold">Christ Joy Macuto</h3>
          <p class="text-sm text-gray-300">React.js | Javascript | RESTful API | PHP | Node/Express</p>
        </div>
      </div>

      <!-- Scrollable content area (transparent) -->
      <div class="px-6 pb-6 overflow-auto flex-1 bg-gray-800">
        <dl class="text-sm text-gray-400 space-y-4">
          <div class="flex justify-between">
            <dt class="font-medium">Address:</dt>
            <dd>Hilongos, Leyte</dd>
          </div>
          <div class="flex justify-between">
            <dt class="font-medium">Email:</dt>
            <dd>christjoy@gmail.com</dd>
          </div>
        </dl>

        <hr class="my-4 border-gray-700" />

        <!-- Circular skill indicators -->
        <div class="flex justify-between items-center gap-3">
          <div class="flex-1 text-center">
            <div class="mx-auto progress-badge" style="background:conic-gradient(from -90deg, var(--accent) 0 342deg, rgba(255,255,255,0.06) 342deg 360deg)">
              <div class="inner">95%</div>
            </div>
            <p class="mt-2 text-xs text-gray-300">Cebuano</p>
          </div>
          <div class="flex-1 text-center">
            <div class="mx-auto progress-badge" style="background:conic-gradient(from -90deg, var(--accent) 0 216deg, rgba(255,255,255,0.06) 216deg 360deg)">
              <div class="inner">60%</div>
            </div>
            <p class="mt-2 text-xs text-gray-300">English</p>
          </div>
          <div class="flex-1 text-center">
            <div class="mx-auto progress-badge" style="background:conic-gradient(from -90deg, var(--accent) 0 306deg, rgba(255,255,255,0.06) 306deg 360deg)">
              <div class="inner">85%</div>
            </div>
            <p class="mt-2 text-xs text-gray-300">Tagalog</p>
          </div>
        </div>

        <hr class="my-4 border-gray-700" />

        <!-- Core skill bars -->
        <div class="space-y-4">
          <div>
              <div class="flex justify-between mb-1">
                <span class="text-xs text-gray-300">HTML</span>
                <span class="text-xs">93%</span>
              </div>
              <div class="w-full h-2 bg-gray-700 rounded-full overflow-hidden">
                <div class="h-full bg-accent" style="width:93%"></div>
              </div>
          </div>

          <div>
            <div class="flex justify-between mb-1">
              <span class="text-xs text-gray-300">CSS</span>
              <span class="text-xs">89%</span>
            </div>
            <div class="w-full h-2 bg-gray-700 rounded-full overflow-hidden">
              <div class="h-full bg-accent" style="width:89%"></div>
            </div>

            
          
          </div>
        </div>

        

        <hr class="my-4 border-gray-700" />

        <!-- Extended skills list (scrollable) -->
        <div class="space-y-3">
          <!-- first column of skills with percentages as requested -->
          @php
            $skills = [
              ['GitHub',84],['ReactJS',80],['Bootstrap',80],['Git',78],['WordPress Development',75],
              ['MYSQL',72],['JavaScript',70],['ExpressJS',70],['Communication Skills',70],['Project Management',68],
              ['Jira',67],['Laravel',65],['PHP',60],['NodeJS',50],['SEO',50],['Deployment',50]
            ];
          @endphp

          @foreach($skills as $s)
            <div>
              <div class="flex justify-between mb-1 text-xs text-gray-300">
                <span>{{ $s[0] }}</span>
                <span>{{ $s[1] }}%</span>
              </div>
              <div class="w-full h-2 bg-gray-700 rounded-full overflow-hidden">
                <div class="h-full bg-accent" style="width:{{ $s[1] }}%"></div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <!-- Footer (fixed bottom within sidebar) -->
      <div class="p-4 flex-shrink-0 bg-gray-800 border-t border-gray-700">
        <div class="flex justify-center gap-4 text-gray-400">
          <a href="https://github.com/" target="_blank" rel="noopener" aria-label="github" class="hover:text-white">GitHub</a>
          <a href="https://www.linkedin.com/in/christjoy" target="_blank" rel="noopener" aria-label="linkedin" class="hover:text-white">LinkedIn</a>
        </div>
      </div>
    </aside>

    <!-- Main content area (pushes right of fixed sidebar) -->
    <main class="md:ml-[20rem]">
      <!-- Hero Section -->
      <div id="hero" class="relative w-full h-[33rem] bg-cover bg-center flex items-center justify-between px-6 md:px-12 py-16 overflow-hidden" style="z-index:1; background:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1200&q=80'); background-size:cover; background-position:center; background-attachment:fixed;">
        <div class="max-w-2xl text-white z-10 mt-16">
          <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">Junior Web Developer,<br>Learning &amp; Building Every Day</h1>
          <p class="mb-6 text-sm text-gray-300 min-h-[2.5rem] sm:min-h-[1.25rem]"><span class="text-lime-400">&lt;code&gt;</span> <span id="typedText"></span><span class="typed-cursor" aria-hidden="true"></span> <span class="text-lime-400">&lt;/code&gt;</span></p>
          <div class="flex flex-wrap gap-4">
            <a href="mailto:christjoy@gmail.com" class="hero-btn hero-btn--primary"><i class="fa-solid fa-envelope"></i><span>Email Me</span></a>
            <a href="https://www.linkedin.com/in/christjoy" target="_blank" rel="noopener" class="hero-btn hero-btn--ghost"><i class="fa-brands fa-linkedin"></i><span>LinkedIn Me</span></a>
          </div>
        </div>
        <div class="absolute right-0 pointer-events-none z-0" style="width:420px; bottom:-14%;">
          <img id="heroImg" src="{{ asset('storage/assets/3.png') }}" alt="Profile" class="w-full h-auto block" />
        </div>
      </div>

      <!-- ═══════════════════════════════════════════════ -->
      <!-- Tech Logo Loop — separator band between hero & about -->
      <!-- ═══════════════════════════════════════════════ -->
      <div class="logoloop-band px-6 md:px-12 py-8">
        <div id="techLogoLoop" class="logoloop logoloop--horizontal logoloop--fade logoloop--scale-hover"
             role="region" aria-label="Skills and tools"
             style="--logoloop-gap:56px; --logoloop-logoHeight:44px;">
          <div class="logoloop__track">
            <ul class="logoloop__list" role="list" data-logoloop-seq>
              <li class="logoloop__item" role="listitem">
                <a class="logoloop__link" href="https://developer.mozilla.org/docs/Web/HTML" target="_blank" rel="noreferrer noopener" title="HTML" aria-label="HTML">
                  <span class="logoloop__node"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" alt="HTML"></span>
                </a>
              </li>
              <li class="logoloop__item" role="listitem">
                <a class="logoloop__link" href="https://developer.mozilla.org/docs/Web/CSS" target="_blank" rel="noreferrer noopener" title="CSS" aria-label="CSS">
                  <span class="logoloop__node"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" alt="CSS"></span>
                </a>
              </li>
              <li class="logoloop__item" role="listitem">
                <a class="logoloop__link" href="https://developer.mozilla.org/docs/Web/JavaScript" target="_blank" rel="noreferrer noopener" title="JavaScript" aria-label="JavaScript">
                  <span class="logoloop__node"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="JavaScript"></span>
                </a>
              </li>
              <li class="logoloop__item" role="listitem">
                <a class="logoloop__link" href="https://code.visualstudio.com" target="_blank" rel="noreferrer noopener" title="VS Code" aria-label="VS Code">
                  <span class="logoloop__node"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vscode/vscode-original.svg" alt="VS Code"></span>
                </a>
              </li>
              <li class="logoloop__item" role="listitem">
                <a class="logoloop__link" href="https://laravel.com" target="_blank" rel="noreferrer noopener" title="Laravel" aria-label="Laravel">
                  <span class="logoloop__node"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg" alt="Laravel"></span>
                </a>
              </li>
              <li class="logoloop__item" role="listitem">
                <a class="logoloop__link" href="https://filamentphp.com" target="_blank" rel="noreferrer noopener" title="Filament" aria-label="Filament">
                  <span class="logoloop__node"><svg viewBox="0 0 24 24" fill="currentColor" style="color:#fbbf24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15.5v-5H7.5L13 5.5v5h3.5L11 17.5z"/></svg></span>
                </a>
              </li>
              <li class="logoloop__item" role="listitem">
                <a class="logoloop__link" href="https://git-scm.com" target="_blank" rel="noreferrer noopener" title="Git" aria-label="Git">
                  <span class="logoloop__node"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg" alt="Git"></span>
                </a>
              </li>
              <li class="logoloop__item" role="listitem">
                <a class="logoloop__link" href="https://github.com" target="_blank" rel="noreferrer noopener" title="GitHub" aria-label="GitHub">
                  <span class="logoloop__node"><i class="fa-brands fa-github"></i></span>
                </a>
              </li>
              <li class="logoloop__item" role="listitem">
                <a class="logoloop__link" href="https://cpanel.net" target="_blank" rel="noreferrer noopener" title="cPanel" aria-label="cPanel">
                  <span class="logoloop__node"><i class="fa-solid fa-server" style="color:#ff6b35"></i></span>
                </a>
              </li>
              <li class="logoloop__item" role="listitem">
                <a class="logoloop__link" href="https://www.mysql.com" target="_blank" rel="noreferrer noopener" title="MySQL" aria-label="MySQL">
                  <span class="logoloop__node"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" alt="MySQL"></span>
                </a>
              </li>
              <li class="logoloop__item" role="listitem">
                <a class="logoloop__link" href="https://www.php.net" target="_blank" rel="noreferrer noopener" title="PHP" aria-label="PHP">
                  <span class="logoloop__node"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="PHP"></span>
                </a>
              </li>
              <li class="logoloop__item" role="listitem">
                <a class="logoloop__link" href="https://wordpress.org" target="_blank" rel="noreferrer noopener" title="WordPress" aria-label="WordPress">
                  <span class="logoloop__node"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/wordpress/wordpress-plain.svg" alt="WordPress"></span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Particle Background (About → Contact) -->
      <div id="particle-sections">
        <canvas id="shapegrid"></canvas>
        <div class="content-layer relative z-10">

      <!-- About Section -->
      <section id="about" class="px-6 md:px-12 py-20 flex flex-col md:flex-row gap-14 items-center">
        <div class="md:w-1/3 flex-shrink-0 reveal-left w-full">
          <div class="about-figure mx-auto max-w-xs md:max-w-none">
            <div class="about-frame">
              <img src="{{ asset('storage/assets/cjsheesh.png') }}" alt="Christ Joy Macuto" />
            </div>
            <span class="about-badge"><i class="fa-solid fa-location-dot"></i>Based in the Philippines</span>
          </div>
        </div>
        <div class="md:w-2/3 flex flex-col justify-center reveal-right">
          <span class="about-eyebrow">About Me</span>
          <h2 class="text-4xl font-bold text-lime-400 mb-5">Hi! I'm CJ</h2>
          <p class="text-white text-lg font-semibold leading-relaxed mb-4">
            A passionate Full-Stack Web Developer dedicated to building creative and innovative digital solutions.
          </p>
          <p class="text-gray-300 text-base leading-relaxed mb-4">
            I enjoy working with PHP, JavaScript, and MySQL to build responsive, user-friendly, and scalable web applications — from designing clean database schemas to crafting polished, interactive front-ends. I care about writing maintainable code and turning ideas into products people genuinely enjoy using.
          </p>
          <p class="text-gray-300 text-base leading-relaxed mb-6">
            Based in the Philippines, I've built projects from scratch across a range of domains — personal projects, government-related systems, and school management systems — which taught me how to take a product from concept to deployment.
          </p>
          <div class="flex flex-wrap gap-2.5 mb-8">
            <span class="tech-chip"><i class="fa-brands fa-php"></i>PHP</span>
            <span class="tech-chip"><i class="fa-brands fa-js"></i>JavaScript</span>
            <span class="tech-chip"><i class="fa-solid fa-database"></i>MySQL</span>
            <span class="tech-chip"><i class="fa-brands fa-laravel"></i>Laravel</span>
            <span class="tech-chip"><i class="fa-brands fa-react"></i>React</span>
          </div>
          <a href="{{ route('about') }}" class="hero-btn hero-btn--primary w-fit"><span>More About Me</span><i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </section>


      <!-- ═══════════════════════════════════════════════ -->
      <!-- Skills & Tools Section                         -->
      <!-- ═══════════════════════════════════════════════ -->
      <section class="bg-gray-900 px-6 md:px-12 py-16 ">
        <h2 class="text-4xl font-bold text-lime-400 mb-12 text-center reveal">Skills & Tools</h2>
        <div class="skills-grid grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 max-w-4xl mx-auto">
          @php
            $skills = [
              ['name' => 'HTML',       'href' => 'https://developer.mozilla.org/docs/Web/HTML',       'accent' => '#e34f26', 'icon' => '<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" alt="HTML" class="skill-icon" />'],
              ['name' => 'CSS',        'href' => 'https://developer.mozilla.org/docs/Web/CSS',        'accent' => '#1572b6', 'icon' => '<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" alt="CSS" class="skill-icon" />'],
              ['name' => 'JavaScript', 'href' => 'https://developer.mozilla.org/docs/Web/JavaScript', 'accent' => '#f7df1e', 'icon' => '<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="JavaScript" class="skill-icon" />'],
              ['name' => 'VS Code',    'href' => 'https://code.visualstudio.com',                     'accent' => '#007acc', 'icon' => '<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vscode/vscode-original.svg" alt="VS Code" class="skill-icon" />'],
              ['name' => 'Laravel',    'href' => 'https://laravel.com',                               'accent' => '#ff2d20', 'icon' => '<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg" alt="Laravel" class="skill-icon" />'],
              ['name' => 'Filament',   'href' => 'https://filamentphp.com',                           'accent' => '#fbbf24', 'icon' => '<svg class="skill-icon" style="color:#fbbf24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15.5v-5H7.5L13 5.5v5h3.5L11 17.5z"/></svg>'],
              ['name' => 'Git',        'href' => 'https://git-scm.com',                               'accent' => '#f05032', 'icon' => '<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg" alt="Git" class="skill-icon" />'],
              ['name' => 'GitHub',     'href' => 'https://github.com',                                'accent' => '#c9d1d9', 'icon' => '<i class="fa-brands fa-github skill-icon-fa"></i>'],
              ['name' => 'cPanel',     'href' => 'https://cpanel.net',                                'accent' => '#ff6b35', 'icon' => '<i class="fa-solid fa-server skill-icon-fa" style="color:#ff6b35"></i>'],
              ['name' => 'MySQL',      'href' => 'https://www.mysql.com',                             'accent' => '#4479a1', 'icon' => '<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" alt="MySQL" class="skill-icon" />'],
              ['name' => 'PHP',        'href' => 'https://www.php.net',                               'accent' => '#777bb4', 'icon' => '<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="PHP" class="skill-icon" />'],
              ['name' => 'WordPress',  'href' => 'https://wordpress.org',                             'accent' => '#21759b', 'icon' => '<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/wordpress/wordpress-plain.svg" alt="WordPress" class="skill-icon" />'],
            ];
          @endphp

          @foreach($skills as $s)
            <div class="skill-reveal reveal" style="--i:{{ $loop->index }}">
              <a href="{{ $s['href'] }}" target="_blank" rel="noreferrer noopener" title="{{ $s['name'] }}"
                 class="skill-card group flex flex-col items-center justify-center p-6 rounded-2xl" style="--accent:{{ $s['accent'] }}">
                <span class="skill-icon-wrap">{!! $s['icon'] !!}</span>
                <span class="skill-name mt-3 text-sm font-semibold">{{ $s['name'] }}</span>
              </a>
            </div>
          @endforeach
        </div>
      </section>

      <!-- ═══════════════════════════════════════════════ -->
      <!-- Projects Section                               -->
      <!-- ═══════════════════════════════════════════════ -->
      <section class="bg-gray-900 px-6 md:px-12 py-16 ">
        <h2 class="text-4xl font-bold text-lime-400 mb-14 text-center reveal">My Projects</h2>
        <div class="projects-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
          @php
            $projects = [
              [
                'title' => 'Portfolio Website',
                'img'   => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&q=80',
                'desc'  => 'A personal portfolio built with modern web technologies showcasing projects and skills.',
                'tags'  => ['HTML', 'TailwindCSS', 'JS'],
              ],
              [
                'title' => 'Admin Dashboard',
                'img'   => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600&q=80',
                'desc'  => 'A full-featured admin panel built with Laravel and Filament for content management.',
                'tags'  => ['Laravel', 'Filament', 'MySQL'],
              ],
              [
                'title' => 'E-Commerce Platform',
                'img'   => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=600&q=80',
                'desc'  => 'A responsive online store with cart functionality, payment integration, and order tracking.',
                'tags'  => ['PHP', 'WordPress', 'MySQL'],
              ],
            ];
          @endphp

          @foreach($projects as $p)
            <div class="reveal project-reveal" style="--i:{{ $loop->index }}">
              <div class="project-card rounded-2xl overflow-hidden h-full">
                <div class="project-media overflow-hidden">
                  <img src="{{ $p['img'] }}" alt="{{ $p['title'] }}" class="w-full h-48 object-cover" />
                </div>
                <div class="project-body p-6">
                  <h3 class="text-lg font-bold text-white mb-2">{{ $p['title'] }}</h3>
                  <p class="text-gray-400 text-sm mb-4">{{ $p['desc'] }}</p>
                  <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($p['tags'] as $t)
                      <span class="project-tag px-2 py-0.5 bg-gray-700 text-lime-400 text-xs font-semibold rounded">{{ $t }}</span>
                    @endforeach
                  </div>
                  <div class="project-buttons flex gap-3">
                    <a href="#" class="btn-glow px-4 py-2 bg-lime-400 text-black text-sm font-bold rounded hover:bg-lime-500 transition">Live Demo</a>
                    <a href="#" class="px-4 py-2 border border-lime-400 text-lime-400 text-sm font-bold rounded hover:bg-lime-400 hover:text-black transition">GitHub</a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach

        </div>
      </section>

      <!-- ═══════════════════════════════════════════════ -->
      <!-- Timeline / My Journey Section                  -->
      <!-- ═══════════════════════════════════════════════ -->
      <section class="bg-gray-900 px-6 md:px-12 py-16 ">
        <h2 class="text-4xl font-bold text-lime-400 mb-16 text-center reveal">My Journey</h2>
        <div class="relative max-w-4xl mx-auto" id="timeline">
          <!-- Center line -->
          <div class="absolute left-4 md:left-1/2 md:-translate-x-px top-0 w-0.5 bg-gray-700 h-full">
            <div class="timeline-line w-full bg-lime-400"></div>
          </div>

          <!-- Item 1 — left -->
          <div class="relative flex flex-col md:flex-row items-start mb-12">
            <div class="reveal-left md:w-[45%] md:text-right ml-12 md:ml-0 md:pr-10">
              <span class="inline-block px-3 py-1 bg-lime-400 text-black text-xs font-bold rounded mb-2">2021</span>
              <h3 class="text-lg font-bold text-white">Started Learning Web Development</h3>
              <p class="text-gray-400 text-sm mt-1">Began self-learning HTML, CSS, and JavaScript through online resources and tutorials.</p>
            </div>
            <div class="absolute left-4 md:left-1/2 -translate-x-1/2 w-3 h-3 bg-lime-400 rounded-full ring-4 ring-gray-900 top-2"></div>
          </div>

          <!-- Item 2 — right -->
          <div class="relative flex flex-col md:flex-row items-start mb-12">
            <div class="hidden md:block md:w-[45%]"></div>
            <div class="reveal-right md:w-[45%] md:ml-auto ml-12 md:ml-auto md:pl-10">
              <span class="inline-block px-3 py-1 bg-lime-400 text-black text-xs font-bold rounded mb-2">2022</span>
              <h3 class="text-lg font-bold text-white">First Freelance Project</h3>
              <p class="text-gray-400 text-sm mt-1">Completed my first client project — a WordPress website for a local business.</p>
            </div>
            <div class="absolute left-4 md:left-1/2 -translate-x-1/2 w-3 h-3 bg-lime-400 rounded-full ring-4 ring-gray-900 top-2"></div>
          </div>

          <!-- Item 3 — left -->
          <div class="relative flex flex-col md:flex-row items-start mb-12">
            <div class="reveal-left md:w-[45%] md:text-right ml-12 md:ml-0 md:pr-10">
              <span class="inline-block px-3 py-1 bg-lime-400 text-black text-xs font-bold rounded mb-2">2023</span>
              <h3 class="text-lg font-bold text-white">Learned Laravel & PHP</h3>
              <p class="text-gray-400 text-sm mt-1">Dove into backend development with PHP and the Laravel framework, building full-stack applications.</p>
            </div>
            <div class="absolute left-4 md:left-1/2 -translate-x-1/2 w-3 h-3 bg-lime-400 rounded-full ring-4 ring-gray-900 top-2"></div>
          </div>

          <!-- Item 4 — right -->
          <div class="relative flex flex-col md:flex-row items-start mb-12">
            <div class="hidden md:block md:w-[45%]"></div>
            <div class="reveal-right md:w-[45%] md:ml-auto ml-12 md:ml-auto md:pl-10">
              <span class="inline-block px-3 py-1 bg-lime-400 text-black text-xs font-bold rounded mb-2">2024</span>
              <h3 class="text-lg font-bold text-white">Expanded to Full-Stack</h3>
              <p class="text-gray-400 text-sm mt-1">Started building complete web applications using Laravel, Filament, and modern frontend tools.</p>
            </div>
            <div class="absolute left-4 md:left-1/2 -translate-x-1/2 w-3 h-3 bg-lime-400 rounded-full ring-4 ring-gray-900 top-2"></div>
          </div>

          <!-- Item 5 — left -->
          <div class="relative flex flex-col md:flex-row items-start">
            <div class="reveal-left md:w-[45%] md:text-right ml-12 md:ml-0 md:pr-10">
              <span class="inline-block px-3 py-1 bg-lime-400 text-black text-xs font-bold rounded mb-2">2025</span>
              <h3 class="text-lg font-bold text-white">Building & Growing</h3>
              <p class="text-gray-400 text-sm mt-1">Continuing to ship projects, contribute to open source, and level up as a developer every day.</p>
            </div>
            <div class="absolute left-4 md:left-1/2 -translate-x-1/2 w-3 h-3 bg-lime-400 rounded-full ring-4 ring-gray-900 top-2"></div>
          </div>

        </div>
      </section>

      <!-- ═══════════════════════════════════════════════ -->
      <!-- Contact Section                                -->
      <!-- ═══════════════════════════════════════════════ -->
      <section class="bg-gray-900 px-6 md:px-12 py-16 ">
        <h2 class="text-4xl font-bold text-lime-400 mb-4 text-center reveal">Get In Touch</h2>
        <p class="text-gray-400 text-center mb-12 reveal">Have a project in mind or want to collaborate? Let's talk.</p>

        <div class="max-w-2xl mx-auto reveal">
          <div class="contact-card p-8 md:p-10">
            <form onsubmit="return false" class="space-y-5">
              <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Name</label>
                <div class="input-wrap">
                  <i class="fa-solid fa-user field-icon"></i>
                  <input type="text" id="name" name="name" placeholder="Your name" class="input-field" />
                </div>
              </div>
              <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                <div class="input-wrap">
                  <i class="fa-solid fa-envelope field-icon"></i>
                  <input type="email" id="email" name="email" placeholder="you@example.com" class="input-field" />
                </div>
              </div>
              <div>
                <label for="message" class="block text-sm font-medium text-gray-300 mb-2">Message</label>
                <div class="input-wrap input-wrap--top">
                  <i class="fa-solid fa-comment-dots field-icon"></i>
                  <textarea id="message" name="message" rows="5" placeholder="Your message…" class="input-field resize-none"></textarea>
                </div>
              </div>
              <button type="submit" class="contact-btn w-full px-8 py-3.5 text-white font-bold text-lg rounded-xl flex items-center justify-center gap-2">
                <span>Send Message</span>
                <i class="fa-solid fa-paper-plane"></i>
              </button>
            </form>

            <!-- Divider -->
            <div class="flex items-center gap-4 my-8">
              <span class="h-px flex-1 bg-gray-700"></span>
              <span class="text-xs text-gray-500 uppercase tracking-wider">or reach me directly</span>
              <span class="h-px flex-1 bg-gray-700"></span>
            </div>

            <!-- Social Icons -->
            <div class="flex justify-center gap-5">
              <a href="https://github.com/" target="_blank" rel="noopener" aria-label="GitHub" title="GitHub" class="social-btn">
                <i class="fa-brands fa-github text-xl"></i>
              </a>
              <a href="mailto:christjoy@gmail.com" aria-label="Email" title="Email" class="social-btn">
                <i class="fa-solid fa-envelope text-xl"></i>
              </a>
              <a href="https://www.linkedin.com/" target="_blank" rel="noopener" aria-label="LinkedIn" title="LinkedIn" class="social-btn">
                <i class="fa-brands fa-linkedin text-xl"></i>
              </a>
            </div>
          </div>
        </div>
      </section>

        </div><!-- /.content-layer -->
      </div><!-- /#particle-sections -->

      <!-- Footer -->
      <footer class="bg-gray-800 border-t border-gray-700 px-6 md:px-12 py-6 text-center">
        <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Christ Joy Macuto. All rights reserved.</p>
      </footer>

    </main>

    <!-- Scroll Reveal, Timeline & ShapeGrid background -->
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        // Hero typewriter — types each phrase, holds, deletes, then moves to the next (loops forever)
        const typedEl = document.getElementById('typedText');
        if (typedEl) {
          const phrases = [
            'I interpret mockup design into a responsive web app.',
            'I build clean, user-friendly interfaces with modern tools.',
            'I grow my skills with every project I ship.'
          ];
          let phraseIdx = 0, charIdx = 0, deleting = false;
          const tick = () => {
            const phrase = phrases[phraseIdx];
            charIdx += deleting ? -1 : 1;
            typedEl.textContent = phrase.slice(0, charIdx);
            let delay = deleting ? 35 : 70;
            if (!deleting && charIdx === phrase.length) {
              delay = 2200; // hold the full sentence before deleting
              deleting = true;
            } else if (deleting && charIdx === 0) {
              deleting = false;
              phraseIdx = (phraseIdx + 1) % phrases.length;
              delay = 500;
            }
            setTimeout(tick, delay);
          };
          tick();
        }

        // Hamburger nav menu
        const menuToggle = document.getElementById('menuToggle');
        const navMenu = document.getElementById('navMenu');
        if (menuToggle && navMenu) {
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
        }

        // Scroll reveal observer
        const revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
        const revealObs = new IntersectionObserver((entries) => {
          entries.forEach((e) => {
            if (e.isIntersecting) {
              e.target.classList.add('visible');
              revealObs.unobserve(e.target);
            }
          });
        }, { threshold: 0.15 });
        revealEls.forEach((el) => revealObs.observe(el));

        // Project & skill card cursor spotlight
        document.querySelectorAll('.project-card, .skill-card').forEach((card) => {
          card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            card.style.setProperty('--mx', `${e.clientX - rect.left}px`);
            card.style.setProperty('--my', `${e.clientY - rect.top}px`);
          });
        });

        // Timeline line grow
        const timelineEl = document.getElementById('timeline');
        if (timelineEl) {
          const line = timelineEl.querySelector('.timeline-line');
          const timelineObs = new IntersectionObserver((entries) => {
            entries.forEach((e) => {
              if (e.isIntersecting) {
                line.classList.add('grow');
                timelineObs.unobserve(e.target);
              }
            });
          }, { threshold: 0.1 });
          timelineObs.observe(timelineEl);
        }

        // Light / Dark theme toggle
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const sunSVG = `<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><line x1="12" y1="2" x2="12" y2="4"/><line x1="12" y1="20" x2="12" y2="22"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="2" y1="12" x2="4" y2="12"/><line x1="20" y1="12" x2="22" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>`;
        const moonSVG = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>`;
        const heroImg = document.getElementById('heroImg');
        const applyTheme = (theme) => {
          const light = theme === 'light';
          document.body.classList.toggle('light', light);
          themeIcon.innerHTML = light ? sunSVG : moonSVG;
          if (heroImg) heroImg.src = light ? '{{ asset("storage/assets/1.png") }}' : '{{ asset("storage/assets/3.png") }}';
        };
        applyTheme(localStorage.getItem('theme') || 'dark');
        themeToggle.addEventListener('click', () => {
          const next = document.body.classList.contains('light') ? 'dark' : 'light';
          localStorage.setItem('theme', next);
          applyTheme(next);
        });

        // ShapeGrid background (ported from React Bits <ShapeGrid /> to vanilla JS)
        const particleSection = document.getElementById('particle-sections');
        const shapeCanvas = document.getElementById('shapegrid');
        if (particleSection && shapeCanvas) {
          initShapeGrid(shapeCanvas, {
            direction: 'diagonal',        // up, down, left, right, diagonal
            speed: 0.5,
            squareSize: 40,
            borderColor: 'rgba(0,176,255,0.12)',
            hoverFillColor: 'rgba(0,176,255,0.22)',
            shape: 'square',              // square, hexagon, circle, triangle
            hoverTrailAmount: 5           // trailing hovered shapes (0 = no trail)
          });

          // Show grid whenever particle-sections is in view; hero covers it via z-index
          const gridObs = new IntersectionObserver((entries) => {
            shapeCanvas.classList.toggle('visible', entries[0].isIntersecting);
          }, { threshold: 0.01 });
          gridObs.observe(particleSection);
        }

        // LogoLoop init (based on the Skills & Tools icons)
        initLogoLoop(document.getElementById('techLogoLoop'), {
          speed: 60,          // px per second
          direction: 'left',  // left, right
          hoverSpeed: 0       // 0 = pause on hover
        });

        function initLogoLoop(root, options) {
          if (!root) return;
          const { speed = 120, direction = 'left', hoverSpeed } = options || {};
          const track = root.querySelector('.logoloop__track');
          const seq = root.querySelector('[data-logoloop-seq]');
          if (!track || !seq) return;

          const MIN_COPIES = 2, COPY_HEADROOM = 2, SMOOTH_TAU = 0.25;
          let seqWidth = 0, offset = 0, velocity = 0, lastTs = null, raf = null, hovered = false;

          const targetVelocity = () => {
            const magnitude = Math.abs(speed);
            const dirMul = direction === 'left' ? 1 : -1;
            const speedMul = speed < 0 ? -1 : 1;
            return magnitude * dirMul * speedMul;
          };

          const buildCopies = () => {
            track.querySelectorAll('.logoloop__list').forEach((ul, i) => { if (i > 0) ul.remove(); });
            const rect = seq.getBoundingClientRect();
            seqWidth = Math.ceil(rect.width);
            const containerWidth = root.clientWidth || 0;
            if (seqWidth > 0) {
              const copies = Math.max(MIN_COPIES, Math.ceil(containerWidth / seqWidth) + COPY_HEADROOM);
              for (let i = 1; i < copies; i++) {
                const clone = seq.cloneNode(true);
                clone.removeAttribute('data-logoloop-seq');
                clone.setAttribute('aria-hidden', 'true');
                track.appendChild(clone);
              }
            }
          };

          const animate = (ts) => {
            if (lastTs === null) lastTs = ts;
            const dt = Math.max(0, ts - lastTs) / 1000;
            lastTs = ts;
            const target = (hovered && hoverSpeed !== undefined) ? hoverSpeed : targetVelocity();
            const easing = 1 - Math.exp(-dt / SMOOTH_TAU);
            velocity += (target - velocity) * easing;
            if (seqWidth > 0) {
              offset = (((offset + velocity * dt) % seqWidth) + seqWidth) % seqWidth;
              track.style.transform = `translate3d(${-offset}px, 0, 0)`;
            }
            raf = requestAnimationFrame(animate);
          };

          const start = () => {
            buildCopies();
            if (raf === null) raf = requestAnimationFrame(animate);
          };

          // Measure only after images have loaded (widths would be 0 otherwise)
          const imgs = seq.querySelectorAll('img');
          let remaining = imgs.length;
          if (remaining === 0) {
            start();
          } else {
            imgs.forEach((img) => {
              if (img.complete) {
                if (--remaining === 0) start();
              } else {
                const done = () => { if (--remaining === 0) start(); };
                img.addEventListener('load', done, { once: true });
                img.addEventListener('error', done, { once: true });
              }
            });
          }

          if (hoverSpeed !== undefined) {
            track.addEventListener('mouseenter', () => { hovered = true; });
            track.addEventListener('mouseleave', () => { hovered = false; });
          }

          let resizeTimer = null;
          window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(buildCopies, 150);
          });
        }

        function initShapeGrid(canvas, options) {
          const {
            direction = 'right',
            speed = 1,
            borderColor = '#999',
            squareSize = 40,
            hoverFillColor = '#222',
            shape = 'square',
            hoverTrailAmount = 0
          } = options || {};

          const ctx = canvas.getContext('2d');
          const isHex = shape === 'hexagon';
          const isTri = shape === 'triangle';
          const hexHoriz = squareSize * 1.5;
          const hexVert = squareSize * Math.sqrt(3);

          const gridOffset = { x: 0, y: 0 };
          let hoveredSquare = null;
          let trailCells = [];
          const cellOpacities = new Map();

          const resizeCanvas = () => {
            canvas.width = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;
          };
          window.addEventListener('resize', resizeCanvas);
          resizeCanvas();

          const drawHex = (cx, cy, size) => {
            ctx.beginPath();
            for (let i = 0; i < 6; i++) {
              const angle = (Math.PI / 3) * i;
              const vx = cx + size * Math.cos(angle);
              const vy = cy + size * Math.sin(angle);
              if (i === 0) ctx.moveTo(vx, vy);
              else ctx.lineTo(vx, vy);
            }
            ctx.closePath();
          };

          const drawCircle = (cx, cy, size) => {
            ctx.beginPath();
            ctx.arc(cx, cy, size / 2, 0, Math.PI * 2);
            ctx.closePath();
          };

          const drawTriangle = (cx, cy, size, flip) => {
            ctx.beginPath();
            if (flip) {
              ctx.moveTo(cx, cy + size / 2);
              ctx.lineTo(cx + size / 2, cy - size / 2);
              ctx.lineTo(cx - size / 2, cy - size / 2);
            } else {
              ctx.moveTo(cx, cy - size / 2);
              ctx.lineTo(cx + size / 2, cy + size / 2);
              ctx.lineTo(cx - size / 2, cy + size / 2);
            }
            ctx.closePath();
          };

          const drawGrid = () => {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            if (isHex) {
              const colShift = Math.floor(gridOffset.x / hexHoriz);
              const offsetX = ((gridOffset.x % hexHoriz) + hexHoriz) % hexHoriz;
              const offsetY = ((gridOffset.y % hexVert) + hexVert) % hexVert;
              const cols = Math.ceil(canvas.width / hexHoriz) + 3;
              const rows = Math.ceil(canvas.height / hexVert) + 3;

              for (let col = -2; col < cols; col++) {
                for (let row = -2; row < rows; row++) {
                  const cx = col * hexHoriz + offsetX;
                  const cy = row * hexVert + ((col + colShift) % 2 !== 0 ? hexVert / 2 : 0) + offsetY;
                  const alpha = cellOpacities.get(`${col},${row}`);
                  if (alpha) {
                    ctx.globalAlpha = alpha;
                    drawHex(cx, cy, squareSize);
                    ctx.fillStyle = hoverFillColor;
                    ctx.fill();
                    ctx.globalAlpha = 1;
                  }
                  drawHex(cx, cy, squareSize);
                  ctx.strokeStyle = borderColor;
                  ctx.stroke();
                }
              }
            } else if (isTri) {
              const halfW = squareSize / 2;
              const colShift = Math.floor(gridOffset.x / halfW);
              const rowShift = Math.floor(gridOffset.y / squareSize);
              const offsetX = ((gridOffset.x % halfW) + halfW) % halfW;
              const offsetY = ((gridOffset.y % squareSize) + squareSize) % squareSize;
              const cols = Math.ceil(canvas.width / halfW) + 4;
              const rows = Math.ceil(canvas.height / squareSize) + 4;

              for (let col = -2; col < cols; col++) {
                for (let row = -2; row < rows; row++) {
                  const cx = col * halfW + offsetX;
                  const cy = row * squareSize + squareSize / 2 + offsetY;
                  const flip = ((col + colShift + row + rowShift) % 2 + 2) % 2 !== 0;
                  const alpha = cellOpacities.get(`${col},${row}`);
                  if (alpha) {
                    ctx.globalAlpha = alpha;
                    drawTriangle(cx, cy, squareSize, flip);
                    ctx.fillStyle = hoverFillColor;
                    ctx.fill();
                    ctx.globalAlpha = 1;
                  }
                  drawTriangle(cx, cy, squareSize, flip);
                  ctx.strokeStyle = borderColor;
                  ctx.stroke();
                }
              }
            } else if (shape === 'circle') {
              const offsetX = ((gridOffset.x % squareSize) + squareSize) % squareSize;
              const offsetY = ((gridOffset.y % squareSize) + squareSize) % squareSize;
              const cols = Math.ceil(canvas.width / squareSize) + 3;
              const rows = Math.ceil(canvas.height / squareSize) + 3;

              for (let col = -2; col < cols; col++) {
                for (let row = -2; row < rows; row++) {
                  const cx = col * squareSize + squareSize / 2 + offsetX;
                  const cy = row * squareSize + squareSize / 2 + offsetY;
                  const alpha = cellOpacities.get(`${col},${row}`);
                  if (alpha) {
                    ctx.globalAlpha = alpha;
                    drawCircle(cx, cy, squareSize);
                    ctx.fillStyle = hoverFillColor;
                    ctx.fill();
                    ctx.globalAlpha = 1;
                  }
                  drawCircle(cx, cy, squareSize);
                  ctx.strokeStyle = borderColor;
                  ctx.stroke();
                }
              }
            } else {
              const offsetX = ((gridOffset.x % squareSize) + squareSize) % squareSize;
              const offsetY = ((gridOffset.y % squareSize) + squareSize) % squareSize;
              const cols = Math.ceil(canvas.width / squareSize) + 3;
              const rows = Math.ceil(canvas.height / squareSize) + 3;

              for (let col = -2; col < cols; col++) {
                for (let row = -2; row < rows; row++) {
                  const sx = col * squareSize + offsetX;
                  const sy = row * squareSize + offsetY;
                  const alpha = cellOpacities.get(`${col},${row}`);
                  if (alpha) {
                    ctx.globalAlpha = alpha;
                    ctx.fillStyle = hoverFillColor;
                    ctx.fillRect(sx, sy, squareSize, squareSize);
                    ctx.globalAlpha = 1;
                  }
                  ctx.strokeStyle = borderColor;
                  ctx.strokeRect(sx, sy, squareSize, squareSize);
                }
              }
            }
          };

          const updateCellOpacities = () => {
            const targets = new Map();
            if (hoveredSquare) {
              targets.set(`${hoveredSquare.x},${hoveredSquare.y}`, 1);
            }
            if (hoverTrailAmount > 0) {
              for (let i = 0; i < trailCells.length; i++) {
                const t = trailCells[i];
                const key = `${t.x},${t.y}`;
                if (!targets.has(key)) {
                  targets.set(key, (trailCells.length - i) / (trailCells.length + 1));
                }
              }
            }
            for (const [key] of targets) {
              if (!cellOpacities.has(key)) cellOpacities.set(key, 0);
            }
            for (const [key, opacity] of cellOpacities) {
              const target = targets.get(key) || 0;
              const next = opacity + (target - opacity) * 0.15;
              if (next < 0.005) cellOpacities.delete(key);
              else cellOpacities.set(key, next);
            }
          };

          const updateAnimation = () => {
            const effectiveSpeed = Math.max(speed, 0.1);
            const wrapX = isHex ? hexHoriz * 2 : squareSize;
            const wrapY = isHex ? hexVert : isTri ? squareSize * 2 : squareSize;

            switch (direction) {
              case 'right':
                gridOffset.x = (gridOffset.x - effectiveSpeed + wrapX) % wrapX;
                break;
              case 'left':
                gridOffset.x = (gridOffset.x + effectiveSpeed + wrapX) % wrapX;
                break;
              case 'up':
                gridOffset.y = (gridOffset.y + effectiveSpeed + wrapY) % wrapY;
                break;
              case 'down':
                gridOffset.y = (gridOffset.y - effectiveSpeed + wrapY) % wrapY;
                break;
              case 'diagonal':
                gridOffset.x = (gridOffset.x - effectiveSpeed + wrapX) % wrapX;
                gridOffset.y = (gridOffset.y - effectiveSpeed + wrapY) % wrapY;
                break;
            }

            updateCellOpacities();
            drawGrid();
            requestAnimationFrame(updateAnimation);
          };

          const setHovered = (col, row) => {
            if (!hoveredSquare || hoveredSquare.x !== col || hoveredSquare.y !== row) {
              if (hoveredSquare && hoverTrailAmount > 0) {
                trailCells.unshift({ ...hoveredSquare });
                if (trailCells.length > hoverTrailAmount) trailCells.length = hoverTrailAmount;
              }
              hoveredSquare = { x: col, y: row };
            }
          };

          // Attach to window (canvas sits behind content with pointer-events:none)
          const handleMouseMove = (event) => {
            const rect = canvas.getBoundingClientRect();
            const mouseX = event.clientX - rect.left;
            const mouseY = event.clientY - rect.top;
            if (mouseX < 0 || mouseY < 0 || mouseX > rect.width || mouseY > rect.height) return;

            if (isHex) {
              const colShift = Math.floor(gridOffset.x / hexHoriz);
              const offsetX = ((gridOffset.x % hexHoriz) + hexHoriz) % hexHoriz;
              const offsetY = ((gridOffset.y % hexVert) + hexVert) % hexVert;
              const col = Math.round((mouseX - offsetX) / hexHoriz);
              const rowOffset = (col + colShift) % 2 !== 0 ? hexVert / 2 : 0;
              const row = Math.round((mouseY - offsetY - rowOffset) / hexVert);
              setHovered(col, row);
            } else if (isTri) {
              const halfW = squareSize / 2;
              const offsetX = ((gridOffset.x % halfW) + halfW) % halfW;
              const offsetY = ((gridOffset.y % squareSize) + squareSize) % squareSize;
              const col = Math.round((mouseX - offsetX) / halfW);
              const row = Math.floor((mouseY - offsetY) / squareSize);
              setHovered(col, row);
            } else if (shape === 'circle') {
              const offsetX = ((gridOffset.x % squareSize) + squareSize) % squareSize;
              const offsetY = ((gridOffset.y % squareSize) + squareSize) % squareSize;
              const col = Math.round((mouseX - offsetX) / squareSize);
              const row = Math.round((mouseY - offsetY) / squareSize);
              setHovered(col, row);
            } else {
              const offsetX = ((gridOffset.x % squareSize) + squareSize) % squareSize;
              const offsetY = ((gridOffset.y % squareSize) + squareSize) % squareSize;
              const col = Math.floor((mouseX - offsetX) / squareSize);
              const row = Math.floor((mouseY - offsetY) / squareSize);
              setHovered(col, row);
            }
          };

          const handleMouseLeave = () => {
            if (hoveredSquare && hoverTrailAmount > 0) {
              trailCells.unshift({ ...hoveredSquare });
              if (trailCells.length > hoverTrailAmount) trailCells.length = hoverTrailAmount;
            }
            hoveredSquare = null;
          };

          window.addEventListener('mousemove', handleMouseMove);
          document.addEventListener('mouseleave', handleMouseLeave);
          requestAnimationFrame(updateAnimation);
        }
      });
    </script>
  </body>
</html>

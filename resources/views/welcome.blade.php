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
    <!-- tsParticles -->
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2/tsparticles.bundle.min.js"></script>
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
      .skill-float{animation:float 3s ease-in-out infinite}
      .skill-float:nth-child(2n){animation-delay:.4s}
      .skill-float:nth-child(3n){animation-delay:.8s}
      .skill-float:nth-child(4n){animation-delay:1.2s}
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
      /* Skill card glow on hover */
      .skill-card:hover{box-shadow:0 0 20px rgba(0,176,255,.15),0 8px 25px rgba(0,0,0,.4)}
      /* Skill name fade up */
      .skill-name{opacity:0;transform:translateY(8px);transition:opacity .3s ease,transform .3s ease}
      .skill-card:hover .skill-name{opacity:1;transform:translateY(0)}
      /* Project card image zoom */
      .project-card img{transition:transform .4s ease}
      .project-card:hover img{transform:scale(1.05)}
      /* Project card buttons slide up */
      .project-buttons{transform:translateY(8px);opacity:0;transition:transform .3s ease,opacity .3s ease}
      .project-card:hover .project-buttons{transform:translateY(0);opacity:1}
      /* Button glow */
      .btn-glow:hover{box-shadow:0 0 15px rgba(0,176,255,.4)}
      /* Particle container */
      #particle-sections{position:relative;background:#111827}
      #particle-sections .content-layer>*{background-color:transparent!important}
      #tsparticles{position:fixed;inset:0;z-index:0;pointer-events:none;opacity:0;transition:opacity 1s ease}
      @media(min-width:768px){#tsparticles{left:20rem}}
      #tsparticles.visible{opacity:1}
        /* Transparent scrollbar tracks and subtle thumb using accent */
        /* WebKit browsers */
        .overflow-auto::-webkit-scrollbar { width: 10px; height: 10px; }
        .overflow-auto::-webkit-scrollbar-track { background: transparent; }
        .overflow-auto::-webkit-scrollbar-thumb { background: rgba(0,176,255,0.18); border-radius: 9999px; border: 2px solid transparent; background-clip: padding-box; }
        /* Firefox */
        .overflow-auto { scrollbar-width: thin; scrollbar-color: rgba(0,176,255,0.18) transparent; }

      /* ── Theme toggle button (top center) ── */
      .theme-toggle{
        position:fixed; top:1.25rem; right:1.5rem;
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
      body.light .skill-card{box-shadow:0 4px 14px rgba(0,0,0,.08)}
      body.light .skill-card:hover{box-shadow:0 0 20px rgba(0,176,255,.18),0 8px 25px rgba(0,0,0,.12)}
    </style>
  </head>
  <body class="bg-gray-900 text-gray-200 min-h-screen">
    <script>if(localStorage.getItem('theme')==='light'){document.body.classList.add('light');}</script>
    <!-- Light / Dark theme toggle (top center) -->
    <button id="themeToggle" class="theme-toggle" aria-label="Toggle light and dark theme" title="Toggle theme">
      <span id="themeIcon"></span>
    </button>

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
        <div class="max-w-2xl text-white z-10">
          <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">Explore my Fullstack <br>Universe Fellas!</h1>
          <p class="mb-6 text-sm text-gray-300"><span class="text-lime-400">&lt;code&gt;</span> I interpret mockup design into a responsive webapp. <span class="text-lime-400">&lt;/code&gt;</span></p>
          <div class="flex gap-4">
            <button class="px-6 py-2 bg-lime-400 text-black font-bold rounded hover:bg-lime-500 transition"><i class="fa-solid fa-envelope mr-2"></i>Email Me</button>
            <button class="px-6 py-2 border-2 border-lime-400 text-lime-400 font-bold rounded hover:bg-lime-400 hover:text-black transition"><i class="fa-brands fa-linkedin mr-2"></i>LinkedIn Me</button>
          </div>
        </div>
        <div class="absolute right-0 pointer-events-none z-0" style="width:420px; bottom:-14%;">
          <img id="heroImg" src="{{ asset('storage/assets/3.png') }}" alt="Profile" class="w-full h-auto block" />
        </div>
      </div>

      <!-- Particle Background (About → Contact) -->
      <div id="particle-sections">
        <div id="tsparticles"></div>
        <div class="content-layer relative z-10">

      <!-- About Section -->
      <div class="px-6 md:px-12 py-16 flex flex-col md:flex-row gap-12 items-start">
        <div class="md:w-1/3 flex-shrink-0">
          <img src="{{ asset('storage/assets/cjsheesh.png') }}" alt="Profile" class="w-full  object-cover" />
          <!-- Tech Stack Icons -->
          <div class="flex justify-between gap-0 mt-6 w-full">
            <i class="devicon-html5-plain text-5xl"></i>
            <i class="devicon-css3-plain text-5xl"></i>
            <i class="devicon-javascript-plain text-5xl"></i>
            <i class="devicon-php-plain text-5xl"></i>
            <i class="devicon-mysql-plain text-5xl"></i>
          </div>
        </div>
        <div class="md:w-2/3 flex flex-col justify-center">
          <h2 class="text-4xl font-bold text-lime-400 mb-6">Hi! I'm CJ</h2>
          <p class="text-gray-300 text-base leading-relaxed mb-4">
            A web developer who's passionate about creating innovative solutions that make a difference. I love working with JavaScript, React, and MySQL to build responsive, user-friendly applications and optimize performance.
          </p>
          <p class="text-gray-300 text-base leading-relaxed mb-8">
            I'm based in the Philippines and have been part of a variety of projects—everything from building sleek websites to ...
          </p>
          <button class="w-fit px-8 py-3 bg-lime-400 text-black font-bold text-lg rounded hover:bg-lime-500 transition">READ MORE</button>
        </div>
      </div>


      <!-- ═══════════════════════════════════════════════ -->
      <!-- Skills & Tools Section                         -->
      <!-- ═══════════════════════════════════════════════ -->
      <section class="bg-gray-900 px-6 md:px-12 py-16 ">
        <h2 class="text-4xl font-bold text-lime-400 mb-12 text-center reveal">Skills & Tools</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 max-w-4xl mx-auto">
          <!-- HTML -->
          <div class="skill-card skill-float reveal group flex flex-col items-center justify-center p-6 bg-gray-800 rounded-2xl cursor-default transition-all duration-300 hover:-translate-y-1">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" alt="HTML" class="w-12 h-12 transition-transform duration-300 group-hover:scale-110" />
            <span class="skill-name mt-3 text-sm font-semibold text-lime-400">HTML</span>
          </div>
          <!-- CSS -->
          <div class="skill-card skill-float reveal group flex flex-col items-center justify-center p-6 bg-gray-800 rounded-2xl cursor-default transition-all duration-300 hover:-translate-y-1">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" alt="CSS" class="w-12 h-12 transition-transform duration-300 group-hover:scale-110" />
            <span class="skill-name mt-3 text-sm font-semibold text-lime-400">CSS</span>
          </div>
          <!-- JavaScript -->
          <div class="skill-card skill-float reveal group flex flex-col items-center justify-center p-6 bg-gray-800 rounded-2xl cursor-default transition-all duration-300 hover:-translate-y-1">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="JavaScript" class="w-12 h-12 transition-transform duration-300 group-hover:scale-110" />
            <span class="skill-name mt-3 text-sm font-semibold text-lime-400">JavaScript</span>
          </div>
          <!-- VS Code -->
          <div class="skill-card skill-float reveal group flex flex-col items-center justify-center p-6 bg-gray-800 rounded-2xl cursor-default transition-all duration-300 hover:-translate-y-1">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vscode/vscode-original.svg" alt="VS Code" class="w-12 h-12 transition-transform duration-300 group-hover:scale-110" />
            <span class="skill-name mt-3 text-sm font-semibold text-lime-400">VS Code</span>
          </div>
          <!-- Laravel -->
          <div class="skill-card skill-float reveal group flex flex-col items-center justify-center p-6 bg-gray-800 rounded-2xl cursor-default transition-all duration-300 hover:-translate-y-1">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg" alt="Laravel" class="w-12 h-12 transition-transform duration-300 group-hover:scale-110" />
            <span class="skill-name mt-3 text-sm font-semibold text-lime-400">Laravel</span>
          </div>
          <!-- Filament -->
          <div class="skill-card skill-float reveal group flex flex-col items-center justify-center p-6 bg-gray-800 rounded-2xl cursor-default transition-all duration-300 hover:-translate-y-1">
            <svg class="w-12 h-12 transition-transform duration-300 group-hover:scale-110" style="color: #fbbf24;" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15.5v-5H7.5L13 5.5v5h3.5L11 17.5z"/></svg>
            <span class="skill-name mt-3 text-sm font-semibold text-lime-400">Filament</span>
          </div>
          <!-- Git -->
          <div class="skill-card skill-float reveal group flex flex-col items-center justify-center p-6 bg-gray-800 rounded-2xl cursor-default transition-all duration-300 hover:-translate-y-1">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg" alt="Git" class="w-12 h-12 transition-transform duration-300 group-hover:scale-110" />
            <span class="skill-name mt-3 text-sm font-semibold text-lime-400">Git</span>
          </div>
          <!-- GitHub -->
          <div class="skill-card skill-float reveal group flex flex-col items-center justify-center p-6 bg-gray-800 rounded-2xl cursor-default transition-all duration-300 hover:-translate-y-1">
            <i class="fa-brands fa-github text-5xl text-white transition-transform duration-300 group-hover:scale-110"></i>
            <span class="skill-name mt-3 text-sm font-semibold text-lime-400">GitHub</span>
          </div>
          <!-- cPanel -->
          <div class="skill-card skill-float reveal group flex flex-col items-center justify-center p-6 bg-gray-800 rounded-2xl cursor-default transition-all duration-300 hover:-translate-y-1">
            <i class="fa-solid fa-server text-5xl transition-transform duration-300 group-hover:scale-110" style="color: #ff6b35;"></i>
            <span class="skill-name mt-3 text-sm font-semibold text-lime-400">cPanel</span>
          </div>
          <!-- MySQL -->
          <div class="skill-card skill-float reveal group flex flex-col items-center justify-center p-6 bg-gray-800 rounded-2xl cursor-default transition-all duration-300 hover:-translate-y-1">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" alt="MySQL" class="w-12 h-12 transition-transform duration-300 group-hover:scale-110" />
            <span class="skill-name mt-3 text-sm font-semibold text-lime-400">MySQL</span>
          </div>
          <!-- PHP -->
          <div class="skill-card skill-float reveal group flex flex-col items-center justify-center p-6 bg-gray-800 rounded-2xl cursor-default transition-all duration-300 hover:-translate-y-1">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="PHP" class="w-12 h-12 transition-transform duration-300 group-hover:scale-110" />
            <span class="skill-name mt-3 text-sm font-semibold text-lime-400">PHP</span>
          </div>
          <!-- WordPress -->
          <div class="skill-card skill-float reveal group flex flex-col items-center justify-center p-6 bg-gray-800 rounded-2xl cursor-default transition-all duration-300 hover:-translate-y-1">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/wordpress/wordpress-plain.svg" alt="WordPress" class="w-12 h-12 transition-transform duration-300 group-hover:scale-110" />
            <span class="skill-name mt-3 text-sm font-semibold text-lime-400">WordPress</span>
          </div>
        </div>
      </section>

      <!-- ═══════════════════════════════════════════════ -->
      <!-- Projects Section                               -->
      <!-- ═══════════════════════════════════════════════ -->
      <section class="bg-gray-900 px-6 md:px-12 py-16 ">
        <h2 class="text-4xl font-bold text-lime-400 mb-12 text-center reveal">My Projects</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">

          <!-- Project Card 1 -->
          <div class="project-card reveal bg-gray-800 rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-black/30 hover:-translate-y-1">
            <div class="overflow-hidden">
              <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&q=80" alt="Project" class="w-full h-48 object-cover" />
            </div>
            <div class="p-6">
              <h3 class="text-lg font-bold text-white mb-2">Portfolio Website</h3>
              <p class="text-gray-400 text-sm mb-4">A personal portfolio built with modern web technologies showcasing projects and skills.</p>
              <div class="flex flex-wrap gap-2 mb-4">
                <span class="px-2 py-0.5 bg-gray-700 text-lime-400 text-xs font-semibold rounded">HTML</span>
                <span class="px-2 py-0.5 bg-gray-700 text-lime-400 text-xs font-semibold rounded">TailwindCSS</span>
                <span class="px-2 py-0.5 bg-gray-700 text-lime-400 text-xs font-semibold rounded">JS</span>
              </div>
              <div class="project-buttons flex gap-3">
                <a href="#" class="btn-glow px-4 py-2 bg-lime-400 text-black text-sm font-bold rounded hover:bg-lime-500 transition">Live Demo</a>
                <a href="#" class="px-4 py-2 border border-lime-400 text-lime-400 text-sm font-bold rounded hover:bg-lime-400 hover:text-black transition">GitHub</a>
              </div>
            </div>
          </div>

          <!-- Project Card 2 -->
          <div class="project-card reveal bg-gray-800 rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-black/30 hover:-translate-y-1">
            <div class="overflow-hidden">
              <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600&q=80" alt="Project" class="w-full h-48 object-cover" />
            </div>
            <div class="p-6">
              <h3 class="text-lg font-bold text-white mb-2">Admin Dashboard</h3>
              <p class="text-gray-400 text-sm mb-4">A full-featured admin panel built with Laravel and Filament for content management.</p>
              <div class="flex flex-wrap gap-2 mb-4">
                <span class="px-2 py-0.5 bg-gray-700 text-lime-400 text-xs font-semibold rounded">Laravel</span>
                <span class="px-2 py-0.5 bg-gray-700 text-lime-400 text-xs font-semibold rounded">Filament</span>
                <span class="px-2 py-0.5 bg-gray-700 text-lime-400 text-xs font-semibold rounded">MySQL</span>
              </div>
              <div class="project-buttons flex gap-3">
                <a href="#" class="btn-glow px-4 py-2 bg-lime-400 text-black text-sm font-bold rounded hover:bg-lime-500 transition">Live Demo</a>
                <a href="#" class="px-4 py-2 border border-lime-400 text-lime-400 text-sm font-bold rounded hover:bg-lime-400 hover:text-black transition">GitHub</a>
              </div>
            </div>
          </div>

          <!-- Project Card 3 -->
          <div class="project-card reveal bg-gray-800 rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-black/30 hover:-translate-y-1">
            <div class="overflow-hidden">
              <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=600&q=80" alt="Project" class="w-full h-48 object-cover" />
            </div>
            <div class="p-6">
              <h3 class="text-lg font-bold text-white mb-2">E-Commerce Platform</h3>
              <p class="text-gray-400 text-sm mb-4">A responsive online store with cart functionality, payment integration, and order tracking.</p>
              <div class="flex flex-wrap gap-2 mb-4">
                <span class="px-2 py-0.5 bg-gray-700 text-lime-400 text-xs font-semibold rounded">PHP</span>
                <span class="px-2 py-0.5 bg-gray-700 text-lime-400 text-xs font-semibold rounded">WordPress</span>
                <span class="px-2 py-0.5 bg-gray-700 text-lime-400 text-xs font-semibold rounded">MySQL</span>
              </div>
              <div class="project-buttons flex gap-3">
                <a href="#" class="btn-glow px-4 py-2 bg-lime-400 text-black text-sm font-bold rounded hover:bg-lime-500 transition">Live Demo</a>
                <a href="#" class="px-4 py-2 border border-lime-400 text-lime-400 text-sm font-bold rounded hover:bg-lime-400 hover:text-black transition">GitHub</a>
              </div>
            </div>
          </div>

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

        <div class="max-w-2xl mx-auto">
          <form onsubmit="return false" class="space-y-6">
            <div class="reveal">
              <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Name</label>
              <input type="text" id="name" name="name" placeholder="Your name" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-lime-400 transition" />
            </div>
            <div class="reveal">
              <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
              <input type="email" id="email" name="email" placeholder="you@example.com" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-lime-400 transition" />
            </div>
            <div class="reveal">
              <label for="message" class="block text-sm font-medium text-gray-300 mb-1">Message</label>
              <textarea id="message" name="message" rows="5" placeholder="Your message…" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-lime-400 transition resize-none"></textarea>
            </div>
            <div class="reveal">
              <button type="submit" class="btn-glow w-full px-8 py-3 bg-lime-400 text-black font-bold text-lg rounded-lg hover:bg-lime-500 transition">Send Message</button>
            </div>
          </form>

          <!-- Social Icons -->
          <div class="flex justify-center gap-6 mt-10 reveal">
            <a href="https://github.com/" target="_blank" rel="noopener" class="text-gray-400 hover:text-lime-400 transition-transform duration-300 hover:scale-110">
              <i class="fa-brands fa-github text-2xl"></i>
            </a>
            <a href="mailto:christjoy@gmail.com" class="text-gray-400 hover:text-lime-400 transition-transform duration-300 hover:scale-110">
              <i class="fa-solid fa-envelope text-2xl"></i>
            </a>
            <a href="https://www.linkedin.com/" target="_blank" rel="noopener" class="text-gray-400 hover:text-lime-400 transition-transform duration-300 hover:scale-110">
              <i class="fa-brands fa-linkedin text-2xl"></i>
            </a>
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

    <!-- Scroll Reveal, Timeline & Particles -->
    <script>
      document.addEventListener('DOMContentLoaded', () => {
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

        // tsParticles initialization
        const particleSection = document.getElementById('particle-sections');
        if (particleSection && typeof tsParticles !== 'undefined') {
          tsParticles.load('tsparticles', {
            fullScreen: { enable: false },
            background: { color: { value: 'transparent' } },
            fpsLimit: 60,
            particles: {
              number: { value: 60, density: { enable: true, area: 800 } },
              color: { value: '#00b0ff' },
              opacity: { value: { min: 0.1, max: 0.25 } },
              size: { value: { min: 1, max: 3 } },
              move: {
                enable: true,
                speed: 1,
                direction: 'none',
                random: true,
                straight: false,
                outModes: { default: 'out' }
              },
              links: {
                enable: true,
                distance: 150,
                color: '#00b0ff',
                opacity: 0.08,
                width: 1
              }
            },
            interactivity: {
              detectsOn: 'window',
              events: {
                onHover: { enable: true, mode: 'repulse' },
                onClick: { enable: true, mode: 'push' }
              },
              modes: {
                repulse: { distance: 100, duration: 0.4 },
                push: { quantity: 3 }
              }
            },
            detectRetina: true,
            responsive: [
              {
                maxWidth: 768,
                options: {
                  particles: {
                    number: { value: 25 },
                    links: { distance: 100 }
                  }
                }
              }
            ]
          });

          // Show particles whenever particle-sections is in view; hero covers them via z-index
          const particleCanvas = document.getElementById('tsparticles');
          const particleObs = new IntersectionObserver((entries) => {
            particleCanvas.classList.toggle('visible', entries[0].isIntersecting);
          }, { threshold: 0.01 });
          particleObs.observe(particleSection);
        }
      });
    </script>
  </body>
</html>

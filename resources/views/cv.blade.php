<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CV / Resume — Christ Joy Macuto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
      /* ── APA 7th Edition formatting ──
         Times New Roman 12pt, double-spaced, 1-inch margins,
         page number top right, centered bold Level 1 headings,
         flush-left bold Level 2 headings, 0.5" hanging indents. */
      *{margin:0;padding:0;box-sizing:border-box}
      body{background:#374151;font-family:"Times New Roman",Times,serif;font-size:12pt;color:#000;padding:6rem 1rem 4rem}

      .page{background:#fff;max-width:8.5in;min-height:11in;margin:0 auto 2rem;padding:1in;box-shadow:0 20px 50px -18px rgba(0,0,0,.55);line-height:2}
      .page-number{text-align:right;line-height:2}

      /* Title block (upper half of an APA title page) */
      .title-block{text-align:center;margin-top:2in}
      .title-block .paper-title{font-weight:bold}
      .title-block p{line-height:2}

      /* APA headings */
      h1.apa{font-size:12pt;font-weight:bold;text-align:center;line-height:2}
      h2.apa{font-size:12pt;font-weight:bold;text-align:left;line-height:2}

      p{line-height:2}
      .indent{text-indent:.5in}
      .hanging{padding-left:.5in;text-indent:-.5in;line-height:2}

      /* ── Screen-only toolbar ── */
      .toolbar{position:fixed;top:1.25rem;left:0;right:0;z-index:50;display:flex;justify-content:space-between;padding:0 1.5rem;pointer-events:none}
      .toolbar a,.toolbar button{pointer-events:auto;display:inline-flex;align-items:center;gap:.55rem;padding:.6rem 1.2rem;border-radius:9999px;background:rgba(17,24,39,.9);border:1px solid rgba(0,176,255,.35);color:#e5e7eb;font-family:ui-sans-serif,system-ui,sans-serif;font-size:.85rem;font-weight:600;text-decoration:none;cursor:pointer;backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);transition:transform .25s ease,color .25s ease,box-shadow .25s ease}
      .toolbar a:hover,.toolbar button:hover{transform:translateY(-2px);color:#00b0ff;box-shadow:0 10px 24px -10px rgba(0,176,255,.6)}
      .toolbar i{color:#00b0ff}

      .sample-note{max-width:8.5in;margin:0 auto 1.25rem;text-align:center;font-family:ui-sans-serif,system-ui,sans-serif;font-size:.8rem;color:#d1d5db}

      @media print{
        body{background:#fff;padding:0}
        .page{box-shadow:none;margin:0;max-width:none;min-height:0}
        .toolbar,.sample-note{display:none}
      }
    </style>
  </head>
  <body>
    <div class="toolbar">
      <a href="{{ url('/') }}"><i class="fa-solid fa-arrow-left"></i>Back to Home</a>
      <button onclick="window.print()"><i class="fa-solid fa-print"></i>Print / Save as PDF</button>
    </div>

    <p class="sample-note"><i class="fa-solid fa-circle-info"></i> APA 7th Edition–style layout with sample data — replace with your own details.</p>

    <!-- ── Page 1: Title page ── -->
    <div class="page">
      <div class="page-number">1</div>
      <div class="title-block">
        <p class="paper-title">Curriculum Vitae</p>
        <p>&nbsp;</p>
        <p>Christ Joy Macuto</p>
        <p>College of Computer Studies, Sample State University</p>
        <p>Hilongos, Leyte, Philippines</p>
        <p>christjoy@gmail.com</p>
        <p>July 2, 2026</p>
      </div>
    </div>

    <!-- ── Page 2: CV body ── -->
    <div class="page">
      <div class="page-number">2</div>

      <h1 class="apa">Professional Summary</h1>
      <p class="indent">
        Full-stack web developer based in the Philippines with hands-on experience designing, building, and deploying
        responsive web applications using PHP, JavaScript, and MySQL. Has built systems from scratch, including personal
        projects, government-related systems, and school management systems. Committed to writing clean, maintainable
        code and to continuous professional growth.
      </p>

      <h1 class="apa">Education</h1>
      <p class="hanging">
        Sample State University. (2020–2024). <i>Bachelor of Science in Information Technology</i>. Hilongos, Leyte,
        Philippines. Graduated with honors; capstone project: a web-based school management system built with PHP and
        MySQL.
      </p>
      <p class="hanging">
        Sample National High School. (2014–2020). <i>Secondary education, STEM strand</i>. Hilongos, Leyte, Philippines.
      </p>

      <h1 class="apa">Professional Experience</h1>

      <h2 class="apa">Junior Web Developer, Sample Tech Solutions Inc. (2024–Present)</h2>
      <p class="indent">
        Develops and maintains client web applications built on Laravel and MySQL. Translates mockup designs into
        responsive, accessible interfaces; implements RESTful APIs; and assists with deployment and version control
        using Git and GitHub.
      </p>

      <h2 class="apa">Freelance Web Developer, Self-Employed (2022–2024)</h2>
      <p class="indent">
        Delivered websites and systems for local clients, including a WordPress website for a local business, a
        government-related records system, and a school management system. Handled the full project lifecycle from
        requirements gathering to deployment on cPanel hosting.
      </p>

      <h1 class="apa">Technical Skills</h1>
      <p class="hanging">Languages: PHP, JavaScript, HTML, CSS, SQL.</p>
      <p class="hanging">Frameworks and libraries: Laravel, Filament, React, Node.js/Express, Bootstrap, Tailwind CSS.</p>
      <p class="hanging">Databases and tools: MySQL, Git, GitHub, Jira, VS Code, cPanel, WordPress.</p>
      <p class="hanging">Other: RESTful API design, responsive web design, SEO fundamentals, project management.</p>

      <h1 class="apa">Selected Projects</h1>
      <p class="hanging">
        Macuto, C. J. (2025). <i>Personal portfolio website</i> [Web application]. Built with Laravel, Tailwind CSS, and
        vanilla JavaScript. https://github.com/ChristJoy3
      </p>
      <p class="hanging">
        Macuto, C. J. (2024). <i>School management system</i> [Web application]. Student records, enrollment workflows,
        and administrative dashboards built with PHP and MySQL.
      </p>
      <p class="hanging">
        Macuto, C. J. (2023). <i>Government records management system</i> [Web application]. Records and reporting system
        for a local government unit built with Laravel and MySQL.
      </p>

      <h1 class="apa">Certifications and Training</h1>
      <p class="hanging">Sample Institute. (2024). <i>Certificate in full-stack web development</i>. Online program, 120 hours.</p>
      <p class="hanging">Sample Learning Platform. (2023). <i>Responsive web design certification</i>. Online program, 300 hours.</p>

      <h1 class="apa">References</h1>
      <p class="hanging">
        Dela Cruz, J. (Project Manager, Sample Tech Solutions Inc.). Available upon request.
      </p>
      <p class="hanging">
        Santos, M. (Professor, College of Computer Studies, Sample State University). Available upon request.
      </p>
    </div>
  </body>
</html>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CV / Resume — {{ $cv->name }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
      *{margin:0;padding:0;box-sizing:border-box}
      body{background:#374151;font-family:ui-sans-serif,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;font-size:10.5pt;line-height:1.55;color:#1f2937;padding:6rem 1rem 4rem}

      .page{background:#fff;max-width:8.5in;min-height:11in;margin:0 auto;padding:.85in .9in;box-shadow:0 20px 50px -18px rgba(0,0,0,.55)}

      h1,h2{font-family:Georgia,"Times New Roman",serif;font-weight:400;color:#111827}
      h1{font-size:26pt;line-height:1.15}
      h2{font-size:15pt;margin:1.5rem 0 .5rem;padding-bottom:.25rem;border-bottom:1px solid #e5e7eb}
      .headline{margin-top:.5rem;font-weight:700;color:#111827}
      .contact{margin-top:.2rem;color:#374151}
      .contact span+span::before{content:" | ";color:#9ca3af}
      a{color:#0369a1}

      ul{margin:.4rem 0 0 1.25rem}
      li{margin-top:.2rem}
      .skills li strong,.role{color:#111827}
      .role{font-weight:700;margin-top:.5rem}
      .meta{color:#374151}
      .block+.block{margin-top:1rem}
      .tags{margin-top:.2rem}

      /* ── Screen-only toolbar ── */
      .toolbar{position:fixed;top:1.25rem;left:0;right:0;z-index:50;display:flex;justify-content:space-between;padding:0 1.5rem;pointer-events:none}
      .toolbar a,.toolbar button{pointer-events:auto;display:inline-flex;align-items:center;gap:.55rem;padding:.6rem 1.2rem;border-radius:9999px;background:rgba(17,24,39,.9);border:1px solid rgba(0,176,255,.35);color:#e5e7eb;font-family:ui-sans-serif,system-ui,sans-serif;font-size:.85rem;font-weight:600;text-decoration:none;cursor:pointer;backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);transition:transform .25s ease,color .25s ease,box-shadow .25s ease}
      .toolbar a:hover,.toolbar button:hover{transform:translateY(-2px);color:#00b0ff;box-shadow:0 10px 24px -10px rgba(0,176,255,.6)}
      .toolbar i{color:#00b0ff}

      @media (max-width:640px){.page{padding:1.5rem 1.25rem;min-height:0}h1{font-size:21pt}}
      @media print{
        @page{margin:.6in}
        body{background:#fff;padding:0}
        .page{box-shadow:none;max-width:none;min-height:0;padding:0}
        .toolbar{display:none}
        h2,.block{break-inside:avoid}
      }
    </style>
  </head>
  <body>
    <div class="toolbar">
      <a href="{{ url('/') }}"><i class="fa-solid fa-arrow-left"></i>Back to Home</a>
      <button onclick="window.print()"><i class="fa-solid fa-print"></i>Print / Save as PDF</button>
    </div>

    <div class="page">
      <header>
        <h1>{{ $cv->name }}</h1>
        @if($cv->headline)<p class="headline">{{ $cv->headline }}</p>@endif
        <p class="contact">
          @if($cv->location)<span>{{ $cv->location }}</span>@endif
          @if($cv->phone)<span>{{ $cv->phone }}</span>@endif
          @if($cv->email)<span><a href="mailto:{{ $cv->email }}">{{ $cv->email }}</a></span>@endif
          @if($cv->websiteUrl())<span><a href="{{ $cv->websiteUrl() }}" target="_blank" rel="noopener">{{ $cv->website }}</a></span>@endif
        </p>
      </header>

      @if($cv->summary)
        <h2>Professional Summary</h2>
        <p>{{ $cv->summary }}</p>
      @endif

      @if(!empty($cv->skills))
        <h2>Technical Skills</h2>
        <ul class="skills">
          @foreach($cv->skills as $skill)
            <li><strong>{{ $skill['label'] }}:</strong> {{ $skill['items'] }}</li>
          @endforeach
        </ul>
      @endif

      @if(!empty($cv->experience))
        <h2>Work Experience</h2>
        @foreach($cv->experience as $job)
          <div class="block">
            <p class="role">{{ $job['role'] }}</p>
            @php($line = collect([$job['organization'] ?? null, $job['details'] ?? null, $job['period'] ?? null])->filter()->implode(' | '))
            @if($line)<p class="meta">{{ $line }}</p>@endif
            @if($bullets = \App\Models\Resume::lines($job['bullets'] ?? null))
              <ul>@foreach($bullets as $b)<li>{{ $b }}</li>@endforeach</ul>
            @endif
          </div>
        @endforeach
      @endif

      @if(!empty($cv->education))
        <h2>Education</h2>
        @foreach($cv->education as $edu)
          <div class="block">
            <p class="role">{{ $edu['degree'] }}</p>
            @php($line = collect([$edu['school'] ?? null, $edu['period'] ?? null])->filter()->implode(' | '))
            @if($line)<p class="meta">{{ $line }}</p>@endif
            @if($items = \App\Models\Resume::lines($edu['highlights'] ?? null))
              <ul>@foreach($items as $i)<li>{{ $i }}</li>@endforeach</ul>
            @endif
          </div>
        @endforeach
      @endif

      @if(!empty($cv->soft_skills))
        <h2>Soft Skills</h2>
        <p class="tags">{{ implode(' | ', $cv->soft_skills) }}</p>
      @endif
    </div>
  </body>
</html>

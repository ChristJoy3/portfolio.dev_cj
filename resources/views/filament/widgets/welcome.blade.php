{{-- Plain CSS on purpose: the panel has no compiled theme, so Tailwind utilities that Filament
     itself doesn't use are not in its stylesheet. --}}
<x-filament-widgets::widget>
    <style>
        .cj-welcome{position:relative;overflow:hidden;border-radius:1rem;padding:2rem;color:#fff;
            background:linear-gradient(135deg,#0f172a 0%,#0c4a6e 55%,#0284c7 100%);box-shadow:0 1px 2px rgba(0,0,0,.08)}
        .cj-welcome::after{content:"";position:absolute;right:-4rem;top:-4rem;width:16rem;height:16rem;border-radius:9999px;
            background:radial-gradient(circle,rgba(56,189,248,.35),transparent 70%);pointer-events:none}
        .cj-welcome__top{position:relative;z-index:1;display:flex;flex-wrap:wrap;gap:1.5rem;align-items:center;justify-content:space-between}
        .cj-welcome__date{margin:0;font-size:.875rem;font-weight:500;color:#bae6fd}
        .cj-welcome__title{margin:.25rem 0 0;font-size:1.875rem;line-height:1.2;font-weight:700;color:#fff}
        .cj-welcome__text{margin:.5rem 0 0;max-width:36rem;font-size:.875rem;color:rgba(224,242,254,.85)}
        .cj-welcome__cta{display:inline-flex;align-items:center;gap:.5rem;padding:.65rem 1rem;border-radius:.75rem;
            background:#fff;color:#0f172a;font-size:.875rem;font-weight:600;text-decoration:none;box-shadow:0 2px 6px rgba(0,0,0,.2);transition:background .15s}
        .cj-welcome__cta:hover{background:#f0f9ff}
        .cj-welcome__actions{position:relative;z-index:1;display:flex;flex-wrap:wrap;gap:.5rem;margin-top:1.5rem}
        .cj-welcome__action{display:inline-flex;align-items:center;gap:.5rem;padding:.5rem .875rem;border-radius:.5rem;
            background:rgba(255,255,255,.1);box-shadow:inset 0 0 0 1px rgba(255,255,255,.18);color:#fff;
            font-size:.875rem;font-weight:500;text-decoration:none;transition:background .15s}
        .cj-welcome__action:hover{background:rgba(255,255,255,.22)}
        .cj-welcome svg{width:1rem;height:1rem;flex:none}
        @media (max-width:640px){.cj-welcome{padding:1.25rem}.cj-welcome__title{font-size:1.5rem}}
    </style>

    <div class="cj-welcome">
        <div class="cj-welcome__top">
            <div>
                <p class="cj-welcome__date">{{ now()->format('l, F j') }}</p>
                <h2 class="cj-welcome__title">{{ $greeting }}, {{ $name }} 👋</h2>
                <p class="cj-welcome__text">Everything on your portfolio is edited from here. Changes go live as soon as you save.</p>
            </div>

            <a href="{{ $siteUrl }}" target="_blank" rel="noopener" class="cj-welcome__cta">
                <x-filament::icon icon="heroicon-m-arrow-top-right-on-square" />
                View live site
            </a>
        </div>

        <div class="cj-welcome__actions">
            @foreach ($actions as $action)
                <a href="{{ $action['url'] }}" class="cj-welcome__action">
                    <x-filament::icon :icon="$action['icon']" />
                    {{ $action['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</x-filament-widgets::widget>

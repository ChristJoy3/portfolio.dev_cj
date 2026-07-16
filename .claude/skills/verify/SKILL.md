---
name: verify
description: Run and drive the dev_cj Laravel portfolio in a browser to confirm a change works end-to-end.
---

# Verifying dev_cj

Laravel + Filament portfolio. Frontend is **Blade + vanilla JS + inline `<style>`**,
not React. Tailwind comes from the CDN `<script>` in the page head, so **`npm run build`
is not needed to see frontend changes** — just reload.

## Handle

Herd already serves the app. No build, no `artisan serve`:

```bash
curl -s -o /dev/null -w "%{http_code}" http://dev_cj.test/    # expect 200
```

`/` renders `resources/views/welcome.blade.php` (the whole one-page portfolio).
Other views: `about.blade.php`, `cv.blade.php`. Admin is Filament under `/admin`.

If Herd is not serving, fall back to `php artisan serve --port=8000`.

## Drive it

Surface is pixels — use Playwright. It is not a project dep; install it in the
scratchpad, never in the repo:

```bash
cd "$SCRATCHPAD" && npm init -y && npm i playwright && npx playwright install chromium
```

Then script against `http://dev_cj.test/`. Useful patterns for this page:

- **Scroll first.** Nearly every section is hidden behind a `.reveal` class
  (`opacity:0`) until an IntersectionObserver fires. `locator.scrollIntoViewIfNeeded()`
  then `waitForTimeout(~1200)` before screenshotting, or you capture a blank box.
- **Animations pause off-screen.** The icon cloud (and the shape grid) stop their
  rAF loop via IntersectionObserver when scrolled away. If you sample transforms and
  see no movement, check `getBoundingClientRect()` is in the viewport before calling
  it a freeze. `setViewportSize()` re-lays-out the page and often scrolls the target
  out of view — re-scroll after resizing.
- **Prove motion by sampling, not by eye.** Read `el.style.transform` twice ~700ms
  apart and count how many changed; a screenshot can't show rotation.
- **Hovering an icon-cloud icon parks the sphere on purpose** (so the label stays put).
  Zero movement while hovering is correct, not a freeze — check on unhover instead.
  Note `boundingBox()` then `mouse.move()` races the rotation: the icon may drift away
  before the cursor lands, so re-read the box or hover a near (large) icon.
- **Theme** is `localStorage.setItem('theme','light')` → `body.light`. Set it with
  `page.addInitScript()` before `goto`.

## Layout gotcha: the 20rem sidebar

`welcome.blade.php` has a **fixed 320px (`md:w-[20rem]`) sidebar that appears at `md`**
(768px). Every section right of it therefore has ~320px less room than the viewport
suggests. A `md:flex-row` two-column split inside those sections leaves each column
~148px at 768px wide — technically laid out, visually broken. **Split at `lg:`, not
`md:`.** Always check widths at 768 and 820, not just phone and desktop.

## Known pre-existing quirks (not your bug)

- **Horizontal overflow on mobile**: `documentElement.scrollWidth` is 391 vs 375
  clientWidth at a 375px viewport, caused by the `.logoloop__track` marquee. Present
  on a clean checkout — confirm with `git stash` before blaming a change.
- Icons load from jsdelivr/Font Awesome CDNs, so the page needs network access.

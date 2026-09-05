/**
 * Player behaviour for a site made of video.
 *
 * Three jobs: drive the landscape players, keep the square loops playing only
 * while they are on screen, and cut elements in as they arrive. All of it
 * re-initialises after a view transition.
 */

const reduced = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const fmt = (s: number) => {
  if (!Number.isFinite(s)) return '0:00';
  const m = Math.floor(s / 60);
  return `${m}:${String(Math.floor(s % 60)).padStart(2, '0')}`;
};

/* -------------------------------------------------------------- players -- */
function wirePlayer(root: HTMLElement) {
  if (root.dataset.wired) return;
  root.dataset.wired = 'true';

  const video = root.querySelector<HTMLVideoElement>('video');
  const cover = root.querySelector<HTMLElement>('[data-cover]');
  const bar = root.querySelector<HTMLElement>('[data-bar]');
  const playBtn = root.querySelector<HTMLButtonElement>('[data-play]');
  const toggle = root.querySelector<HTMLButtonElement>('[data-toggle]');
  const scrub = root.querySelector<HTMLInputElement>('[data-scrub]');
  const timeEl = root.querySelector<HTMLElement>('[data-time]');
  const durEl = root.querySelector<HTMLElement>('[data-dur]');
  const muteBtn = root.querySelector<HTMLButtonElement>('[data-mute]');
  const fullBtn = root.querySelector<HTMLButtonElement>('[data-full]');
  if (!video) return;

  // Sound is off until asked for.
  video.muted = true;

  const start = () => {
    root.dataset.playing = 'true';
    bar?.removeAttribute('hidden');
    video.play().catch(() => {
      // Autoplay policy or a missing source — fall back to the resting card.
      delete root.dataset.playing;
      bar?.setAttribute('hidden', '');
    });
  };

  playBtn?.addEventListener('click', start);
  cover?.addEventListener('click', (e) => {
    if (e.target === cover) start();
  });

  toggle?.addEventListener('click', () => {
    if (video.paused) video.play();
    else video.pause();
  });

  video.addEventListener('play', () => {
    delete root.dataset.paused;
    toggle?.setAttribute('aria-label', 'Pause');
  });

  video.addEventListener('pause', () => {
    root.dataset.paused = 'true';
    toggle?.setAttribute('aria-label', 'Play');
  });

  video.addEventListener('ended', () => {
    delete root.dataset.playing;
    bar?.setAttribute('hidden', '');
    video.currentTime = 0;
  });

  video.addEventListener('loadedmetadata', () => {
    if (durEl) durEl.textContent = fmt(video.duration);
  });

  video.addEventListener('timeupdate', () => {
    if (timeEl) timeEl.textContent = fmt(video.currentTime);
    if (scrub && video.duration && !scrub.matches(':active')) {
      scrub.value = String((video.currentTime / video.duration) * 100);
    }
  });

  scrub?.addEventListener('input', () => {
    if (video.duration) video.currentTime = (Number(scrub.value) / 100) * video.duration;
  });

  muteBtn?.addEventListener('click', () => {
    video.muted = !video.muted;
    muteBtn.setAttribute('aria-pressed', String(video.muted));
    muteBtn.setAttribute('aria-label', video.muted ? 'Unmute' : 'Mute');
    const spk = muteBtn.querySelector('.reel__spk');
    if (spk) spk.textContent = video.muted ? 'OFF' : 'ON';
  });

  fullBtn?.addEventListener('click', () => {
    const frame = root.querySelector('.reel__frame') as HTMLElement | null;
    if (document.fullscreenElement) document.exitFullscreen();
    else frame?.requestFullscreen?.().catch(() => video.requestFullscreen?.());
  });

  // Keyboard: space and arrows once the player has focus.
  root.addEventListener('keydown', (e) => {
    const t = e.target as HTMLElement;
    if (t.tagName === 'INPUT') return;
    if (e.key === ' ' || e.key === 'k') {
      e.preventDefault();
      if (!root.dataset.playing) start();
      else if (video.paused) video.play();
      else video.pause();
    }
    if (e.key === 'ArrowRight') { e.preventDefault(); video.currentTime += 5; }
    if (e.key === 'ArrowLeft') { e.preventDefault(); video.currentTime -= 5; }
    if (e.key === 'm' && muteBtn) { e.preventDefault(); muteBtn.click(); }
  });
}

/* ---------------------------------------------------------------- loops -- */
let loopObserver: IntersectionObserver | null = null;

function wireLoops() {
  const tiles = document.querySelectorAll<HTMLElement>('[data-loop]');
  if (!tiles.length) return;

  const still = reduced();

  loopObserver?.disconnect();
  loopObserver = new IntersectionObserver(
    (entries) => {
      for (const entry of entries) {
        const video = entry.target.querySelector('video');
        if (!video) continue;
        if (entry.isIntersecting) {
          if (video.preload === 'none') video.preload = 'auto';
          if (!still) video.play().catch(() => {});
        } else {
          video.pause();
        }
      }
    },
    { rootMargin: '160px 0px', threshold: 0.15 },
  );

  tiles.forEach((tile) => {
    const btn = tile.querySelector<HTMLButtonElement>('[data-loop-play]');
    const video = tile.querySelector<HTMLVideoElement>('video');

    // Reduced motion: rest on the poster behind a real play control rather
    // than playing the same animation more slowly.
    if (still && btn && video) {
      btn.hidden = false;
      btn.addEventListener('click', () => {
        video.preload = 'auto';
        video.play().then(() => { btn.hidden = true; }).catch(() => {});
      }, { once: false });
    }

    loopObserver!.observe(tile);
  });
}

/* --------------------------------------------------------------- reveal -- */
let cutObserver: IntersectionObserver | null = null;

function wireCuts() {
  const items = document.querySelectorAll<HTMLElement>('[data-cut]');
  if (!items.length) return;

  if (reduced() || !('IntersectionObserver' in window)) {
    document.documentElement.classList.remove('cuts');
    items.forEach((el) => el.classList.add('is-cut'));
    return;
  }

  cutObserver?.disconnect();
  cutObserver = new IntersectionObserver(
    (entries, obs) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        const el = entry.target as HTMLElement;
        // Stagger within a group so a row lands one beat at a time.
        const delay = Number(el.dataset.cut) || 0;
        el.style.animationDelay = `${delay * 90}ms`;
        el.classList.add('is-cut');
        obs.unobserve(el);
      });
    },
    { rootMargin: '0px 0px -12% 0px', threshold: 0.1 },
  );

  items.forEach((el) => cutObserver!.observe(el));
}

/* ----------------------------------------------------------------- boot -- */
function boot() {
  document.querySelectorAll<HTMLElement>('[data-player]').forEach(wirePlayer);
  wireLoops();
  wireCuts();
}

boot();
document.addEventListener('astro:page-load', boot);

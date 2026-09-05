"""
Authors the placeholder motion pieces for the YNS NUR site.

Everything here is SYNTHETIC DEMONSTRATION MATERIAL, built at full fidelity in
the site's own visual grammar (flat saturated field, black cut-paper
silhouettes, staccato timing). It exists so the layout can be evaluated with
real motion in it. Every piece is labelled PLACEHOLDER in the interface and
listed in README.md for replacement with Younes's actual work.

No client name, brand, campaign or metric is depicted anywhere.

Renders frames with Pillow, encodes with ffmpeg.

    python scripts/make_placeholders.py            # everything
    python scripts/make_placeholders.py loops      # one group
"""
from __future__ import annotations

import math
import random
import shutil
import subprocess
import sys
from dataclasses import dataclass, field as dc_field
from pathlib import Path

from PIL import Image, ImageDraw

ROOT = Path(__file__).resolve().parent.parent
OUT = ROOT / "public" / "media" / "placeholder"
TMP = ROOT / ".tmp-frames"
FPS = 24
SS = 2  # supersample factor for anti-aliased cut-paper edges

# ---------------------------------------------------------------- palette --
INK = (20, 16, 14)
BONE = (237, 231, 218)
CARDINAL = (199, 67, 28)
OLIVE = (111, 115, 87)
MIDNIGHT = (51, 80, 95)
OCHRE = (198, 133, 43)


# ------------------------------------------------------------------ shapes --
def torn_rect(x, y, w, h, seed=0, bite=0.012):
    """A rectangle with a hand-cut edge — never mechanically straight."""
    rnd = random.Random(seed)
    j = lambda v: v + rnd.uniform(-bite, bite) * max(w, h)
    pts = []
    steps = 5
    for i in range(steps + 1):  # top
        pts.append((x + w * i / steps, j(y)))
    for i in range(steps + 1):  # right
        pts.append((j(x + w), y + h * i / steps))
    for i in range(steps + 1):  # bottom
        pts.append((x + w - w * i / steps, j(y + h)))
    for i in range(steps + 1):  # left
        pts.append((j(x), y + h - h * i / steps))
    return pts


def rot(pts, cx, cy, ang):
    c, s = math.cos(ang), math.sin(ang)
    return [((px - cx) * c - (py - cy) * s + cx, (px - cx) * s + (py - cy) * c + cy) for px, py in pts]


def arm(x, y, scale, ang=0.0, spread=1.0):
    """The reaching arm — the board's signature silhouette."""
    s = scale
    upper = [(0, 0), (2.10 * s, -0.26 * s), (2.16 * s, 0.30 * s), (0.06 * s, 0.62 * s)]
    pts = list(upper)
    base_x, base_y = 2.05 * s, 0.02 * s
    for i in range(5):
        a = (-0.52 + i * 0.27) * spread
        ln = (0.92 if i == 2 else 0.80 if i in (1, 3) else 0.58) * s
        wd = 0.085 * s
        tip = (base_x + math.cos(a) * ln, base_y + math.sin(a) * ln)
        nx, ny = -math.sin(a) * wd, math.cos(a) * wd
        pts += [(base_x + nx, base_y + ny), (tip[0] + nx, tip[1] + ny),
                (tip[0] - nx, tip[1] - ny), (base_x - nx, base_y - ny)]
    pts = [(px + x, py + y) for px, py in pts]
    return rot(pts, x, y, ang)


def cone(x, y, length, spread, ang):
    """A projector / spotlight cone."""
    p1 = (x + math.cos(ang - spread) * length, y + math.sin(ang - spread) * length)
    p2 = (x + math.cos(ang + spread) * length, y + math.sin(ang + spread) * length)
    return [(x, y), p1, p2]


def blade(cx, cy, r_in, r_out, a0, a1):
    """An annular wedge — the Orbit wheel segment."""
    pts = []
    steps = 14
    for i in range(steps + 1):
        a = a0 + (a1 - a0) * i / steps
        pts.append((cx + math.cos(a) * r_out, cy + math.sin(a) * r_out))
    for i in range(steps + 1):
        a = a1 + (a0 - a1) * i / steps
        pts.append((cx + math.cos(a) * r_in, cy + math.sin(a) * r_in))
    return pts


def wobble(pts, amp, seed=0, width=3.0):
    """Turn a polyline into a jittery hand-drawn stroke polygon."""
    rnd = random.Random(seed)
    up, down = [], []
    n = len(pts)
    for i, (px, py) in enumerate(pts):
        if i < n - 1:
            dx, dy = pts[i + 1][0] - px, pts[i + 1][1] - py
        else:
            dx, dy = px - pts[i - 1][0], py - pts[i - 1][1]
        ln = math.hypot(dx, dy) or 1
        nx, ny = -dy / ln * width, dx / ln * width
        jx, jy = rnd.uniform(-amp, amp), rnd.uniform(-amp, amp)
        up.append((px + nx + jx, py + ny + jy))
        down.append((px - nx + jx, py - ny + jy))
    return up + down[::-1]


# ------------------------------------------------------------------- scene --
@dataclass
class Layer:
    color: tuple
    polys: list = dc_field(default_factory=list)
    ellipses: list = dc_field(default_factory=list)


def beat(t, n):
    """Staccato time: hold, then jump. Bass cuts, he does not tween."""
    return math.floor(t * n) / n


def focus(w, h, fx=0.63, fy=0.46):
    """Off-centre focal point on wide frames. Square loops keep the mark
    centred — a 1:1 logo animation reads as a mark, not a composition."""
    return (w * fx, h * fy) if w / h > 1.25 else (w / 2, h / 2)


def render(w, h, field_color, layers):
    img = Image.new("RGB", (w, h), field_color)
    for lay in layers:
        if not lay.polys and not lay.ellipses:
            continue
        mask = Image.new("L", (w * SS, h * SS), 0)
        d = ImageDraw.Draw(mask)
        for poly in lay.polys:
            if len(poly) >= 3:
                d.polygon([(px * SS, py * SS) for px, py in poly], fill=255)
        for (x0, y0, x1, y1) in lay.ellipses:
            d.ellipse([x0 * SS, y0 * SS, x1 * SS, y1 * SS], fill=255)
        mask = mask.resize((w, h), Image.LANCZOS)
        img.paste(Image.new("RGB", (w, h), lay.color), (0, 0), mask)
    return img


# ------------------------------------------------------------------ scenes --
# Each scene is f(t, w, h, accent) -> (field_color, [Layer, ...]) with t in [0,1).
# Loop-safe scenes return identical state at t=0 and t=1.

def sc_reach(t, w, h, accent):
    b = beat(t, 8)
    ax = -0.15 * w + b * 0.55 * w
    ang = -0.22 + 0.30 * math.sin(b * math.pi * 2)
    sun_r = h * (0.14 + 0.05 * (b > 0.5))
    cx, cy = w * 0.74, h * (0.62 - 0.18 * b)
    ink = Layer(INK, polys=[arm(ax, h * 0.44, h * 0.30, ang, 1.0 + 0.25 * math.sin(b * 6))])
    ink.polys.append(torn_rect(0, h * 0.86, w, h * 0.16, seed=3, bite=0.02))
    acc = Layer(accent, ellipses=[(cx - sun_r, cy - sun_r, cx + sun_r, cy + sun_r)])
    return None, [acc, ink]


def sc_city(t, w, h, accent):
    b = beat(t, 12)
    ink = Layer(INK)
    n = 9
    rnd = random.Random(7)
    for i in range(n):
        peak = rnd.uniform(0.20, 0.62)
        grow = min(1.0, max(0.0, (b * n - i) / 1.6))
        bh = h * peak * grow
        bw = w / n * 0.78
        bx = w * 0.06 + i * (w * 0.88 / n)
        if bh > 4:
            ink.polys.append(torn_rect(bx, h * 0.90 - bh, bw, bh, seed=i, bite=0.02))
    ink.polys.append(torn_rect(-w * 0.02, h * 0.88, w * 1.04, h * 0.16, seed=99, bite=0.015))
    acc = Layer(accent, polys=[cone(w * 0.90, h * 0.10, w * 0.9, 0.16, 2.5 + 0.35 * math.sin(b * 3))])
    return None, [acc, ink]


def sc_eye(t, w, h, accent):
    b = beat(t, 6)
    cx, cy = focus(w, h)
    r = min(w, h) * 0.40
    ink = Layer(INK, polys=[blade(cx, cy, r * 0.62, r, 0, math.pi * 2)])
    ir = r * (0.30 + 0.16 * math.sin(b * math.pi * 2))
    ink.ellipses.append((cx - ir, cy - ir, cx + ir, cy + ir))
    acc = Layer(accent)
    off = r * 0.20 * math.cos(b * math.pi * 2)
    acc.ellipses.append((cx + off - ir * 0.42, cy - ir * 0.42, cx + off + ir * 0.42, cy + ir * 0.42))
    return None, [ink, acc]


def sc_split(t, w, h, accent):
    """The field splits and holds the gap open. The gap is the whole idea, so
    the slabs must never close over the field entirely."""
    b = beat(t, 4)
    gap = w * 0.09 * b
    ink = Layer(INK, polys=[
        torn_rect(-w * 0.04 - gap, -h * 0.02, w * 0.46, h * 1.04, seed=1, bite=0.012),
        torn_rect(w * 0.58 + gap, -h * 0.02, w * 0.46, h * 1.04, seed=2, bite=0.012),
    ])
    acc = Layer(accent, polys=[torn_rect(w * 0.445, h * 0.16, w * 0.11, h * 0.68, seed=5, bite=0.03)])
    return None, [acc, ink]


def sc_spin(t, w, h, accent):
    steps = 8
    a = beat(t, steps) * math.pi * 2
    cx, cy = focus(w, h)
    r = min(w, h) * 0.36
    ink = Layer(INK)
    for i in range(3):
        a0 = a + i * math.pi * 2 / 3
        ink.polys.append(blade(cx, cy, r * 0.34, r, a0, a0 + 0.62))
    acc = Layer(accent, ellipses=[(cx - r * 0.16, cy - r * 0.16, cx + r * 0.16, cy + r * 0.16)])
    return None, [ink, acc]


def sc_stack(t, w, h, accent):
    n = 6
    b = beat(t, n)
    ink = Layer(INK)
    for i in range(n):
        if b * n >= i:
            bh = h * 0.11
            ink.polys.append(torn_rect(w * (0.20 + 0.02 * i), h * 0.80 - i * bh * 1.06,
                                       w * (0.60 - 0.04 * i), bh, seed=i, bite=0.02))
    acc = Layer(accent, polys=[torn_rect(w * 0.16, h * 0.86, w * 0.68, h * 0.035, seed=8, bite=0.02)])
    return None, [acc, ink]


def sc_aperture(t, w, h, accent):
    n = 6
    a = beat(t, 12)
    open_amt = 0.5 - 0.5 * math.cos(a * math.pi * 2)
    cx, cy = focus(w, h)
    r = min(w, h) * 0.46
    ink = Layer(INK)
    for i in range(n):
        a0 = i * math.pi * 2 / n
        inner = r * (0.14 + 0.52 * open_amt)
        ink.polys.append(blade(cx, cy, inner, r, a0 + 0.06, a0 + math.pi * 2 / n - 0.06))
    acc = Layer(accent, ellipses=[(cx - r * 0.09, cy - r * 0.09, cx + r * 0.09, cy + r * 0.09)])
    return None, [acc, ink]


def sc_wave(t, w, h, accent):
    n = 11
    ink = Layer(INK)
    for i in range(n):
        ph = (t * math.pi * 2) + i * 0.55
        bh = h * (0.16 + 0.26 * (0.5 + 0.5 * math.sin(ph)))
        bw = w / n * 0.62
        bx = w * 0.06 + i * (w * 0.88 / n)
        ink.polys.append(torn_rect(bx, h / 2 - bh / 2, bw, bh, seed=i, bite=0.03))
    acc = Layer(accent, polys=[torn_rect(0, h * 0.495, w, h * 0.01, seed=4, bite=0.004)])
    return None, [acc, ink]


def sc_arrows(t, w, h, accent):
    """A diagonal march, one arrow dominant — never an evenly spaced row."""
    ink = Layer(INK, polys=[torn_rect(-w * 0.02, h * 0.74, w * 1.04, h * 0.30, seed=11, bite=0.02)])
    n = 4
    for i in range(n):
        x = ((t + i / n) % 1.0) * (w * 1.3) - w * 0.15
        s = h * (0.30 if i == 1 else 0.13 - 0.02 * i)
        y = h * (0.30 + 0.10 * i)
        pts = [(x, y - s), (x + s * 1.15, y), (x, y + s), (x + s * 0.32, y)]
        ink.polys.append(pts)
    acc = Layer(accent, polys=[torn_rect(w * 0.06, h * 0.82, w * 0.88 * ((t * 1.0) % 1.0), h * 0.05, seed=6, bite=0.01)])
    return None, [acc, ink]


def sc_barload(t, w, h, accent):
    steps = 10
    p = beat(t, steps)
    top = h * 0.34  # sits high, not centred; the empty lower field is the point
    ink = Layer(INK, polys=[
        torn_rect(w * 0.10, top, w * 0.62, h * 0.09, seed=2, bite=0.006),
        torn_rect(w * 0.80, h * 0.52, w * 0.24, h * 0.52, seed=13, bite=0.02),
    ])
    acc = Layer(accent, polys=[torn_rect(w * 0.108, top + h * 0.008, w * 0.604 * p, h * 0.074, seed=3, bite=0.008)])
    tick = Layer(INK)
    for i in range(steps + 1):
        x = w * 0.10 + w * 0.62 * i / steps
        tick.polys.append(torn_rect(x - w * 0.0015, top + h * 0.11, w * 0.003, h * 0.03, seed=i, bite=0.0))
    return None, [ink, acc, tick]


def sc_menu(t, w, h, accent):
    b = beat(t, 8)
    k = 0.5 - 0.5 * math.cos(b * math.pi * 2)
    cx, cy = w * 0.36, h * 0.46  # off-centre, weight to the left
    sp = h * 0.16
    ink = Layer(INK, polys=[torn_rect(w * 0.78, -h * 0.02, w * 0.26, h * 1.04, seed=12, bite=0.012)])
    for i, sign in enumerate((-1, 0, 1)):
        ang = k * (math.pi / 4) * (1 if sign < 0 else -1 if sign > 0 else 0)
        y = cy + sign * sp * (1 - k)
        bar = torn_rect(cx - w * 0.22, y - h * 0.028, w * 0.44, h * 0.056, seed=i, bite=0.01)
        if sign == 0:
            bar = bar if k < 0.5 else []
        else:
            bar = rot(bar, cx, y, ang)
        if bar:
            ink.polys.append(bar)
    acc = Layer(accent, polys=[torn_rect(cx - w * 0.20, cy + h * 0.22, w * 0.40 * (1 - k), h * 0.012, seed=9, bite=0.01)])
    return None, [acc, ink]


def sc_wheel(t, w, h, accent):
    """The Orbit radial command wheel — segments lighting in sequence."""
    n = 8
    cx, cy = focus(w, h)
    r = min(w, h) * 0.38
    sel = int(beat(t, n) * n) % n
    ink = Layer(INK)
    acc = Layer(accent)
    for i in range(n):
        a0 = i * math.pi * 2 / n + 0.03
        a1 = (i + 1) * math.pi * 2 / n - 0.03
        seg = blade(cx, cy, r * 0.40, r * (1.10 if i == sel else 1.0), a0, a1)
        (acc if i == sel else ink).polys.append(seg)
    ink.ellipses.append((cx - r * 0.16, cy - r * 0.16, cx + r * 0.16, cy + r * 0.16))
    return None, [ink, acc]


def sc_cursor(t, w, h, accent):
    b = beat(t, 10)
    x = w * (0.22 + 0.5 * (0.5 - 0.5 * math.cos(b * math.pi * 2)))
    y = h * (0.30 + 0.34 * abs(math.sin(b * math.pi * 3)))
    s = h * 0.11
    ink = Layer(INK, polys=[
        torn_rect(w * 0.08, h * 0.10, w * 0.84, h * 0.10, seed=1, bite=0.006),
        [(x, y), (x + s * 0.62, y + s * 0.86), (x + s * 0.26, y + s * 0.82), (x + s * 0.12, y + s * 1.16)],
    ])
    ring = (t * 3) % 1.0
    rr = s * (0.3 + ring * 1.4)
    acc = Layer(accent, polys=[blade(x, y, rr * 0.82, rr, 0, math.pi * 2)])
    return None, [acc, ink]


SCENES = {
    "reach": sc_reach, "city": sc_city, "eye": sc_eye, "split": sc_split,
    "spin": sc_spin, "stack": sc_stack, "aperture": sc_aperture, "wave": sc_wave,
    "arrows": sc_arrows, "barload": sc_barload, "menu": sc_menu,
    "wheel": sc_wheel, "cursor": sc_cursor,
}


# ------------------------------------------------------------------- clips --
@dataclass
class Clip:
    group: str
    name: str
    scene: str
    w: int
    h: int
    seconds: float
    field: tuple
    accent: tuple


CLIPS = [
    # Horizontal motion graphics — 16:9, the deliberate watch.
    Clip("horizontal", "reach-out", "reach", 1920, 1080, 6, CARDINAL, BONE),
    Clip("horizontal", "skyline-build", "city", 1920, 1080, 6, MIDNIGHT, OCHRE),
    Clip("horizontal", "hard-split", "split", 1920, 1080, 5, BONE, CARDINAL),
    Clip("horizontal", "the-witness", "eye", 1920, 1080, 5, OLIVE, BONE),
    Clip("horizontal", "stack-argument", "stack", 1920, 1080, 6, BONE, CARDINAL),
    Clip("horizontal", "long-wave", "wave", 1920, 1080, 5, INK, CARDINAL),

    # Square loops — 1080x1080, silent, endless.
    Clip("loops", "orbit-mark", "spin", 1080, 1080, 3, CARDINAL, BONE),
    Clip("loops", "aperture-lock", "aperture", 1080, 1080, 3, INK, CARDINAL),
    Clip("loops", "pulse-eye", "eye", 1080, 1080, 3, OCHRE, INK),
    Clip("loops", "wave-form", "wave", 1080, 1080, 3, MIDNIGHT, BONE),
    Clip("loops", "stack-build", "stack", 1080, 1080, 3, BONE, CARDINAL),
    Clip("loops", "spin-cut", "spin", 1080, 1080, 3, OLIVE, BONE),
    Clip("loops", "shutter-pass", "aperture", 1080, 1080, 3, BONE, MIDNIGHT),
    Clip("loops", "signal-run", "arrows", 1080, 1080, 3, CARDINAL, INK),
    Clip("loops", "split-mark", "split", 1080, 1080, 3, MIDNIGHT, OCHRE),
    Clip("loops", "hand-off", "reach", 1080, 1080, 4, OLIVE, BONE),
    Clip("loops", "wheel-turn", "wheel", 1080, 1080, 4, INK, OCHRE),
    Clip("loops", "rise-fall", "city", 1080, 1080, 4, BONE, INK),

    # Web / interaction animation — captures of animation that shipped in a site.
    Clip("web", "ring-preloader", "aperture", 1600, 1000, 4, INK, CARDINAL),
    Clip("web", "progress-reveal", "barload", 1600, 1000, 4, BONE, CARDINAL),
    Clip("web", "menu-overlay", "menu", 1600, 1000, 4, CARDINAL, BONE),
    Clip("web", "section-transition", "arrows", 1600, 1000, 4, MIDNIGHT, OCHRE),

    # Plugins — the tool doing its job.
    Clip("plugins", "radial-wheel", "wheel", 1600, 1000, 5, INK, CARDINAL),
    Clip("plugins", "stagger-tool", "wave", 1600, 1000, 4, INK, OCHRE),
    Clip("plugins", "curve-tool", "cursor", 1600, 1000, 5, INK, CARDINAL),
    Clip("plugins", "plate-tool", "stack", 1600, 1000, 4, INK, BONE),
]


def encode(clip: Clip):
    frames = int(clip.seconds * FPS)
    work = TMP / f"{clip.group}-{clip.name}"
    if work.exists():
        shutil.rmtree(work)
    work.mkdir(parents=True)

    scene = SCENES[clip.scene]
    for i in range(frames):
        t = i / frames  # [0,1) — loop-safe
        _, layers = scene(t, clip.w, clip.h, clip.accent)
        img = render(clip.w, clip.h, clip.field, layers)
        img.save(work / f"{i:04d}.png", compress_level=1)

    dest = OUT / clip.group
    dest.mkdir(parents=True, exist_ok=True)
    mp4 = dest / f"{clip.name}.mp4"
    poster = dest / f"{clip.name}.webp"

    subprocess.run([
        "ffmpeg", "-y", "-loglevel", "error", "-framerate", str(FPS),
        "-i", str(work / "%04d.png"),
        "-c:v", "libx264", "-preset", "slow", "-crf", "26",
        "-pix_fmt", "yuv420p", "-movflags", "+faststart",
        "-vf", "scale=trunc(iw/2)*2:trunc(ih/2)*2",
        "-an", str(mp4),
    ], check=True)

    # Poster comes from a mid frame: frame 0 is usually the emptiest state and
    # would sell the piece short before it plays.
    key = work / f"{int(frames * 0.42):04d}.png"
    subprocess.run([
        "ffmpeg", "-y", "-loglevel", "error", "-i", str(key),
        "-vf", "scale=960:-2", "-quality", "72", str(poster),
    ], check=True)

    shutil.rmtree(work)
    kb = mp4.stat().st_size / 1024
    print(f"  {clip.group}/{clip.name}.mp4  {clip.w}x{clip.h}  {frames}f  {kb:.0f} kB")


def main():
    only = sys.argv[1] if len(sys.argv) > 1 else None
    TMP.mkdir(exist_ok=True)
    todo = [c for c in CLIPS if not only or c.group == only or c.name == only]
    print(f"rendering {len(todo)} placeholder clips\n")
    for clip in todo:
        encode(clip)
    if TMP.exists():
        shutil.rmtree(TMP, ignore_errors=True)
    print(f"\ndone — {len(todo)} clips in {OUT}")


if __name__ == "__main__":
    main()

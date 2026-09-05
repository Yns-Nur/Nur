/**
 * Prefix a root-relative path with the site's base path.
 *
 * The site is written as if it lived at `/`, because that is how it reads. On
 * GitHub Pages it may instead be served from `/<repo>/`, and every `/contact`
 * or `/media/...` in the source would then point one level too high. Astro
 * hands us the deployed base in `import.meta.env.BASE_URL`; this is the single
 * place that applies it, so a subpath deploy is a config change and not a
 * find-and-replace across the site.
 *
 * Anything that is not a root-relative path — a full URL, a hash, a mailto —
 * is returned untouched.
 */
export function withBase(path: string): string {
  if (!path.startsWith('/')) return path;
  const base = import.meta.env.BASE_URL.replace(/\/$/, '');
  return base + path;
}

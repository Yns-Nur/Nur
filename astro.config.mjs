import { defineConfig } from 'astro/config';
import sitemap from '@astrojs/sitemap';

// Where the site will live. Both values are supplied by the GitHub Actions
// deploy (see .github/workflows/deploy.yml), which reads them from the repo's
// own Pages settings — so the same source builds correctly whether it is
// served from https://<user>.github.io/ or https://<user>.github.io/<repo>/
// without anyone editing this file. The fallbacks keep local builds honest.
const site = process.env.SITE_URL || 'https://yns-nur.example';
const base = process.env.BASE_PATH || '/';

export default defineConfig({
  site,
  base,
  trailingSlash: 'ignore',
  integrations: [sitemap()],
  build: { inlineStylesheets: 'auto' },
  vite: {
    build: {
      // Placeholder media is committed; never inline it into the JS bundle.
      assetsInlineLimit: 0,
    },
  },
});

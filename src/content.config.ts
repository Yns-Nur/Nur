import { defineCollection, z } from 'astro:content';
import { glob } from 'astro/loaders';

/**
 * Every piece of work carries its own media descriptor. `placeholder: true`
 * means the media is authored demonstration material, not Younes's work — the
 * interface renders a visible mark for it and README.md lists it for
 * replacement. Setting `embed` moves a single piece to a streaming host
 * without touching any layout.
 */
const media = z.object({
  src: z.string().optional(),
  poster: z.string(),
  embed: z.string().url().optional(),
  width: z.number(),
  height: z.number(),
});

const base = {
  title: z.string(),
  order: z.number(),
  year: z.number(),
  placeholder: z.boolean().default(true),
  media,
};

const horizontal = defineCollection({
  loader: glob({ base: './src/content/horizontal', pattern: '**/*.md' }),
  schema: z.object({
    ...base,
    /** Runtime as it would be delivered, e.g. "00:42". */
    duration: z.string(),
    ratio: z.string().default('16:9'),
    role: z.string(),
    tools: z.array(z.string()),
    /** Deliberately never a client name — none are on hand. */
    kind: z.string(),
    sound: z.boolean().default(false),
  }),
});

const loops = defineCollection({
  loader: glob({ base: './src/content/loops', pattern: '**/*.md' }),
  schema: z.object({
    ...base,
    duration: z.string(),
    ratio: z.string().default('1:1'),
    kind: z.string(),
  }),
});

const web = defineCollection({
  loader: glob({ base: './src/content/web', pattern: '**/*.md' }),
  schema: z.object({
    ...base,
    /** Which part of the site the animation is, e.g. "Preloader". */
    part: z.string(),
    /** How it shipped to the developers. */
    handoff: z.enum(['Lottie', 'Rive', 'CSS', 'WebGL']),
    duration: z.string(),
    ratio: z.string().default('16:10'),
    /** No live URL is on hand for any piece; the field stays absent. */
    url: z.string().url().optional(),
  }),
});

const plugins = defineCollection({
  loader: glob({ base: './src/content/plugins', pattern: '**/*.md' }),
  schema: z.object({
    title: z.string(),
    order: z.number(),
    tagline: z.string(),
    /** Mixed distribution — the page renders all three without breaking. */
    state: z.enum(['free', 'paid', 'unreleased']),
    price: z.string().optional(),
    downloadUrl: z.string().url().optional(),
    storeUrl: z.string().url().optional(),
    host: z.string().default('After Effects'),
    version: z.string().optional(),
    /** false only for Orbit, which exists. */
    placeholder: z.boolean().default(true),
    features: z.array(z.object({ title: z.string(), body: z.string() })),
    install: z.array(z.string()).default([]),
    media,
  }),
});

export const collections = { horizontal, loops, web, plugins };

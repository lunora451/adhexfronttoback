import { defineCollection } from 'astro:content';
import { glob } from 'astro/loaders';

const catta = defineCollection({
  loader: glob({ pattern: '**/*.md', base: './src/data/catta' }),
});

export const collections = { catta };
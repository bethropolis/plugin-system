import { defineConfig } from 'astro/config';
import tailwind from "@astrojs/tailwind";
import sitemap from "@astrojs/sitemap";

import mdx from "@astrojs/mdx";

// https://astro.build/config
export default defineConfig({
  site: "https://bethropolis.github.io",
  base: '/plugin-system',
  integrations: [tailwind(), mdx(), sitemap()]
});
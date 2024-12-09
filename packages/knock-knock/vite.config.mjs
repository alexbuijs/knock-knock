import legacy from "@vitejs/plugin-legacy";
import react from "@vitejs/plugin-react";
import { purgeCSSPlugin } from "@fullhuman/postcss-purgecss";
import autoprefixer from "autoprefixer";
import { defineConfig } from "vite";

export default defineConfig({
  build: {
    manifest: true,
    rollupOptions: {
      input: {
        main: "assets/js/main.js",
        admin: "assets/js/admin.js",
        profile: "assets/js/profile.jsx",
      },
      watch: {
        include: "assets/js/**",
      },
    },
  },
  esbuild: {
    loader: "jsx",
  },
  server: {
    host: true,
    proxy: {
      "^/$": {
        target: "http://localhost:8080",
        changeOrigin: false,
      },
    },
  },
  css: {
    preprocessorOptions: {
      scss: {
        quietDeps: true,
      },
    },
    postcss: {
      plugins: [
        purgeCSSPlugin({
          content: ["views/**/*.twig", "assets/js/**/*.jsx"],
          safelist: {
            standard: [/show/, /active/],
            deep: [/^alert/, /^navbar/, /file/, /tooltip/, /^d-/, /^dropdown/],
            greedy: [/collaps/],
          },
        }),
        autoprefixer(),
      ],
    },
  },
  plugins: [
    react(),
    legacy({
      targets: ["defaults"],
    }),
  ],
});

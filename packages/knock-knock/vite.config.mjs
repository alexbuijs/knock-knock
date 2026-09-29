import legacy from "@vitejs/plugin-legacy";
import react from "@vitejs/plugin-react";
import purgecss from "@fullhuman/postcss-purgecss";
import autoprefixer from "autoprefixer";
import { defineConfig } from "vite";

export default defineConfig(() => ({
  base: "./",
  resolve: {
    // Dependencies are hoisted outside this workspace, so force a single React runtime.
    dedupe: ["react", "react-dom"],
  },
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
  server: {
    host: true,
    proxy: {
      "^/$": {
        target: "http://localhost:8080",
        changeOrigin: false,
      },
    },
    allowedHosts: ["host.docker.internal"],
  },
  css: {
    preprocessorOptions: {
      scss: {
        quietDeps: true,
      },
    },
    postcss: {
      plugins: [
        purgecss({
          content: ["views/**/*.twig", "assets/js/**/*.jsx"],
          safelist: {
            standard: [/show/, /active/],
            deep: [
              /^alert/,
              /^navbar/,
              /file/,
              /tooltip/,
              /^d-/,
              /^dropdown/,
              /^rdp/,
            ],
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
}));

import tailwindcss from "@tailwindcss/vite";

export default defineNuxtConfig({
  modules: ["@nuxt/ui"],
  compatibilityDate: "2024-11-01",
  devtools: { enabled: true },
  routeRules: {
    "/": { redirect: "/buku" },
    "/buku/edit/**": { ssr: true },
  },
  css: ["~/assets/css/main.css", "vue-toast-notification/dist/theme-sugar.css"],
  vite: {
    plugins: [tailwindcss()],
  },
});

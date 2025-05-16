import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    server: {
        host: "0.0.0.0", // Important to listen on all interfaces
        port: 5173,
        strictPort: true,
        hmr: {
            host: "localhost", // or your docker host IP (your machine IP or `localhost` for dev)
        },
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
});

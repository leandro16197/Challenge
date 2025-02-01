import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // Si tienes un archivo CSS
                'resources/js/app.js',   // Tu archivo JS
                'resources/scss/app.scss', // Tu archivo SCSS principal
            ],
            refresh: true,
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
               
                additionalData: `@import "./resources/scss/variables.scss";`, 
            },
        },
    },
});

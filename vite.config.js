import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/chart.js'],
            refresh: true,
        }),
    ],server: {
        // Tambahkan konfigurasi CORS
        headers: {
          'Access-Control-Allow-Origin': '*',
          'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, PATCH, OPTIONS',
          'Access-Control-Allow-Headers': 'X-Requested-With, content-type, Authorization',
        },
        // Jika menggunakan HTTPS lokal (opsional) // Nonaktifkan HTTPS jika tidak diperlukan
      },
});

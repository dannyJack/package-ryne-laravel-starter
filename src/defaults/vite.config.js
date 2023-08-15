import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import dotenv from 'dotenv';

dotenv.config();

var viteConfig = {
    plugins: [
        laravel({
            input: ['resources/css/compile.css', 'resources/js/compile.js'],
            refresh: true
        })
    ],
    server: {
        host: '0.0.0.0',
        port: process.env.VITE_SERVER_PORT
    }
};

if (process.env.VITE_LOCAL_IP) {
    viteConfig['server']['hmr'] = {
        host: process.env.VITE_LOCAL_IP,
        clientPort: process.env.VITE_SERVER_PORT
    };
}

export default defineConfig(viteConfig);
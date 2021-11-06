const mix = require('laravel-mix');
const path = require('path')

mix.js('resources/src/main.js', 'public/js')
    .vue()
    .extract(['vue'])

if (mix.inProduction()) {
    mix.version();
}

mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/')
        }
    }
});

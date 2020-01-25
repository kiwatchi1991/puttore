const mix = require('laravel-mix');
const path = require('path');
require('laravel-mix-eslint');
require('laravel-mix-stylelint');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

const styleLintPlugin = require('stylelint-webpack-plugin');
mix.webpackConfig({
    plugins: [
        new styleLintPlugin({
            files: ['**/*.scss'],
            configFile: path.join(__dirname, '.stylelintrc.js'),
            syntax: 'scss'
        })
    ]
}).eslint();

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .browserSync({
        files: [
            'resources/views/**/*.blade.php',
            'public/**/*.*',
            'routes/**/*.php',
            '**/*.php',
            '**/*.js',
            '**/*.vue'
        ],
        proxy: {
            target: 'http://127.0.0.1:8000/'
        }
    });

const mix = require('laravel-mix');
const lodash = require('lodash');

const src = 'resources/',
    public = 'public/';

const folder = {
    src: {
        font: src + 'fonts',
        image: src + 'images',
        scss: src + 'scss/',
        js: src + 'js/',
    },
    public: {
        font: public + 'fonts',
        image: public + 'images',
        css: public + 'css/',
        js: public + 'js/'
    }
};

const tinymce = {
    src: 'node_modules/tinymce/',
    public: folder.public.js + '/plugins/tinymce/'
};

mix.copyDirectory(folder.src.font, folder.public.font)
    .copyDirectory(folder.src.image, folder.public.image);

mix.copyDirectory(tinymce.src + 'icons', tinymce.public + 'icons')
    .copyDirectory(tinymce.src + 'plugins', tinymce.public + 'plugins')
    .copyDirectory(tinymce.src + 'skins', tinymce.public + 'skins')
    .copyDirectory(tinymce.src + 'themes', tinymce.public + 'themes');

mix.copy(tinymce.src + 'tinymce.min.js', tinymce.public + 'tinymce.min.js');

mix.sass(folder.src.scss + 'icons.scss', folder.public.css).minify(folder.public.css + 'icons.css')
    .sass(folder.src.scss + 'app-rtl.scss', folder.public.css).minify(folder.public.css + 'app-rtl.css')
    .sass(folder.src.scss + 'app.scss', folder.public.css ).minify(folder.public.css + 'app.css')
    .sass(folder.src.scss + 'app-dark.scss', folder.public.css).minify(folder.public.css + 'app-dark.css')
    .sass(folder.src.scss + 'nova.scss', folder.public.css).minify(folder.public.css + 'nova.css')
    .sass(folder.src.scss + 'frontend.scss', folder.public.css).minify(folder.public.css + 'frontend.css');

mix.js(folder.src.js + 'nova.js', folder.public.js);
mix.js(folder.src.js + 'frontend.js', folder.public.js).version();
mix.js(folder.src.js + 'backend.js', folder.public.js).version();

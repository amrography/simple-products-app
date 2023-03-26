const mix = require("laravel-mix");
require("laravel-mix-tailwind");

mix.js("resources/js/app.ts", "assets").vue();

mix.css("resources/css/app.css", "assets").tailwind();

mix.setPublicPath("public");

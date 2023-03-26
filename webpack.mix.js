const mix = require("laravel-mix");

mix.js("resources/js/app.ts", "assets").vue();

mix.css("resources/css/app.css", "assets").setPublicPath("public");

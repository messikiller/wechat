<?php
function translate($path, $seperator = '.')
{
    // $locale = App()->getLocale();

    $app = App();
    $locale = $app['config']['app.locale'];

    list($file, $key) = explode('.', $path);

    $result = require(resource_path("lang/{$locale}/{$file}.php"));

    return empty($result[$key]) ? '' : $result[$key];
}

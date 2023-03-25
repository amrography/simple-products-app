<?php

if (! function_exists('dump') ) {
    /**
     * Debug and die
     *
     * @param $key
     * @return void
     */
    function dump(...$keys): void {
        foreach ($keys as $key) {
            echo "<pre style='background: lightyellow; padding: 10px; font-size:16px;'>";
            var_dump($key);
            echo "</pre>";
        }
    }
}

if (! function_exists('dd') ) {
    /**
     * Debug and die
     *
     * @param $key
     * @return void
     */
    function dd(...$keys): void {
        dump(...$keys);

        die;
    }
}

if (! function_exists('base_path') ) {
    /**
     * Get base path of project
     *
     * @param string $key
     * @return string
     */
    function base_path(string $key = null): string {
        return __DIR__ . ($key ? "/{$key}" : "");
    }
}

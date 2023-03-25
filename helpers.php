<?php

if (! function_exists('dd') ) {
    /**
     * Debug and die
     *
     * @param $key
     * @return void
     */
    function dd(...$keys): void {
        foreach ($keys as $key) {
            var_dump($key);
        }

        die;
    }
}

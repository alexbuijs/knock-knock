<?php
/**
 * Global functions
 */

if (! function_exists('asset')) {
    function asset(...$args)
    {
        return App\asset(...$args);
    }
}
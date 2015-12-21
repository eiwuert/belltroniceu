<?php

// Adaptation for the App Engine PHP runtime
// Add the gethostname function if it does not exist
if (!function_exists('gethostname')) {
    function gethostname() {
        return php_uname('n');
    }
}
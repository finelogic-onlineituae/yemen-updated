<?php
use Illuminate\Support\Facades\URL;

if (! function_exists('generate_signed_storage_url')) {
    function generate_signed_storage_url(string $path, int $minutes = 20): string
    {
        return URL::temporarySignedRoute(
            'secure.pdf',
            now()->addMinutes($minutes),
            ['path' => $path]
        );
    }
}

if (!function_exists('obfuscate_id')) {
    function obfuscate_id($id, $salt = 'X9X') {
        $mixed = strrev($id . $salt); // Reverse with salt
        return bin2hex($mixed);       // Convert to hex
    }
}

if (!function_exists('deobfuscate_id')) {
    function deobfuscate_id($hash, $salt = 'X9X') {
        $reversed = strrev(hex2bin($hash));
        return str_replace($salt, '', $reversed);
    }
}

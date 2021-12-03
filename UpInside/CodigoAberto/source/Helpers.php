<?php

/**
 * 
 * @param string|null $param
 * @return string
 */
function site(string $param = null): string {
    if ($param && !empty(SITE[$param])) {
        return SITE[$param];
    }
    return SITE["root"];
}

/**
 * 
 * @param string $imageUrl
 * @return string
 */
function routeImage(string $imageUrl): string
{
    return "https://via.palceholder.com/1200x628/0984e3/FFFFFF?text={$imageUrl}";
}

/**
 * 
 * @param string $path
 * @param bool $time
 * @return string
 */
function asset(string $path, $time = true): string
{
    $file = SITE["root"] . "/views/assets{$path}";
    $fileOnDir = dirname(__DIR__, 1) . "/views/assets/{$path}";
    
    if($time && file_exists($fileOnDir)){
        $file .= "?time=" . filemtime($fileOnDir);
    }
    return $file;
    
}

function flash(string $type = null, string $message = null): ?string 
{
    if ($type && $message) {
        $_SESSION["flash"] = [
            "type" => $type,
            "message" => $message
        ];

        return null;
    }

    if (!empty($_SESSION["flash"]) && $flash = $_SESSION["flash"]) 
    {
        unset($_SESSION["flash"]);
        return "<div class=\"message {$flash["type"]}\>{$flash["message"]}</div>";
    }
    
    return null;
}

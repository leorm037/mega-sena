<?php

/** @return void */
function error(): void
{
    if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
        ini_set("display_errors", 1);
        ini_set("error_reporting", E_ALL);
        ini_set('xdebug.overload_var_dump', 1);
    } else {
        ini_set("display_errors", 0);
        ini_set("error_reporting", E_ERROR);
        ini_set('xdebug.overload_var_dump', 0);
    }
}

/**
 * ###############
 * ###   URL   ###
 * ###############
 */

/**
 * 
 * @param string $path
 * @return string
 */
function url(string $path = null): string
{
    if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
        if ($path) {
            return CONF_URL_BASE_DEV . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }

        return CONF_URL_BASE_DEV;
    }

    if ($path) {
        return CONF_URL_BASE . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return CONF_URL_BASE;
}

function url_back(): string
{
    return ($_SERVER['HTTP_REFERER'] ?? url());
}

function theme(string $path = null): string
{
    if(strpos($_SERVER['HTTP_HOST'], 'localhost') !== false){
        if($path){
            return CONF_URL_BASE_DEV . "/themes/" . CONF_VIEW_THEME . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }
        return CONF_URL_BASE_DEV . "/themes/" . CONF_VIEW_THEME;
    }
    
    if($path) {
        return CONF_URL_BASE . "/themes/" . CONF_VIEW_THEME . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }
    
    return CONF_URL_BASE . "/themes/" . CONF_VIEW_THEME;
}

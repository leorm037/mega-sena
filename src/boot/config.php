<?php

/**
 * #######################
 * ###   PROJECT URL   ###
 * #######################
 */

define("CONF_URL_BASE_DEV", "http://localhost/mega-sena");
define("CONF_URL_BASE", "http://" . $_SERVER['HTTP_HOST'] . "/mega-sena");


/**
 * ################
 * ###   VIEW   ###
 * ################
 */

define("CONF_VIEW_PATH", __DIR__ . "/../../themes");
define("CONF_VIEW_EXT", "php");
define("CONF_VIEW_THEME", "mega-sena");


define("CONF_DB_HOST", "localhost");
define("CONF_DB_NAME", "megasena");
define("CONF_DB_USER", "megasena");
define("CONF_DB_PASS", "megasena");

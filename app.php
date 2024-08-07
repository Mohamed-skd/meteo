<?php
// CONFIGS 
define("SITE", "/");
define("SITE_SRC", $_SERVER["DOCUMENT_ROOT"] . SITE);
define("SITE_LINK", "https://mohsd-meteo.rf.gd" . SITE);
define("VENDOR", SITE_SRC . "vendor/");
define("STORAGE", SITE_SRC . "storage/");
define("PUBLIC_SRC", SITE_SRC . "public/");
define("CMPS", PUBLIC_SRC . "components/");
define("PUBLIC_LINK", SITE_LINK . "public/");

require_once VENDOR . "autoload.php";
session_start();

// UTILS
$base = new Util\Base();
$serverFn = new Util\Func\Server();
$fileFn = new Util\Func\File();
$dateFn = new Util\Func\Date();
$templFn = new Util\Func\Templ();
$strFn = new Util\Func\Str();
$envDatas = $fileFn->getEnv();

// APP
// html head 
$headStyle = PUBLIC_LINK . "assets/style.css";
$headScript = PUBLIC_LINK . "assets/script.js";
$headDesc = "";
$headIcon = PUBLIC_LINK . "imgs/icon.png";

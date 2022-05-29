<?php
// Если закомментировать эту константу, то будет использован, на коленке собранный, простой автозагрузчик
//const AUTOLOAD = 'composer';

if (defined ('AUTOLOAD') && AUTOLOAD=== 'composer') {
    require_once __DIR__ . '/vendor/autoload.php';
}
else {
    require_once __DIR__ . '/simple_autoload.php';  // Пока не реализован
}

<?php
const SRC_DIR = __DIR__ . '/src';

function scan_recursive($directory)
{
    // Привести каталог в канонизированный абсолютный путь
    $directory = realpath($directory);

    if ($d = opendir($directory)) {
        while ($fname = readdir($d)) {
            if ($fname == '.' || $fname == '..') {
                continue;
            }

            $currentFileName = $directory . '/' . $fname;
            if (is_dir($currentFileName)) {
                scan_recursive($currentFileName);
            }
            else {
                require_once $currentFileName;
            }
        }
        closedir($d);
    }
}


scan_recursive(SRC_DIR);

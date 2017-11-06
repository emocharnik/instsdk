<?php

namespace InstagramAppTest;

/**
 * Class Bootstrap
 * @package InstagramAppTest
 */
class Bootstrap
{
    public static function init()
    {
        // Load the user-defined test configuration file, if it exists; otherwise, load
        if (!defined('APPLICATION_PATH')) {
            define('APPLICATION_PATH', realpath(__DIR__ . '/../'));
        }

        static::initAutoLoader();

        if (extension_loaded('xdebug')) {
            echo "Xdebug extension loaded and running\n";
            xdebug_enable();
        } else {
            echo 'Xdebug not found, you should enabled this extension for code coverages and profiling' . PHP_EOL;
        }
    }

    protected static function initAutoLoader()
    {
        require_once APPLICATION_PATH . '/vendor/autoload.php';
    }
}

Bootstrap::init();

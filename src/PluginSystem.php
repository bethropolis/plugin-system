<?php

namespace Bethropolis\PluginSystem;

class System
{
    private static $plugins = array();
    private static $pluginsDir;

    private static $events = array();

    private static function pluginClassExists($className)
    {
        return class_exists($className);
    }

    private static function pluginAutoloader($className, $pluginsDir, $folder)
    {
        $classFile = $pluginsDir . $folder . '/' . $className . '.php';
        if (file_exists($classFile)) {
            require_once $classFile;
        }
    }

    public static function setPluginsDir($dir)
    {
        self::$pluginsDir = $dir;
    }

    public static function getPluginsDir()
    {
       return self::$pluginsDir;
    }

    public static function loadPlugins($dir = null)
    {
        if ($dir) {
            self::setPluginsDir($dir);
        }
        $pluginsDir = self::$pluginsDir;

        foreach (new \DirectoryIterator($pluginsDir) as $folder) {
            if (!$folder->isDot() && $folder->isDir()) {
                $pluginFile = $pluginsDir . $folder->getFilename() . '/plugin.php';

                if (file_exists($pluginFile)) {
                    $classAutoloader = function ($className) use ($pluginsDir, $folder) {
                        self::pluginAutoloader($className, $pluginsDir, $folder->getFilename());
                    };

                    spl_autoload_register($classAutoloader);

                    require_once $pluginFile;

                    $pluginClass = __NAMESPACE__ . '\\' . $folder->getFilename() . 'Plugin\\Load';
                    if (self::pluginClassExists($pluginClass)) {
                        $pluginInstance = new $pluginClass();
                        $pluginInstance->setupHooks();
                        $pluginInstance->getInfo();
                    }

                    spl_autoload_unregister($classAutoloader);
                }
            }
        }
        return true;
    }


    public static function linkPluginToHook($hook, $callback)
    {
        if (!isset(self::$plugins[$hook])) {
            self::$plugins[$hook] = array();
        }

        self::$plugins[$hook][] = $callback;
    }

    public static function executeHook($hook, $pluginName = null, ...$args)
    {
        $returnValues = array();

        if (isset(self::$plugins[$hook])) {
            foreach (self::$plugins[$hook] as $callback) {
                $callbackPluginName = get_class($callback[0]);

                if ($pluginName === null || $pluginName === $callbackPluginName) {
                    $returnValue = call_user_func($callback, $args);
                    if ($returnValue !== null &&  $pluginName === null) {
                        $returnValues[] = $returnValue;
                    } else {
                        $returnValues = $returnValue;
                    }
                }
            }
        }

        return $returnValues;
    }

    public static function executeHooks(array $hooks, $pluginName = null, ...$args)
    {

        $returnValues = array();
        foreach ($hooks as $hook) {
            $returnValue = self::executeHook($hook, $pluginName, ...$args);
            if ($returnValue !== null) {
                $returnValues[] = $returnValue;
            }
        }
        return $returnValues;
    }

    public static function registerEvent($eventName)
    {
        if (!isset(self::$events[$eventName])) {
            self::$events[$eventName] = array();
        }
    }

    public static function addAction($eventName, $callback)
    {
        if (isset(self::$events[$eventName])) {
            self::$events[$eventName][] = $callback;
        }
    }

    public static function triggerEvent($eventName, ...$args)
    {
        if (isset(self::$events[$eventName])) {
            foreach (self::$events[$eventName] as $callback) {
                call_user_func_array($callback, $args);
            }
        }
    }
}

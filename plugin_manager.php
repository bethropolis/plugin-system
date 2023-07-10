<?php


namespace PluginManager;

class Plugin
{
    private static $plugins = array();
    private static $pluginsDir;

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

    public static function loadPlugins($dir = null)
    {
        self::setPluginsDir($dir);

        $pluginsDir = self::$pluginsDir ?? __DIR__ . '/plugins/';

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
                    }

                    spl_autoload_unregister($classAutoloader);
                }
            }
        }
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
}

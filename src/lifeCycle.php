<?php

namespace Bethropolis\PluginSystem;

use Bethropolis\PluginSystem\System;
use Bethropolis\PluginSystem\Info;

class LifeCycle
{
    private $pluginDir;
    private $info;

    public function __construct()
    {
        $this->pluginDir = System::getPluginsDir();
        $this->info = new Info();
    }

    /**
     * Executes when the plugin is installed.
     *
     * @param string $pluginName The name of the plugin being installed.
     * @throws Some_Exception_Class Description of the exception that can be thrown.
     * @return void
     */
    public function onInstallation($pluginName)
    {
        $this->processPluginFiles($pluginName);
    }

    /**
     * Handles the uninstallation of a plugin.
     *
     * @param string $pluginName The name of the plugin being uninstalled.
     */
    public function onUninstallation($pluginName)
    {
        $this->info->removePlugin($pluginName);
        $this->processPluginFiles($pluginName);
    }

    /**
     * Process plugin files.
     *
     * @param string $pluginName The name of the plugin.
     */
    private function processPluginFiles($pluginName)
    {
        $pluginConfigFile = $this->getPluginConfigPath($pluginName);

        if (file_exists($pluginConfigFile)) {
            $pluginConfig = json_decode(file_get_contents($pluginConfigFile), true);
            $this->info->addPlugin($pluginName, $pluginConfig);
        }
    }

    /**
     * Retrieves the path to the configuration file of a plugin.
     *
     * @param string $pluginName The name of the plugin.
     * @return string The path to the plugin's configuration file.
     */
    private function getPluginConfigPath($pluginName)
    {
        return $this->getPluginPath($pluginName) . '/plugin.json';
    }

    /**
     * Retrieves the path of a plugin.
     *
     * @param string $pluginName The name of the plugin.
     * @return string The path of the plugin.
     */
    private function getPluginPath($pluginName)
    {
        return $this->pluginDir . $pluginName;
    }


}

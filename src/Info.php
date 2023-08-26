<?php

namespace Bethropolis\PluginSystem;

use Bethropolis\PluginSystem\System;

class Info
{
    private $configFilePath;
    private $pluginDir;
    private $config;

    public function __construct()
    {
        $this->configFilePath = __DIR__ . '/config/plugins.json';
        $this->pluginDir = System::getPluginsDir();
        $this->loadConfig();
    }


    /**
     * Loads the configuration from the config file.
     *
     * @throws Some_Exception_Class If the config file does not exist or is not readable.
     */
    private function loadConfig()
    {
        if (file_exists($this->configFilePath)) {
            $configContents = file_get_contents($this->configFilePath);
            $this->config = json_decode($configContents, true);
        } else {
            $this->config = [
                'plugins' => [],
            ];
            $this->saveConfig();
        }
    }

    /**
     * Refreshes the list of plugins.
     *
     * This function clears the existing plugins in the configuration
     * and scans the plugins directory to find new plugins. It reads
     * the plugin configuration files and adds them to the plugin list
     * in the configuration. Finally, it saves the updated configuration.
     *
     * @return void
     */
    public function refreshPlugins()
    {
        $this->config['plugins'] = [];
        $plugins = $this->scanPluginsDirectory();


        foreach ($plugins as $pluginName) {
            $pluginConfigFile = $this->pluginDir . $pluginName . '/plugin.json';
            if (file_exists($pluginConfigFile)) {
                $pluginConfig = json_decode(file_get_contents($pluginConfigFile), true);
                $this->config['plugins'][$pluginName] = $pluginConfig;
            }
        }

        $this->saveConfig();
    }

    /**
     * Scans the plugins directory and returns an array of plugin names.
     *
     * @return array
     */
    private function scanPluginsDirectory()
    {
        $plugins = [];
        if (is_dir($this->pluginDir)) {
            $dirContent = scandir($this->pluginDir);
            foreach ($dirContent as $item) {
                if ($item !== '.' && $item !== '..' && is_dir($this->pluginDir . $item)) {
                    $plugins[] = $item;
                }
            }
        }
        return $plugins;
    }

    /**
     * Adds a plugin to the configuration.
     *
     * @param string $pluginName The name of the plugin.
     * @param mixed $data The data associated with the plugin.
     * @return bool True if the plugin was successfully added, false otherwise.
     */
    public function addPlugin($pluginName, $data)
    {
        if (isset($this->config['plugins'][$pluginName])) {
            return;
        }

        $this->config['plugins'][$pluginName] = $data;
        $this->saveConfig();
        return true;
    }

    /**
     * Removes a plugin from the configuration.
     *
     * @param string $pluginName The name of the plugin to remove.
     * @throws Some_Exception_Class If an error occurs while saving the configuration.
     * @return void
     */
    public function removePlugin($pluginName)
    {
        unset($this->config['plugins'][$pluginName]);
        $this->saveConfig();
    }

    /**
     * Modifies the plugin data for a specific plugin.
     *
     * @param string $pluginName The name of the plugin.
     * @param array $data An array containing the data to merge with the existing plugin data.
     * @throws Some_Exception_Class A description of the exception that can be thrown.
     * @return void
     */
    public function modifyPluginData($pluginName, $data)
    {
        if (isset($this->config['plugins'][$pluginName])) {
            $this->config['plugins'][$pluginName] = array_merge($this->config['plugins'][$pluginName], $data);
            $this->saveConfig();
        }
    }

    /**
     * Retrieves the list of plugins.
     *
     * @return array The list of plugins.
     */
    public function getPlugins()
    {
        $plugins = $this->config['plugins'] ?? [];
        return $plugins;
    }

    /**
     * Saves the configuration data to a file.
     *
     * @throws Some_Exception_Class If there is an error writing the file.
     */
    private function saveConfig()
    {
        $configContents = json_encode($this->config, JSON_PRETTY_PRINT);
        file_put_contents($this->configFilePath, $configContents);
    }
}

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
        $this->processPluginFiles($pluginName, 'append');
    }

    /**
     * Handles the uninstallation of a plugin.
     *
     * @param string $pluginName The name of the plugin being uninstalled.
     */
    public function onUninstallation($pluginName)
    {
        $this->processPluginFiles($pluginName, 'remove');
    }

    /**
     * Process plugin files.
     *
     * @param string $pluginName The name of the plugin.
     * @param string $action The action to perform on the plugin files (append or remove).
     */
    private function processPluginFiles($pluginName, $action)
    {
        $pluginConfigFile = $this->getPluginConfigPath($pluginName);

        if (file_exists($pluginConfigFile)) {
            $pluginConfig = json_decode(file_get_contents($pluginConfigFile), true);
            $this->info->addPlugin($pluginName, $pluginConfig);

            if (isset($pluginConfig['files'])) {
                foreach ($pluginConfig['files'] as $file) {
                    if (isset($file['target']) && isset($file['require'])) {
                        $targetFile = $this->resolveAbsolutePath(__DIR__ . '/' . $file['target']);
                        $requireFile = $this->resolveRelativePath($file['require'], $this->getPluginPath($pluginName));

                        if (file_exists($targetFile) && file_exists($requireFile)) {
                            // Perform the specified action (append or remove) on the target file
                            $this->$action($targetFile, $requireFile, $pluginName);
                        }
                    }
                }
            }
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

    /**
     * Appends a require statement to a target file if it doesn't already exist.
     *
     * @param string $targetFile The path to the target file.
     * @param string $requireFile The path to the file to be required.
     * @param string $pluginName The name of the plugin.
     */
    private function append($targetFile, $requireFile, $pluginName)
    {
        $content = file_get_contents($targetFile);
        $requireStatement = 'require "' . str_replace('\\', '/', $requireFile) . '";';


        // Append the require statement to the target file if it doesn't exist already
        if (strpos($content, $requireStatement) === false) {
            $content .= PHP_EOL . $requireStatement . PHP_EOL;
            file_put_contents($targetFile, $content);
        }
    }

    /**
     * Removes a plugin from the target file and updates the require statement.
     *
     * @param string $targetFile The path to the target file.
     * @param string $requireFile The path to the require file.
     * @param string $pluginName The name of the plugin to remove.
     * @throws Some_Exception_Class If an error occurs while removing the plugin or updating the require statement.
     * @return void
     */
    private function remove($targetFile, $requireFile, $pluginName)
    {
        $this->info->removePlugin($pluginName);
        $content = file_get_contents($targetFile);
        $requireStatement = 'require "' . str_replace('\\', '/', $requireFile) . '";';

        // Remove the appended require statement from the target file
        $content = str_replace(PHP_EOL . $requireStatement . PHP_EOL, '', $content);
        file_put_contents($targetFile, $content);
    }


    /**
     * Resolves the absolute path from a given path.
     *
     * @param string $path The path to resolve.
     * @return string The resolved absolute path.
     */
    private function resolveAbsolutePath($path)
    {
        // Resolve the absolute path from a given path
        return realpath($path);
    }

    /**
     * Resolves the relative path from a given base path.
     *
     * @param string $path The relative path to be resolved.
     * @param string $basePath The base path to resolve the relative path from.
     * @return string The resolved absolute path.
     */
    private function resolveRelativePath($path, $basePath)
    {
        // Resolve the relative path from a given base path
        print_r($basePath . '/' . $path);
        return realpath($basePath . '/' . $path);
    }
}

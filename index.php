<?php 
require_once './plugin_manager.php';

use PluginManager\Plugin;

$dir = __DIR__ . "/plugins/";
Plugin::loadPlugins($dir);

$item = Plugin::executeHook('my_hook',"PluginManager\MyPlugin\Load","john");

print_r($item);
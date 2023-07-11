<?php 
require_once 'src\PluginSystem.php';
require_once 'src\Plugin.php';

use Bethropolis\PluginSystem\System;

$dir = __DIR__."/examples/";
System::loadPlugins($dir);



$item = System::executeHook('my_hook',"Bethropolis\PluginSystem\MyPlugin\Load","john");

print_r($item);
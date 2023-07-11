<?php
require_once 'src/pluginSystem.php';
require_once 'src/pluginAutoloader.php';
require_once 'src/plugin.php';

use Bethropolis\PluginSystem\System;

$dir = __DIR__ . "/examples/";
System::loadPlugins($dir);

function echoNewLine($type = null)
{
    echo "<br> --- {$type} ---:";
}

$item = System::executeHook('my_hook', "Bethropolis\PluginSystem\MyPlugin\Load", "john");
system::registerEvent("file_upload");
System::addAction("file_upload", function ($item) {
    echo $item;
});


$event = System::triggerEvent("file_upload", "how are you people");

$plugins = System::getPlugins();

$items = System::executeHooks(["other_hook","test_hook"],null,"john","doe");


echoNewLine("item");
print_r($item);
echoNewLine("items");
print_r($items);
echoNewLine("event");
print_r($event);
echoNewLine("plugins");
print_r($plugins);

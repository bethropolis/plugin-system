<?php

// This is a manual test

require_once __DIR__ . '/src/autoload.php';
;

use Bethropolis\PluginSystem\System;
use Bethropolis\PluginSystem\Manager;
use Bethropolis\PluginSystem\LifeCycle;

$dir = __DIR__ . "/examples/";
System::loadPlugins($dir);

Manager::initialize();

$life = new LifeCycle();
Manager::installPlugin("http://localhost/compresed/addition/addition.zip");
//Manager::uninstallPlugin("addition");

function echoNewLine($type = null)
{
    echo "<br> --- {$type} ---:";
}

$item = System::executeHook('my_hook', "Bethropolis\PluginSystem\MyPlugin\Load", "john");
$item = System::executeHook('js_hook', null, "Kirwa");


system::registerEvent("file_upload");
System::addAction("file_upload", function ($item) {
    return ($item);
});

$addition = System::executeHook("calculate_addition", null);

$event = System::triggerEvent("file_upload", "how are you");

$plugins = System::getPlugins();

$items = System::executeHooks(["other_hook", "test_hook"], null, "john", "doe");

$hooks = System::getHooks();

echoNewLine("item");
print_r($item);
echoNewLine("items");
print_r($items);
echoNewLine("addition");
print_r($addition);
echoNewLine("event");
print_r($event);
echoNewLine("plugins");
print_r($plugins);
echoNewLine("hooks");
print_r($hooks);


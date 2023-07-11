<?php 
require_once 'src/PluginSystem.php';
require_once 'src/pluginLoader.php';
require_once 'src/Plugin.php';

use Bethropolis\PluginSystem\System;

$dir = __DIR__."/examples/";
System::loadPlugins($dir);

function echoNewLine(){
    echo "<br> ---";
}

$item = System::executeHook('my_hook',"Bethropolis\PluginSystem\MyPlugin\Load","john");
system::registerEvent("file_upload");
System::addAction("file_upload", function ($item){
    echo $item;
    echoNewLine();
});


$event = System::triggerEvent("file_upload", "how are you people");

$items = System::executeHooks(["other_hook","test_hook"],"Bethropolis\PluginSystem\AnotherPlugin\Load");

print_r($item);
 echoNewLine();
print_r($items);
echoNewLine();
print_r($event);
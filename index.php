<?php

// This is a manual test

require_once __DIR__ . '/src/autoload.php';
;

use Bethropolis\PluginSystem\System;
use Bethropolis\PluginSystem\Manager;
use Bethropolis\PluginSystem\LifeCycle;
use Bethropolis\PluginSystem\Info;


$dir = __DIR__ . "/examples/";
System::loadPlugins($dir);

Manager::initialize($dir);


$info = new Info();
$life = new LifeCycle();
Manager::installPlugin("http://localhost/compresed/addition/addition.zip");
//Manager::uninstallPlugin("addition");

function echoNewLine($type = null)
{
    echo "<br> --- {$type} ---:";
}

function echoItem($item, $color,$text = null)
{
    echo "<br/>";
    echo "<span style='color: {$color}'>{$item} </span>";
    print_r($text);
}

echoItem(Manager::pluginExists("addition"), "red");
echoItem(Manager::pluginExists("singlefileplugin"), "green");
echoItem(Manager::togglePlugin("addition"), "green");
echoItem(Manager::isPluginActive("singlefileplugin"), "blue");

$item = System::executeHook('my_hook', null, "john");



system::registerEvent("file_upload");
System::addAction("file_upload", function ($item) {
    return ($item);
});

$addition = System::executeHook("calculate_addition", null, 4,5);

$event = System::triggerEvent("file_upload", "how are you");

$plugins = System::getPlugins();

$items = System::executeHooks(["other_hook", "test_hook"], null, "john", "doe");

$hooks = System::getHooks();

$info->refreshPlugins();

echoItem("info", "red",json_encode($info->getPlugins()));

echoItem("item","orange",$item);
echoItem("items","red",$items);
echoItem("addition", "aqua", $addition);

echoItem("plugins", "blue", $plugins);
echoItem("hooks", "green", $hooks);




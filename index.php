<?php
require_once "vendor/autoload.php";

use Bethropolis\PluginSystem\System;
use Bethropolis\PluginSystem\Manager;

$dir = __DIR__ . "/examples/";

// Initialize the updated Manager (with the dynamic config path)
Manager::initialize($dir, __DIR__ . '/plugin_config.json');
System::loadPlugins($dir);

echo "<h3>Testing Text Modifier (Hook)</h3>";
$formatted = System::executeHook('format_output_text', null, "this should be uppercase");
// Because executeHook returns an array of responses from all plugins attached:
print_r($formatted);

echo "<h3>Testing Logger (Event)</h3>";
// This won't return anything visible, but it will trigger the error_log in the Logger plugin
System::triggerEvent('user_login', 'bethropolis');
echo "Event triggered. Check your PHP error log.";

echo "<h3>Testing Closures (Bug Fix Verification)</h3>";
$closureResult = System::executeHook('test_closure_hook', null, 'Alice');
print_r($closureResult);

echo "<h3>Testing String Function Callback</h3>";
// Passes "hello world" to strtoupper
$stringResult = System::executeHook('test_string_hook', null, 'hello world');
print_r($stringResult);

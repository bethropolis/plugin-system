<?php


require_once 'src/autoload.php';

use Bethropolis\PluginSystem\System;
use PHPUnit\Framework\TestCase;

class SystemTest extends TestCase
{
    private static $dir = __DIR__ . "/../examples/";
    public function testSetPluginsDir()
    {
        System::setPluginsDir(self::$dir);
        var_dump(System::getPluginsDir());

        $this->assertSame(self::$dir, System::getPluginsDir());
    }

    public function testGetPlugins()
    {

        System::setPluginsDir(self::$dir);
        $load = System::loadPlugins();
        $plugins = System::getPlugins();
        $this->assertIsArray($plugins);
    }


    public function testLoadPlugins()
    {
        System::setPluginsDir(self::$dir);
        $load = System::loadPlugins();
        $this->assertTrue($load);
    }


    public function testExecution()
    {
        System::setPluginsDir(self::$dir);
        $load = System::loadPlugins();
        $this->assertTrue($load);
        $item = System::executeHook('my_hook', "Bethropolis\PluginSystem\MyPlugin\Load", "john");
        $this->assertSame($item, "hello john");
    }


    public function testExecutions()
    {
        System::setPluginsDir(self::$dir);
        $load = System::loadPlugins();

        $items = System::executeHooks(["other_hook", "test_hook"], null, "john", "doe");
        // $item = Array ( [other_hook] => Array ( [0] => hello john doe ) [test_hook] => Array ( [0] => hello john this is from Another script ) )
        $this->assertIsArray($items);
        $this->assertCount(2, $items);
        $this->assertArrayHasKey("other_hook", $items);
        $this->assertArrayHasKey("test_hook", $items);
        $this->assertIsArray($items["other_hook"]);
        $this->assertIsArray($items["test_hook"]);
        $this->assertSame($items["other_hook"][0], "hello john doe");
        $this->assertSame($items["test_hook"][0], "hello john this is from Another script");
    }

    public function testRegisterEvent()
    {
        System::registerEvent('my_event');
        $events = System::getEvents();
        $this->assertArrayHasKey('my_event', $events);
    }


    public function testAddAction()
    {
        System::registerEvent('my_event');
        $callback = function ($arg) {
            return "Action executed with arg: " . $arg;
        };

        System::addAction('my_event', $callback);

        $items = System::triggerEvent('my_event', 'Test');
        $this->assertSame($items[0], "Action executed with arg: Test");
    }
    public function testTriggerEvent()
    {
        System::clearEvents();
        System::registerEvent('my_event');
        $callback1 = function ($arg = null) {
            return "Callback 1 executed";
        };

        $callback2 = function ($arg = null) {
            return "Callback 2 executed";
        };

        System::addAction('my_event', $callback1);
        System::addAction('my_event', $callback2);

        $items = System::triggerEvent('my_event', "Test");
        $this->assertCount(2, $items);
        $this->assertSame($items[0], "Callback 1 executed");
        $this->assertSame($items[1], "Callback 2 executed");
    }
}

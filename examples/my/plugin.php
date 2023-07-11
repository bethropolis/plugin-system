<?php

namespace Bethropolis\PluginSystem\MyPlugin;

use Bethropolis\PluginSystem\System;
use Bethropolis\PluginSystem\Plugin;

class Load extends Plugin
{

    public function setupHooks()
    {
        System::linkPluginToHook('my_hook', array($this, 'myCallback'));
    }



    public function myCallback($name = [])
    {
        $name = array_shift($name);
        return "hello {$name}";
    }
}

<?php

namespace Bethropolis\PluginSystem\MyPlugin;


class Load extends \Bethropolis\PluginSystem\Plugin
{

    public function setupHooks()
    {
        $this->linkHook('my_hook', array($this, 'myCallback'));
    }



    public function myCallback($name = [])
    {
        $name = array_shift($name);
        return "hello {$name}";
    }
}

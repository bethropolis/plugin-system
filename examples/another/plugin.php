<?php

namespace Bethropolis\PluginSystem\AnotherPlugin;

use Bethropolis\PluginSystem\Plugin;

class Load extends Plugin
{
    protected  $name = "dis app";
    public function setupHooks()
    {
        $this->linkHook('other_hook', array($this, 'myCallback'));
    }

    public function myCallback($arg)
    {
        return "hello " . $arg[0]. " ". $arg[1];
    }
}
